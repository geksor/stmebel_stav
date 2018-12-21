<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "optionsValue".
 *
 * @property int $id
 * @property int $options_id
 * @property string $value
 *
 * @property Options $options
 */
class OptionsValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'optionsValue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['options_id'], 'required'],
            [['options_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['options_id'], 'exist', 'skipOnError' => true, 'targetClass' => Options::className(), 'targetAttribute' => ['options_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'options_id' => 'Характеристика',
            'value' => 'Значение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasOne(Options::className(), ['id' => 'options_id']);
    }
}
