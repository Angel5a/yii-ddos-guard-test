<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Service */

$this->title = Yii::t('service', 'Update Service: {name}', [
    'name' => $model->id,
]);
?>

<div class="service-update">

    <?php Pjax::begin(['id' => 'pjax-container-service-form']); ?>

        <?= $this->render('_form', [
            'model' => $model,
            'allTypes' => $allTypes,
            'allUsers' => $allUsers,
            'usePjax' => true,
        ]) ?>

    <?php Pjax::end(); ?>

    <?php $this->registerJs(
        '$("document").ready(function(){ 
            $("#pjax-container-service-form").on("pjax:end", function (event) {
                var form = $(this);
                if (form.find(".has-error").length) {
                    return false;
                }
                $("#modal").modal("hide");
                jQuery("#service-index-gridview").yiiGridView("applyFilter");
            });
        });'
    ); ?>

</div>
