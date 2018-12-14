<?php
namespace frontend\widgets;

use yii\base\Widget;

class CartWidget extends Widget
{
    public function run()
    {
        if (\Yii::$app->session->has('cart')){
            $cartArr = \Yii::$app->session->get('cart');
        }else{
            $cartArr = false;
        }
        return $this->render('cart-widget', [
            'cartArr' => $cartArr,
        ]);
    }
}