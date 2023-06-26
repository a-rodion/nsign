<?php
declare(strict_types=1);

namespace app\services;

use app\modules\eventsSubscriptions\models\IWorker;
use Yii;
use yii\base\Event;

/**
 *
 */
class DbRowWorker implements IWorker
{
    /**
     * @inheritDoc
     */
    public static function doJob(array $emails, Event $event): void
    {
        // example
        // Yii::$app->db->createCommand()->batchInsert('test_table', ['email'], $emails)->execute();

        $eventName = strtoupper($event->name);

        foreach ($emails as $email) {
            Yii::info("{$eventName} event. Inserting row for {$email}...", 'user');
        }
    }
}
