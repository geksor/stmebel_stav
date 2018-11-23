<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_attr".
 *
 * @property int $category_id
 * @property int $attr_id
 *
 * @property Attr $attr
 * @property Category $category
 */
class CategoryAttr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_attr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'attr_id'], 'required'],
            [['category_id', 'attr_id'], 'integer'],
            [['category_id', 'attr_id'], 'unique', 'targetAttribute' => ['category_id', 'attr_id']],
            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attr::className(), 'targetAttribute' => ['attr_id' => 'id']],
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
            'attr_id' => 'Attr ID',
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
