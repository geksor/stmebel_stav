<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

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
            [['id', 'rank', 'publish'], 'integer'],
            [['title', 'short_description', 'description', 'filterCat'], 'safe'],
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
            'rank' => $this->rank,
            'publish' => $this->publish,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'description', $this->description]);

        $query->orderBy(['rank' => SORT_ASC]);

        return $dataProvider;
    }
}
