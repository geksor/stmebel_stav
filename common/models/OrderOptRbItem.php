<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_opt_rb_item".
 *
 * @property int $id
 * @property int $section_id
 * @property string $title
 * @property int $addPrice
 * @property int $rank
 *
 * @property OrderOptRbSec $section
 */
class OrderOptRbItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_opt_rb_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['section_id'], 'required'],
            [['section_id', 'addPrice', 'rank'], 'integer'],
            [['rank'], 'default', 'value' => 100],
            [['title'], 'string', 'max' => 255],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderOptRbSec::className(), 'targetAttribute' => ['section_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'section_id' => 'Группа',
            'title' => 'Название',
            'addPrice' => 'Добавить к цене',
            'rank' => 'Порядок вывода',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(OrderOptRbSec::className(), ['id' => 'section_id']);
    }
}
