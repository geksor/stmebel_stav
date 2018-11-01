<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "howWeWork".
 *
 * @property int $id
 * @property string $title
 *
 * @property HowWeWorkStep[] $howWeWorkSteps
 */
class HowWeWork extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'howWeWork';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHowWeWorkSteps()
    {
        return $this->hasMany(HowWeWorkStep::className(), ['houWeWork_id' => 'id']);
    }
}
