<?php
declare(strict_types=1);

use app\modules\eventsSubscriptions\models\EventSubscription;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\eventsSubscriptions\models\EventSubscriptionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Event Subscriptions';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="event-subscription-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Event Subscription', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'event',
                'value' => function (EventSubscription $model) {
                    return $model->getEventLabel();
                },
                'filter' => $searchModel->eventValuesLabels(),
            ],
            'user_email:email',
            [
                'attribute' => 'blocked',
                'value' => function (EventSubscription $model) {
                    return $model->getBlockedLabel();
                },
                'filter' => $searchModel->blockedValuesLabels(),
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, EventSubscription $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
