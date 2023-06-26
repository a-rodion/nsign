<?php
declare(strict_types=1);

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <a class="btn btn-lg btn-success" href="<?=Yii::$app->urlManager->createUrl('eventsSubscriptions/event-subscription')?>">
            Модуль подписки
        </a>
        <a class="btn btn-lg btn-success" href="<?=Yii::$app->urlManager->createUrl('site/register')?>">
            Событие Регистрация
        </a>
        <a class="btn btn-lg btn-success" href="<?=Yii::$app->urlManager->createUrl('site/verification')?>">
            Событие Верификация
        </a>
    </div>
</div>
