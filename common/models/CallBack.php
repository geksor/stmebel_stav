<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "callBack".
 *
 * @property int $id
 * @property int $created_at
 * @property int $done_at
 * @property int $viewed
 * @property string $name
 * @property string $phone
 * @property string $lastName
 */
class CallBack extends \yii\db\ActiveRecord
{
    public $lastName;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'callBack';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'name'], 'required'],
            [['created_at', 'done_at', 'viewed'], 'integer'],
            [['name', 'phone', 'lastName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата заявки',
            'done_at' => 'Дата обработки',
            'viewed' => 'Состояние',
            'name' => 'Имя',
            'phone' => 'Телефон',
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
        $body = '<h1>Запрос обратного звонка</h1>
                <p>
                    <a href="'. Yii::$app->request->hostInfo .'/admin/call-back/view/'. $this->id .'">Ссылка на запрос</a>
                </p>
                <h2>Информация</h2>
                <p> Дата запроса: '.Yii::$app->formatter->asDate($this->created_at, 'long').'</p>
                <p> Время запроса: '.Yii::$app->formatter->asTime($this->created_at).'</p>
                <p> Имя: '.$this->name.'</p>
                <p> Телефон: '.$this->phone . '</p>';

        return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['Contact']['email'])
            ->setFrom(['info@st-mebel.ru' => 'ST-mebel'])
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
        return parent::beforeSave($insert);
    }
}
