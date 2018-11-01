<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "personal".
 *
 * @property int $id
 * @property string $name
 * @property string $position
 * @property string $image
 * @property int $publish
 */
class Personal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['publish'], 'integer'],
            [['name', 'position', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'position' => 'Должность',
            'image' => 'Фото',
            'publish' => 'Публикация',
        ];
    }
}
