<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Service */
/* @var $allTypes array */
/* @var $allUsers array */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(['options' => ['id' => 'service-edit-form', 'data-pjax' => isset($usePjax)?$usePjax:false]]); ?>

    <?= $form->field($model, 'type_id')->dropdownList($allTypes, ['prompt'=>Yii::t('service', 'Select Type')]) ?>

    <?= $form->field($model, 'user_id')->dropdownList($allUsers, ['prompt'=>Yii::t('service', 'Select User')]) ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'domain')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('service', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
