<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductOptions;

/**
 * ProductOptionsSearch represents the model behind the search form of `common\models\ProductOptions`.
 */
class ProductOptionsSearch extends ProductOptions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'options_id', 'optionsValue_id'], 'integer'],
            [['options_value'], 'safe'],
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
        $query = ProductOptions::find();

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
            'product_id' => $this->product_id,
            'options_id' => $this->options_id,
            'optionsValue_id' => $this->optionsValue_id,
        ]);

        $query->andFilterWhere(['like', 'options_value', $this->options_value]);

        return $dataProvider;
    }
}
