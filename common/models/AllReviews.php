<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "all_reviews".
 *
 * @property int $id
 * @property string $user_name
 * @property string $email
 * @property string $text
 * @property int $created_at
 * @property int $done_at
 * @property int $publish
 * @property int $viewed
 * @property string $lastName
 */
class AllReviews extends \yii\db\ActiveRecord
{
    public $lastName; /* Trap for bots */

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'all_reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'created_at'], 'required'],
            [['text'], 'string'],
            [['publish', 'viewed'], 'integer'],
            [['create_at', 'done_at',], 'safe'],
            [['user_name', 'email', 'lastName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'Имя',
            'email' => 'Email',
            'text' => 'Текст отзыва',
            'created_at' => 'Дата создания',
            'done_at' => 'Дата изменения',
            'publish' => 'Публикация',
            'viewed' => 'Viewed',
        ];
    }


    public function sendEmail()
    {
        $body = '<h1>Новый отзыв</h1>
                <p>
                    <a href="'. Yii::$app->request->hostInfo .'/admin/all-reviews/view/'. $this->id .'">Ссылка на отзыв</a>
                </p>
                <h2>Информация</h2>
                <p> ФИО: '.$this->user_name.'</p>
                <p> Текст отзыва: <br>'.$this->text . '</p>';

        return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['Contact']['email'])
            ->setFrom(['info@st-mebel.ru' => 'ST-mebel'])
            ->setSubject('Отзыв от: '. $this->user_name)
            ->setHtmlBody($body)
            ->send();
    }

    public function beforeSave($insert)
    {
        if ($this->created_at){

            $this->created_at =
                is_string($this->created_at)
                    ? strtotime($this->created_at)
                    : $this->created_at;
        }else{
            $this->created_at = time();
        }
        return parent::beforeSave($insert);
    }}
