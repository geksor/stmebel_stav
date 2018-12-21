<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int $product_id
 * @property string $user_name
 * @property string $email
 * @property string $text
 * @property int $created_at
 * @property int $done_at
 * @property int $publish
 * @property int $viewed
 *
 * @property Product $product
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'user_name', 'created_at'], 'required'],
            [['product_id', 'created_at', 'done_at', 'publish', 'viewed'], 'integer'],
            [['text'], 'string'],
            [['user_name', 'email'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Для товара',
            'user_name' => 'Имя',
            'email' => 'Email',
            'text' => 'Текст Отзыва',
            'created_at' => 'Дата создания',
            'done_at' => 'Дата изменения',
            'publish' => 'Публикация',
            'viewed' => 'Viewed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
