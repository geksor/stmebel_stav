<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_opt_checkbox".
 *
 * @property int $id
 * @property string $title
 * @property int $addPrice
 * @property int $rank
 */
class OrderOptCheckbox extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_opt_checkbox';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['addPrice', 'rank'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['rank'], 'default', 'value' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'addPrice' => 'Add Price',
            'rank' => 'Rank',
        ];
    }
}
