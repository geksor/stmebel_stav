<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "weDocs".
 *
 * @property int $id
 * @property string $docNameReal
 * @property string $docNameView
 * @property string $itemImage
 * @property string $itemDescription
 */
class WeDocs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weDocs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['docNameView'], 'required'],
            [['itemDescription'], 'string'],
            [['docNameReal', 'docNameView', 'itemImage'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'docNameReal' => 'Документ',
            'docNameView' => 'Выводимое имя',
            'itemImage' => 'Изображение',
            'itemDescription' => 'Описание',
        ];
    }
}
