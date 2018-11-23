<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attr".
 *
 * @property int $id
 * @property string $title
 * @property int $all_cats
 * @property int $rank
 *
 * @property AttrValue[] $attrValues
 * @property CategoryAttr[] $categoryAttrs
 * @property Category[] $categories
 * @property ProductAttr[] $productAttrs
 * @property Product[] $products
 */
class Attr extends \yii\db\ActiveRecord
{
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
            [['title'], 'string', 'max' => 255],
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
}
