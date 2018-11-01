<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attrColor".
 *
 * @property int $id
 * @property int $attr_id
 * @property string $title
 * @property string $color
 *
 * @property Attributes $attr
 */
class AttrColor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attrColor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attr_id', 'title', 'color'], 'required'],
            [['attr_id'], 'integer'],
            [['title', 'color'], 'string', 'max' => 255],
            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attributes::className(), 'targetAttribute' => ['attr_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attr_id' => 'Элемент атрибута',
            'title' => 'Заголовок',
            'color' => 'Цвет',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttr()
    {
        return $this->hasOne(Attributes::className(), ['id' => 'attr_id']);
    }
}
