<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GlobalSearch */
?>

<div class="global-search-form">

    <?php $form = ActiveForm::begin(['options' => ['id' => 'global-service-edit-form', 'data-pjax' => isset($usePjax)?$usePjax:false]]); ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Search'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
