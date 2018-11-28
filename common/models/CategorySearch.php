<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Category;

/**
 * CategorySearch represents the model behind the search form of `common\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'rank', 'publish', 'view_from_main'], 'integer'],
            [['title', 'meta_title', 'meta_description', 'description', 'alias', 'image', 'show_opt_to_product_list', 'show_opt_to_product_card', 'show_opt_to_cart'], 'safe'],
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
        $query = Category::find();

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
            'parent_id' => $this->parent_id,
            'rank' => $this->rank,
            'publish' => $this->publish,
            'view_from_main' => $this->view_from_main,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'show_opt_to_product_list', $this->show_opt_to_product_list])
            ->andFilterWhere(['like', 'show_opt_to_product_card', $this->show_opt_to_product_card])
            ->andFilterWhere(['like', 'show_opt_to_cart', $this->show_opt_to_cart]);

        return $dataProvider;
    }
}
