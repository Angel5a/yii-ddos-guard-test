<?php

namespace app\controllers;

use Yii;
use app\models\GlobalSearch;
use app\models\Service;
use app\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;

class SearchController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actionIndex()
    {
        $searchModel = new GlobalSearch();
        $serviceDataProvider = $searchModel->searchService(Yii::$app->request->queryParams);
        $userDataProvider = $searchModel->searchUser(Yii::$app->request->queryParams);

        $totalCount = $serviceDataProvider->getTotalCount() + $userDataProvider->getTotalCount();

        $method = Yii::$app->request->isAjax ? 'renderAjax' : 'render';

        return $this->$method('index', [
            'searchModel' => $searchModel,
            'serviceDataProvider' => $serviceDataProvider,
            'userDataProvider' => $userDataProvider,
            'totalCount' => $totalCount,
        ]);
    }

}
