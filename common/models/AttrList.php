<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attrList".
 *
 * @property int $id
 * @property int $attr_id
 * @property string $title
 *
 * @property Attributes $attr
 */
class AttrList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attrList';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attr_id', 'title'], 'required'],
            [['attr_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'title' => 'Значение атрибута',
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
