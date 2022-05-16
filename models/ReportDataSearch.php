<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReportData;

/**
 * ReportDataSearch represents the model behind the search form of `app\models\ReportData`.
 */
class ReportDataSearch extends ReportData
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'department_code', 'created_by'], 'integer'],
            [['fullname', 'tabel', 'profession', 'date_of_birth', 'home_address', 'phone', 'diagnosis', 'date_informed', 'complain', 'date_analys_taken', 'date_analys_result', 'tah_taken_instution', 'datetime'], 'safe'],
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
        $query = ReportData::find();

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
            'department_code' => $this->department_code,
            'date_of_birth' => $this->date_of_birth,
            'date_informed' => $this->date_informed,
            'date_analys_taken' => $this->date_analys_taken,
            'date_analys_result' => $this->date_analys_result,
            'created_by' => $this->created_by,
            'datetime' => $this->datetime,
        ]);

        $query->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'tabel', $this->tabel])
            ->andFilterWhere(['like', 'profession', $this->profession])
            ->andFilterWhere(['like', 'home_address', $this->home_address])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'diagnosis', $this->diagnosis])
            ->andFilterWhere(['like', 'complain', $this->complain])
            ->andFilterWhere(['like', 'tah_taken_instution', $this->tah_taken_instution]);

        return $dataProvider;
    }
}
