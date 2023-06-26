<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\eventsSubscriptions\models\EventSubscription $model */

$this->title = 'Create Event Subscription';
$this->params['breadcrumbs'][] = ['label' => 'Event Subscriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-subscription-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
