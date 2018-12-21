<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $create_at
 * @property string $checked_opt
 * @property string $customer_name
 * @property int $customer_phone
 * @property string $customer_email
 * @property int $total_price
 * @property int $state
 *
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_at', 'total_price', 'state'], 'integer'],
            [['checked_opt'], 'safe'],
            [['customer_name', 'customer_email', 'customer_phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_at' => 'Дата создания',
            'checked_opt' => 'Выбранные опции',
            'customer_name' => 'Имя покупателя',
            'customer_phone' => 'Телефон покупателя',
            'customer_email' => 'Email покупателя',
            'total_price' => 'Итого',
            'state' => 'Состояние заказа',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail()
    {
        $body = '<h1>Оформление заказа</h1>
                <p>
                    <a href="'. Yii::$app->request->hostInfo .'/admin/order/'. $this->id .'">Ссылка на заказ</a>
                </p>
                <h2>Информация</h2>
                <p> Дата оформления: '.Yii::$app->formatter->asDate($this->create_at, 'long').'</p>
                <p> Имя: '.$this->customer_name.'</p>
                <p> Телефон: '.$this->customer_phone . '</p>
                <p> Сумма заказа: '.$this->total_price . '</p>';

        return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['Contact']['email'])
            ->setFrom(['info@st-mebel.ru' => 'ST-mebel'])
            ->setSubject('Заказ с сайта: №'. $this->id)
            ->setHtmlBody($body)
            ->send();
    }
}
