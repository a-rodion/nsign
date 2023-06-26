<?php
declare(strict_types=1);

namespace app\services;

use app\modules\eventsSubscriptions\models\IWorker;
use Yii;
use yii\base\Event;

/**
 *
 */
class SmsMessageWorker implements IWorker
{
    /**
     * @inheritDoc
     */
    public static function doJob(array $emails, Event $event): void
    {
        $eventName = strtoupper($event->name);

        foreach ($emails as $email) {
            Yii::info("{$eventName} event. Sending SMS-message for {$email}...", 'user');
        }
    }
}
