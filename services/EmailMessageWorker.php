<?php
declare(strict_types=1);

namespace app\services;

use app\modules\eventsSubscriptions\models\IWorker;
use Yii;
use yii\base\Event;

/**
 *
 */
class EmailMessageWorker implements IWorker
{
    /**
     * @inheritDoc
     */
    public static function doJob(array $emails, Event $event): void
    {
        $eventName = strtoupper($event->name);

        foreach ($emails as $email) {
            Yii::info("{$eventName} event. Sending email-message for {$email}...", 'user');
        }
    }
}
