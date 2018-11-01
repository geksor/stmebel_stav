<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "callBack".
 *
 * @property int $id
 * @property int $created_at
 * @property int $done_at
 * @property int $viewed
 * @property string $name
 * @property string $phone
 */
class CallBack extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'callBack';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'required'],
            [['created_at', 'done_at', 'viewed'], 'integer'],
            [['name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата заявки',
            'done_at' => 'Дата обработки',
            'viewed' => 'Состояние',
            'name' => 'Имя',
            'phone' => 'Телефон',
        ];
    }
}
