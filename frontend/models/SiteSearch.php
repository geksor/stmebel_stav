<?php

namespace frontend\models;

use common\models\Category;
use common\models\CategoryProduct;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;
use yii\helpers\ArrayHelper;

/* @property string $filterCatTitle */

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class SiteSearch extends Product
{
    public $filterCatTitle;
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
        $query = Product::find()->where(['publish' => 1]);

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
            $this->filterCatTitle = Category::findOne($this->filterCat)->title;
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
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->orFilterWhere(['like', 'short_description', $this->title])
            ->orFilterWhere(['like', 'description', $this->title])
            ->orFilterWhere(['like', 'code', $this->title]);

        return $dataProvider;
    }
}
