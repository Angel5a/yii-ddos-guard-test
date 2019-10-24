<?php

namespace app\controllers;

use Yii;
use app\models\Service;
use app\models\ServiceSearch;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Service models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $allTypes = Service::allTypeNames();
        $users = User::find()->all();
        $allUsers = ArrayHelper::map($users,'id','fullName');

        $method = Yii::$app->request->isAjax ? 'renderAjax' : 'render';

        return $this->$method('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'allTypes' => $allTypes,
            'allUsers' => $allUsers,
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Service();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $allTypes = Service::allTypeNames();
        $users = User::find()->all();
        $allUsers = ArrayHelper::map($users,'id','fullName');

        return $this->render('create', [
            'model' => $model,
            'allTypes' => $allTypes,
            'allUsers' => $allUsers,
        ]);
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // TODO: Need to solve edit links in GridView after pjax request
        //       (they works as usual links, not .modal-update-link)
        // TODO: Close Modal and update GridView after success save via pjax.
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //if (Yii::$app->request->isAjax) {
            //    return "Done";//return $this->actionIndex();
            //}
            return $this->redirect(['index']);
        }
        
        $allTypes = Service::allTypeNames();
        $users = User::find()->all();
        $allUsers = ArrayHelper::map($users,'id','fullName');

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('updateModal', [
                'model' => $model,
                'allTypes' => $allTypes,
                'allUsers' => $allUsers,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'allTypes' => $allTypes,
                'allUsers' => $allUsers,
            ]);
        }
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // No client side update/delete. See https://github.com/yiisoft/yii2/issues/15723
        // It is still possible to remove table row via javascript, but sorting/pages/etc
        // would be broken. So better to use simple Pjax widget as more user friendly.

        $this->findModel($id)->delete();

        if (Yii::$app->request->isAjax)
            return $this->actionIndex();
        else
            return $this->redirect(['index']);
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('service', 'The requested page does not exist.'));
    }
}
