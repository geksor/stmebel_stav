<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $created_at
 * @property int $done_at
 * @property int $viewed
 * @property string $user_name
 * @property string $text
 * @property string $email
 * @property int $publish
 * @property int $agree
 * @property string $name
 */
class Comment extends \yii\db\ActiveRecord
{
    public $agree = 1;
    public $name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'user_name', 'email'], 'required'],
            [['viewed', 'publish'], 'integer'],
            [['created_at', 'done_at'], 'safe'],
            [['text', 'name'], 'string'],
            ['agree', 'compare', 'compareValue' => 1, 'message' => 'Для отправки отзыва необходимо согласиться с обработкой персональных данных.'],
            [['email'], 'email'],
            [['user_name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'done_at' => 'Дата изменения',
            'viewed' => 'Просмотрен',
            'user_name' => 'ФИО',
            'text' => 'Текст отзыва',
            'email' => 'Email',
            'publish' => 'Состояние',
            'agree' => 'Согласие на обработку данных',
            'name' => 'Имя'
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail()
    {
        $body = '<h1>Новый отзыв</h1>
                <p>
                    <a href="'. Yii::$app->request->hostInfo .'/admin/comment/view/'. $this->id .'">Ссылка на отзыв</a>
                </p>
                <h2>Информация</h2>
                <p> ФИО: '.$this->user_name.'</p>
                <p> Текст отзыва: <br>'.$this->text . '</p>';

        return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['Contact']['email'])
            ->setFrom(['info@smak05.ru' => 'SMAK'])
            ->setSubject('Заявка на запись от: '. $this->name)
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
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

}
