<?php
declare(strict_types=1);

namespace app\modules\eventsSubscriptions\behaviors;

use app\modules\eventsSubscriptions\models\EventSubscription;
use yii\base\Behavior;
use yii\base\Event;
use yii\helpers\ArrayHelper;

/**
 *
 */
class EventHandlerBehavior extends Behavior
{
    /** @var callable[] */
    public $workers;

    /** @var string */
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
        foreach ($this->workers as $worker) {
            \call_user_func([$worker, 'doJob'], $emails, $event);
        }
    }
}
