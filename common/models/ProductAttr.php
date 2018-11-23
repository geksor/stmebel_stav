<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_attr".
 *
 * @property int $product_id
 * @property int $attr_id
 * @property int $attrValue_id
 * @property int $price_mod
 * @property int $add_price
 *
 * @property Attr $attr
 * @property Product $product
 */
class ProductAttr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_attr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'attr_id', 'attrValue_id', 'price_mod', 'add_price'], 'required'],
            [['product_id', 'attr_id', 'attrValue_id', 'price_mod', 'add_price'], 'integer'],
            [['product_id', 'attr_id'], 'unique', 'targetAttribute' => ['product_id', 'attr_id']],
            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attr::className(), 'targetAttribute' => ['attr_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'attr_id' => 'Attr ID',
            'attrValue_id' => 'Attr Value ID',
            'price_mod' => 'Price Mod',
            'add_price' => 'Add Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttr()
    {
        return $this->hasOne(Attr::className(), ['id' => 'attr_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
