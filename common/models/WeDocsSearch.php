<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WeDocs;

/**
 * WeDocsSearch represents the model behind the search form of `common\models\WeDocs`.
 */
class WeDocsSearch extends WeDocs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['docNameReal', 'docNameView', 'itemImage', 'itemDescription'], 'safe'],
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
        $query = WeDocs::find();

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

        $query->andFilterWhere(['like', 'docNameReal', $this->docNameReal])
            ->andFilterWhere(['like', 'docNameView', $this->docNameView])
            ->andFilterWhere(['like', 'itemImage', $this->itemImage])
            ->andFilterWhere(['like', 'itemDescription', $this->itemDescription]);

        return $dataProvider;
    }
}
