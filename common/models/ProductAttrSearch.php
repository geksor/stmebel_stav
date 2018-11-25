<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductAttr;

/**
 * ProductAttrSearch represents the model behind the search form of `common\models\ProductAttr`.
 */
class ProductAttrSearch extends ProductAttr
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'attr_id', 'attrValue_id', 'price_mod', 'add_price'], 'integer'],
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
        $query = ProductAttr::find();

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

        $query->where(['attr_id' => $this::getAttrFromSearchModel($this->product_id)]);

        // grid filtering conditions
        $query->andFilterWhere([
            'product_id' => $this->product_id,
            'attr_id' => $this->attr_id,
            'attrValue_id' => $this->attrValue_id,
            'price_mod' => $this->price_mod,
            'add_price' => $this->add_price,
        ]);

        return $dataProvider;
    }
}
