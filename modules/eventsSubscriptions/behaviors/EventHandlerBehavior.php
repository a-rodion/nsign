<?php
declare(strict_types=1);

namespace app\modules\eventsSubscriptions\behaviors;

use app\modules\eventsSubscriptions\models\EventSubscription;
use app\modules\eventsSubscriptions\models\IWorker;
use yii\base\Behavior;
use yii\base\Event;
use yii\helpers\ArrayHelper;

/**
 *
 */
class EventHandlerBehavior extends Behavior
{
    /** @var string[] Class names of workers that implements IWorker */
    public $workers;

    /** @var string Name of event */
    public $event;

    public function events(): array
    {
        return [
            $this->event => 'eventHandler',
        ];
    }

    public function eventHandler(Event $event): void
    {
        $subscribers = EventSubscription::findAll([
            'blocked' => EventSubscription::BLOCKED_NO,
            'event' => $event->name,
        ]);
        if (\count($subscribers) === 0) {
            return;
        }
        $emails = ArrayHelper::getColumn($subscribers, 'user_email');

        foreach ($this->workers as $workerClass) {
            /** @see IWorker */
            \call_user_func([$workerClass, 'doJob'], $emails, $event);
        }
    }
}
