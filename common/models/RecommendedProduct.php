<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "recommended_product".
 *
 * @property int $product_id
 * @property int $recommProduct_id
 *
 * @property Product $product
 * @property Product $recommProduct
 */
class RecommendedProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recommended_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'recommProduct_id'], 'required'],
            [['product_id', 'recommProduct_id'], 'integer'],
            [['product_id', 'recommProduct_id'], 'unique', 'targetAttribute' => ['product_id', 'recommProduct_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['recommProduct_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['recommProduct_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Товар',
            'recommProduct_id' => 'Рекомендуемый товар',
        ];
    }

    public static function getSelectedProdId($prod_id)
    {
        return ArrayHelper::getColumn(self::findAll(['product_id' => $prod_id]), 'recommProduct_id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'recommProduct_id']);
    }
}
