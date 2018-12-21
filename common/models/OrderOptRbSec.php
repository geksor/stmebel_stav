<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_opt_rb_sec".
 *
 * @property int $id
 * @property string $title
 * @property int $rank
 *
 * @property OrderOptRbItem[] $orderOptRbItems
 */
class OrderOptRbSec extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_opt_rb_sec';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rank'], 'integer'],
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
            'title' => 'Заголовок',
            'rank' => 'Порядок вывода',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderOptRbItems()
    {
        return $this->hasMany(OrderOptRbItem::className(), ['section_id' => 'id']);
    }
}
