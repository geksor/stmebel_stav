<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property string $title
 * @property int $type
 * @property int $allCats
 * @property int $rank
 * @property array $optCat
 * @property array $selectedCats
 *
 * @property CategoryOptions[] $categoryOptions
 * @property Category[] $categories
 * @property OptionsValue[] $optionsValues
 * @property ProductOptions[] $productOptions
 * @property Product[] $products
 */
class Options extends \yii\db\ActiveRecord
{
    public $optCat;

    public function afterFind()
    {
        $this->optCat = $this->selectedCats;
        parent::afterFind();
    }

    /**
     * @return array
     */
    public function getSelectedCats()
    {
        $selectedCats = $this->getCategories()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedCats, 'id');
    }

    /**
     * @return array
     */
    public static function getCatFromDropDown()
    {
        return ArrayHelper::map(Category::find()->all(), 'id', 'title');
    }

    public function saveCategories($cats = null)
    {
        CategoryOptions::deleteAll(['options_id' => $this->id]);
        if (is_array($cats))
        {
            $categoryModels = Category::find()->where(['id' => $cats])->all();
        }else{
            $categoryModels = Category::find()->all();
        }
        foreach ($categoryModels as $category)
        {
            $this->link('categories', $category);
        }

    }

    public function beforeSave($insert)
    {
        if ($this->allCats){
            $this->saveCategories();
        }
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'allCats', 'rank'], 'integer'],
            [['rank'], 'default', 'value' => 1],
            [['title'], 'string', 'max' => 255],
            [['optCat'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'type' => 'Type',
            'allCats' => 'All Cats',
            'rank' => 'Rank',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryOptions()
    {
        return $this->hasMany(CategoryOptions::className(), ['options_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('category_options', ['options_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionsValues()
    {
        return $this->hasMany(OptionsValue::className(), ['options_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptions()
    {
        return $this->hasMany(ProductOptions::className(), ['options_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('product_options', ['options_id' => 'id']);
    }
}
