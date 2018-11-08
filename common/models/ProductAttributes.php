<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_attributes".
 *
 * @property int $product_id
 * @property int $attributes_id
 * @property int $attrList_id
 * @property int $attrColor_id
 * @property string $attrString
 *
 * @property Attributes $attributes0
 * @property Product $product
 */
class ProductAttributes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'attributes_id'], 'required'],
            [['product_id', 'attributes_id', 'attrList_id'], 'integer'],
            [['attrString', 'attrColor_id'], 'string', 'max' => 255],
            [['product_id', 'attributes_id'], 'unique', 'targetAttribute' => ['product_id', 'attributes_id']],
            [['attributes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attributes::className(), 'targetAttribute' => ['attributes_id' => 'id']],
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
            'attributes_id' => 'Attributes ID',
            'attrList_id' => 'Attr List ID',
            'attrColor_id' => 'Attr Color ID',
            'attrString' => 'Attr String',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this->hasOne(Attributes::className(), ['id' => 'attributes_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
