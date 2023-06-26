<?php
declare(strict_types=1);

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\eventsSubscriptions\models\EventSubscription $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Subscriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="event-subscription-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'event',
                'value' => $model->getEventLabel(),
            ],
            'user_email:email',
            [
                'attribute' => 'blocked',
                'value' => $model->getBlockedLabel(),
            ],
            'dt_created',
            'dt_updated',
        ],
    ]) ?>

</div>
