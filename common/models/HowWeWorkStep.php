<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "howWeWorkStep".
 *
 * @property int $id
 * @property int $houWeWork_id
 * @property string $title
 * @property string $description
 * @property int $publish
 * @property int $rank
 *
 * @property HowWeWork $houWeWork
 */
class HowWeWorkStep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'howWeWorkStep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['houWeWork_id', 'title', 'description'], 'required'],
            [['houWeWork_id', 'publish', 'rank'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['houWeWork_id'], 'exist', 'skipOnError' => true, 'targetClass' => HowWeWork::className(), 'targetAttribute' => ['houWeWork_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'houWeWork_id' => 'Родительский раздел',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'publish' => 'Публикация',
            'rank' => 'Нумерация',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouWeWork()
    {
        return $this->hasOne(HowWeWork::className(), ['id' => 'houWeWork_id']);
    }
}
