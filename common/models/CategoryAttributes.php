<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_attributes".
 *
 * @property int $category_id
 * @property int $attributes_id
 *
 * @property Attributes $attributes0
 * @property Category $category
 */
class CategoryAttributes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'attributes_id'], 'required'],
            [['category_id', 'attributes_id'], 'integer'],
            [['category_id', 'attributes_id'], 'unique', 'targetAttribute' => ['category_id', 'attributes_id']],
            [['attributes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attributes::className(), 'targetAttribute' => ['attributes_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'attributes_id' => 'Attributes ID',
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
