<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GlobalSearch */
/* @var $servaceDataProvider yii\data\ActiveDataProvider */
/* @var $userDataProvider yii\data\ActiveDataProvider */
/* @var $totalCount integer */

$this->title = Yii::t('Yii', 'Search');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(['id' => 'pjax-container-search-index']); ?>

    <?php if (empty($totalCount)) : ?>
        No results found for "<?= Html::encode($searchModel->text) ?>".
    <?php else: ?>

        <h4><?= Yii::t(
            'search',
            '{n, plural, =0{No services} =1{# service} other{# services}}',
            ['n' => $serviceDataProvider->getTotalCount()]
        ) ?></h4>

        <?= Html::ul($serviceDataProvider->getModels(), [
            'item' => function($item, $index) {
                return Html::tag(
                    'li',
                    Yii::t(
                        'search',
                        '#{id} {type} for {fullName} as {ip} {domain}',
                        [
                            'id' => $item->id,
                            'type' => $item->typeName,
                            'fullName' => $item->userName,
                            'ip' => $item->ip,
                            'domain' => $item->domain,
                        ]
                    ),
                    ['class' => 'service']
                );
            },
        ]) ?>

        <h4><?= Yii::t(
            'search',
            '{n, plural, =0{No users} =1{# user} other{# users}}',
            ['n' => $userDataProvider->getTotalCount()]
        ) ?></h4>

        <?= Html::ul($userDataProvider->getModels(), [
            'item' => function($item, $index) {
                return Html::tag(
                    'li',
                    Yii::t('search', '#{id} {fullName}', ['id' => $item->id, 'fullName' => $item->fullName]),
                    ['class' => 'user']
                );
            },
        ]) ?>

    <?php endif; ?>

    <?php Pjax::end(); ?>

</div>