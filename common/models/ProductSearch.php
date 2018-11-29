<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;
use yii\helpers\ArrayHelper;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'price', 'avail', 'unlimited', 'count', 'sale', 'hot', 'new', 'rank', 'publish', 'rating', 'reviews_count', 'hits', 'main_category', 'show_color',], 'integer'],
            [['title', 'code', 'short_description', 'description', 'meta_title', 'meta_description', 'alias', 'main_image', 'filterCat'], 'safe'],
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
        $query = Product::find();

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

        $filterId = $this->id;
        if ($this->filterCat){
            $prodId =  CategoryProduct::find()->where(['category_id' => $this->filterCat])->select('product_id')->asArray()->all();
            if (empty($prodId)){
                $filterId = 0;
            }else{
                $filterId = ArrayHelper::getColumn($prodId, 'product_id');
            }
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $filterId,
            'price' => $this->price,
            'avail' => $this->avail,
            'unlimited' => $this->unlimited,
            'count' => $this->count,
            'sale' => $this->sale,
            'hot' => $this->hot,
            'new' => $this->new,
            'rank' => $this->rank,
            'publish' => $this->publish,
            'rating' => $this->rating,
            'reviews_count' => $this->reviews_count,
            'hits' => $this->hits,
            'main_category' => $this->main_category,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'main_image', $this->main_image])
            ->andFilterWhere(['like', 'show_color', $this->show_color])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
