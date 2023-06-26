<?php
declare(strict_types=1);

namespace app\modules\eventsSubscriptions\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events_subscription}}`.
 */
class M230620082928CreateEventsSubscriptionTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events_subscription}}', [
                'id' => $this->primaryKey(),
                'event' => $this->string(20)->notNull(),
                'user_email' => $this->string(254)->notNull(),
                'blocked' => $this->tinyInteger(1)->unsigned()->notNull(),
                'dt_created' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
                'dt_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
                                                  ->append('ON UPDATE CURRENT_TIMESTAMP'),
            ],
            'DEFAULT CHARSET=utf8'
        );

        $this->createIndex(
            'event-idx',
            '{{%events_subscription}}',
            'event(10)'
        );

        $this->createIndex(
            'user_email-idx',
            '{{%events_subscription}}',
            'user_email(10)'
        );

        $this->createIndex(
            'blocked-idx',
            '{{%events_subscription}}',
            'blocked'
        );

        $this->createIndex(
            'dt_created-idx',
            '{{%events_subscription}}',
            'dt_created'
        );

        $this->createIndex(
            'dt_updated-idx',
            '{{%events_subscription}}',
            'dt_updated'
        );

        $this->createIndex(
            'event_user-idx',
            '{{%events_subscription}}',
            ['event', 'user_email'],
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%events_subscription}}');
    }
}
