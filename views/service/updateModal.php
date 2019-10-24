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

</div>
