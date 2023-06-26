<?php
declare(strict_types=1);

namespace app\modules\eventsSubscriptions\models;

use yii\base\Event;

/**
 *
 */
interface IWorker
{
    /**
     * @param string[]        $emails
     * @param \yii\base\Event $event
     */
    public static function doJob(array $emails, Event $event): void;
}
