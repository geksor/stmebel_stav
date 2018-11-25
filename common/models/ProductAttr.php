<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product_attr".
 *
 * @property int $product_id
 * @property int $attr_id
 * @property int $attrValue_id
 * @property int $price_mod
 * @property int $add_price
 *
 * @property AttrValue $attrValue
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
            [['product_id', 'attr_id', 'attrValue_id'], 'unique', 'targetAttribute' => ['product_id', 'attr_id', 'attrValue_id']],
            [['attrValue_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttrValue::className(), 'targetAttribute' => ['attrValue_id' => 'id']],
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
    public function getAttrValue()
    {
        return $this->hasOne(AttrValue::className(), ['id' => 'attrValue_id']);
    }

    /**
     * @param $attr_id
     * @return array
     */
    public static function getAttrValueFromDropDown($attr_id)
    {
        if ($attr_id){
            return ArrayHelper::map(AttrValue::find()->where(['attr_id' => $attr_id])->all(), 'id', 'value');
        }
        return [];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttr()
    {
        return $this->hasOne(Attr::className(), ['id' => 'attr_id']);
    }

    public static function getAttrFromDropDown($prod_id)
    {
        $categories = ArrayHelper::getColumn(Product::findOne($prod_id)->categories, 'id');

        $attrsId = ArrayHelper::getColumn(CategoryAttr::find()->where(['category_id' => $categories])->groupBy('attr_id')->all(), 'attr_id');

        return ArrayHelper::map(Attr::find()->where(['id' => $attrsId])->all(), 'id', 'title');
    }

    public static function getAttrFromSearchModel($prod_id)
    {
        $categories = ArrayHelper::getColumn(Product::findOne($prod_id)->categories, 'id');

        $attrsId = ArrayHelper::getColumn(CategoryAttr::find()->where(['category_id' => $categories])->groupBy('attr_id')->all(), 'attr_id');

        return $attrsId;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
