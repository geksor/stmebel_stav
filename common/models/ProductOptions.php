<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product_options".
 *
 * @property int $product_id
 * @property int $options_id
 * @property int $optionsValue_id
 * @property string $options_value
 * @property bool $is_list
 *
 * @property Options $options
 * @property Product $product
 * @property OptionsValue $optionsValue
 */
class ProductOptions extends \yii\db\ActiveRecord
{
    public $is_list;
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
            [['is_list'], 'boolean'],
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
    public function getOptionsValue()
    {
        return $this->hasOne(OptionsValue::className(), ['id' => 'optionsValue_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public static function getOptionsValueFromDropDown($opt_id)
    {
        if ($opt_id){
            return ArrayHelper::map(OptionsValue::find()->where(['options_id' => $opt_id])->all(), 'id', 'value');
        }
        return [];
    }

    public static function getOptionsFromDropDown($prod_id)
    {
        $categories = ArrayHelper::getColumn(Product::findOne($prod_id)->categories, 'id');

        $optionsId = ArrayHelper::getColumn(CategoryOptions::find()->where(['category_id' => $categories])->groupBy('options_id')->all(), 'options_id');

        return ArrayHelper::map(Options::find()->where(['id' => $optionsId])->all(), 'id', 'title');
    }

    public static function getOptionsFromSearchModel($prod_id)
    {
        $categories = ArrayHelper::getColumn(Product::findOne($prod_id)->categories, 'id');

        $optionsId = ArrayHelper::getColumn(CategoryOptions::find()->where(['category_id' => $categories])->groupBy('options_id')->all(), 'options_id');

        return $optionsId;
    }

}
