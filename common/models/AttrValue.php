<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attrValue".
 *
 * @property int $id
 * @property int $attr_id
 * @property string $value
 * @property int $rank
 *
 * @property Attr $attr
 * @property ProductAttr[] $productAttrs
 */
class AttrValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attrValue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attr_id', 'value'], 'required'],
            [['rank'], 'default', 'value' => 1],
            [['attr_id', 'rank'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attr::className(), 'targetAttribute' => ['attr_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attr_id' => 'Атрибут',
            'value' => 'Значение атрибута',
            'rank' => 'Прядок вывода',
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
    public function getProductAttrs()
    {
        return $this->hasMany(ProductAttr::className(), ['attrValue_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if ($this->productAttrs){
            foreach ($this->productAttrs as $productAttr){
                if ($productAttr->rank !== $this->rank){
                    $productAttr->rank = $this->rank;
                    $productAttr->save();
                }
            }
        }
        return parent::beforeSave($insert);
    }
}
