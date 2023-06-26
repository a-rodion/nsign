<?php
declare(strict_types=1);

namespace app\modules\eventsSubscriptions\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EventSubscriptionSearch represents the model behind the search form of `app\modules\events\models\EventSubscription`.
 */
class EventSubscriptionSearch extends EventSubscription
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'blocked'], 'integer'],
            [['event', 'user_email'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params): ActiveDataProvider
    {
        $query = EventSubscription::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'blocked' => $this->blocked,
        ]);

        $query->andFilterWhere(['like', 'event', $this->event])
            ->andFilterWhere(['like', 'user_email', $this->user_email]);

        return $dataProvider;
    }
}
