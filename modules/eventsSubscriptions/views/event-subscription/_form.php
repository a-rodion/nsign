<?php
declare(strict_types=1);

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\eventsSubscriptions\models\EventSubscription $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="event-subscription-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'event')->dropDownList($model->eventValuesLabels()) ?>

    <?= $form->field($model, 'user_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'blocked')->dropDownList($model->blockedValuesLabels()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
