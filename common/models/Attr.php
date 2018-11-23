<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "attr".
 *
 * @property int $id
 * @property string $title
 * @property int $all_cats
 * @property int $rank
 * @property array $attrCat
 * @property array $selectedCats
 *
 * @property AttrValue[] $attrValues
 * @property CategoryAttr[] $categoryAttrs
 * @property Category[] $categories
 * @property ProductAttr[] $productAttrs
 * @property Product[] $products
 */
class Attr extends \yii\db\ActiveRecord
{
    public $attrCat;

    public function afterFind()
    {
        $this->attrCat = $this->selectedCats;
        parent::afterFind();
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['all_cats', 'rank'], 'integer'],
            [['rank'], 'default', 'value' => 1],
            [['title'], 'string', 'max' => 255],
            [['attrCat'], 'safe']
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
            'all_cats' => 'All Cats',
            'rank' => 'Rank',
        ];
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



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttrValues()
    {
        return $this->hasMany(AttrValue::className(), ['attr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttrs()
    {
        return $this->hasMany(CategoryAttr::className(), ['attr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('category_attr', ['attr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttrs()
    {
        return $this->hasMany(ProductAttr::className(), ['attr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('product_attr', ['attr_id' => 'id']);
    }

    public function saveCategories($cats = null)
    {
        CategoryAttr::deleteAll(['attr_id' => $this->id]);
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
        if ($this->all_cats){
            $this->saveCategories();
        }
        return parent::beforeSave($insert);
    }
}
