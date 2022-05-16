<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DailyQuestionnaire;

/**
 * DailyQuestionnaireSearch represents the model behind the search form of `app\models\DailyQuestionnaire`.
 */
class DailyQuestionnaireSearch extends DailyQuestionnaire
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tahlil_result', 'case', 'present_location', 'kasallik_caraqa', 'desc'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
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
    public function search($params)
    {
        $query = DailyQuestionnaire::find();

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
        ]);

        $query->andFilterWhere(['like', 'tahlil_result', $this->tahlil_result])
            ->andFilterWhere(['like', 'case', $this->case])
            ->andFilterWhere(['like', 'present_location', $this->present_location])
            ->andFilterWhere(['like', 'kasallik_caraqa', $this->kasallik_caraqa])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
