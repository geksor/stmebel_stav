<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_options".
 *
 * @property int $product_id
 * @property int $options_id
 * @property int $optionsValue_id
 * @property string $options_value
 *
 * @property Options $options
 * @property Product $product
 */
class ProductOptions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'options_id'], 'required'],
            [['product_id', 'options_id', 'optionsValue_id'], 'integer'],
            [['options_value'], 'string', 'max' => 255],
            [['product_id', 'options_id'], 'unique', 'targetAttribute' => ['product_id', 'options_id']],
            [['options_id'], 'exist', 'skipOnError' => true, 'targetClass' => Options::className(), 'targetAttribute' => ['options_id' => 'id']],
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
            'options_id' => 'Options ID',
            'optionsValue_id' => 'Options Value ID',
            'options_value' => 'Options Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasOne(Options::className(), ['id' => 'options_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
