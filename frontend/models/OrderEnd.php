<?php
namespace frontend\models;

use yii\base\Model;

/**
 * Signup form
 */
class OrderEnd extends Model
{
    public $customer_name;
    public $customer_phone;
    public $customer_email;
    public $props_checkbox;
    public $props_radiobutton;
    public $products;
    public $total_price;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['customer_name', 'trim'],
            ['customer_name', 'required'],
            ['customer_name', 'string', 'min' => 2, 'max' => 255],

            ['customer_phone', 'trim'],
            ['customer_phone', 'required'],
            ['customer_phone', 'string', 'max' => 255],

            ['customer_email', 'trim'],
            ['customer_email', 'email'],
            ['customer_email', 'required'],
            ['customer_email', 'string', 'max' => 255],

            [['props_checkbox', 'props_radiobutton', 'products', 'total_price'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_name' => 'Имя',
            'customer_phone' => 'Телефон',
            'customer_email' => 'E-mail',
        ];
    }


}
