<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('service', 'Services');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('service', 'Create User'), ['user/create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('service', 'Create Service'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'type_id',
                'value' => 'typeName',
                'filter' => Html::activeDropDownList($searchModel, 'type_id', $allTypes, ['class'=>'form-control','prompt' => Yii::t('service', 'Select Type')]),
            ],
            [
                'attribute' => 'user_id',
                'value' => 'userName',
                'filter' => Html::activeDropDownList($searchModel, 'user_id', $allUsers, ['class'=>'form-control','prompt' => Yii::t('service', 'Select User')]),
            ],
            'ip',
            'domain',
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> Yii::t('service', 'Action'),
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>
