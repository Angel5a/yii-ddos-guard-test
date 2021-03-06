<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

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

    <?php Pjax::begin(['id' => 'pjax-container-service-index']); ?>

        <?= GridView::widget([
            'id' => 'service-index-gridview',
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
                    'buttons' => [
                        'update' => function($url, $dataProvider, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'class'=> 'modal-update-link',
                                'title' => Yii::t('yii', 'Update'),
                                'data-pjax' => '0',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'class'=> 'modal-delete-link',
                                'title' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>

    <?php Pjax::end(); ?>

    <?php $this->registerJs(
        '$(function(){
            $(".modal-update-link").click(function (e) {
                e.preventDefault();
                var container = $("#modalContent");
                container.html("' . Yii::t('service', 'Please wait, the data is being loading...') . '");
                $("#modal").modal("show").find(container).load($(this).attr("href"));
            });
        });'
    ); ?>

    <?php $this->registerJs(
        '$("document").ready(function(){ 
            $("#pjax-container-service-index").on("pjax:end", function () {
                $(".modal-update-link").click(function (e) {
                    e.preventDefault();
                    var container = $("#modalContent");
                    container.html("' . Yii::t('service', 'Please wait, the data is being loading...') . '");
                    $("#modal").modal("show").find(container).load($(this).attr("href"));
                });
            });
        });'
    ); ?>

    <?php $this->registerJs(
        '$(function(){
            $(".modal-delete-link").click(function (e) {
                e.preventDefault();
                var msg = $(this).data("confirm") || null;
                if (!msg || confirm(msg)) {
                    $.ajax($(this).attr("href"), {
                        type: $(this).data("method") || "POST"
                    }).done(function(data) {
                        $("#service-index-gridview").yiiGridView("applyFilter");
                    });
                }
                return false;
            });
        });'
    ); ?>

    <?php $this->registerJs(
        '$("document").ready(function(){ 
            $("#pjax-container-service-index").on("pjax:end", function () {
                $(".modal-delete-link").click(function (e) {
                    e.preventDefault();
                    var msg = $(this).data("confirm") || null;
                    if (!msg || confirm(msg)) {
                        $.ajax($(this).attr("href"), {
                            type: $(this).data("method") || "POST"
                        }).done(function(data) {
                            $("#service-index-gridview").yiiGridView("applyFilter");
                        });
                    }
                    return false;
                });
            });
        });'
    ); ?>

    <?php Modal::begin([
           'header'=>'<h4>' . Yii::t('service', 'Edit') . '</h4>',
           'id'=>'modal',
           'size'=>'modal-lg',
    ]); ?>
    
        <div id='modalContent'></div>

    <?php Modal::end(); ?>   



</div>
