<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\eventsSubscriptions\models\EventSubscription $model */

$this->title = 'Update Event Subscription: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Subscriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-subscription-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
