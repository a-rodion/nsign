<?php
declare(strict_types=1);

namespace app\modules\eventsSubscriptions\models;

/**
 * This is the model class for table "events_subscription".
 *
 * @property int $id
 * @property string $event
 * @property string $user_email
 * @property int $blocked
 * @property string $dt_created
 * @property string $dt_updated
 */
class EventSubscription extends \yii\db\ActiveRecord
{
    public const EVENT_REGISTER = 'register';
    public const EVENT_VERIFICATION = 'verification';
    public const EVENT_LOGIN = 'login';
    public const EVENT_LOGOUT = 'logout';
    public const EVENT_MESSAGE = 'message';

    public const BLOCKED_YES = 1;
    public const BLOCKED_NO = 0;

    /**
     * @param bool $skipIfSet
     *
     * @return EventSubscription
     */
    public function loadDefaultValues($skipIfSet = true): EventSubscription
    {
        parent::loadDefaultValues($skipIfSet);
        $this->setAttribute('blocked', self::BLOCKED_NO);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'events_subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['event', 'user_email', 'blocked'], 'required'],
            ['user_email', 'email'],
            [['blocked'], 'integer', 'min' => 0, 'max' => 1],
            [['dt_created', 'dt_updated'], 'safe'],
            [['event'], 'string', 'max' => 20],
            [['user_email'], 'string', 'max' => 254],
            [['event', 'user_email'], 'unique', 'targetAttribute' => ['event', 'user_email']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'event' => 'Событие',
            'user_email' => 'Получатель',
            'blocked' => 'Заблокировано',
            'dt_created' => 'Дата создания',
            'dt_updated' => 'Дата обновления',
        ];
    }

    /**
     * @return string[]
     */
    public function eventValuesLabels(): array
    {
        return [
            self::EVENT_REGISTER     => 'Регистрация',
            self::EVENT_VERIFICATION => 'Верификация',
            self::EVENT_LOGIN        => 'Вход',
            self::EVENT_MESSAGE      => 'Отправка сообщения',
            self::EVENT_LOGOUT       => 'Выход',
        ];
    }

    /**
     * @return string[]
     */
    public function blockedValuesLabels(): array
    {
        return [
            self::BLOCKED_YES => 'Да',
            self::BLOCKED_NO  => 'Нет',
        ];
    }

    /**
     * @return string
     */
    public function getEventLabel(): string
    {
        return $this->eventValuesLabels()[$this->event];
    }

    /**
     * @return string
     */
    public function getBlockedLabel(): string
    {
        return $this->blockedValuesLabels()[$this->blocked];
    }
}
