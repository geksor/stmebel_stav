<?php
namespace frontend\controllers;

use common\models\Contact;
use common\models\AttrValue;
use common\models\Order;
use common\models\OrderItem;
use common\models\OrderOptCheckbox;
use common\models\OrderOptRbItem;
use common\models\OrderOptRbSec;
use common\models\Product;
use common\models\ProductAttr;
use frontend\models\OrderEnd;
use frontend\widgets\CartWidget;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\helpers\VarDumper;


/**
 * Site controller
 */
class CartController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($del = null, $prod_id = null, $count = null, $attrValue = null, $color = null, $checkBox = null, $radio = null)
    {
        if (Yii::$app->request->isPjax){
            $cartChange = Yii::$app->session->get('cart');

            if ($prod_id){
                $prod_attrValue = Json::decode($attrValue);
                $attrCheck = '';
                foreach ($prod_attrValue as $value){
                    $attrCheck .= $value;
                }

                foreach ($cartChange['items'] as $key => $item){
                    $attrChecked = '';
                    if (ArrayHelper::keyExists('prod_attrValue', $item)){
                        foreach ($item['prod_attrValue'] as $value){
                            $attrChecked .= $value;
                        }
                    }
                    if ($item['prod_id'] === $prod_id && (int)$attrCheck === (int)$attrChecked && $item['prod_color'] === $color){
                        if ($del){
                            unset($cartChange['items'][$key]);
                            $cartChange['item_count'] = $cartChange['item_count']-1;
                            $cartChange['prod_count'] = $cartChange['prod_count']-$count;
                            $cartChange['total_price'] = $cartChange['total_price']-$count*$item['prod_price'];
                        }else {
                            $cartChange['prod_count'] = $cartChange['prod_count']-$item['prod_count'];
                            $cartChange['total_price'] = $cartChange['total_price']-$item['prod_count']*$item['prod_price'];

                            $cartChange['items'][$key]['prod_id'] = $item['prod_id'];
                            $cartChange['items'][$key]['prod_price'] = $item['prod_price'];
                            $cartChange['items'][$key]['prod_count'] = $count;
                            $cartChange['items'][$key]['prod_attrValue'] = $item['prod_attrValue'];
                            $cartChange['items'][$key]['prod_color'] = $item['prod_color'];

                            $cartChange['prod_count'] = $cartChange['prod_count']+$count;
                            $cartChange['total_price'] = $cartChange['total_price']+$count*$item['prod_price'];

                        }
                        break;
                    }
                }
            }

            if ($checkBox){
                $cartChange['select_option']['checkbox'] = Json::decode($checkBox);
            }
            if ($radio){
                $cartChange['select_option']['radio'] = Json::decode($radio);
            }

            Yii::$app->session->set('cart', $cartChange);
        }

        $cart = Yii::$app->session->get('cart');
        $cartProduct = [];
        $totalPrice = 0;
        if ($cart){
            foreach ($cart['items'] as $item){
                /* @var $itemProd Product */
                $itemProd = Product::find()
                    ->where(['id' => $item['prod_id']])
                    ->one();
                $attrIds = [];
                foreach ($item['prod_attrValue'] as $attr_id){
                    $attrIds[] = $attr_id;
                }
                $itemAttrProd = ProductAttr::find()
                    ->where(['product_id' => $item['prod_id'], 'attrValue_id' => $attrIds])
                    ->with(['attrValue', 'attr'])
                    ->all();

                $cartProduct[] = [
                    'modelProduct' => $itemProd,
                    'modelProductAttr' => $itemAttrProd,
                    'count' => $item['prod_count'],
                    'color' => $item['prod_color'],
                    'attrValue' => $item['prod_attrValue'],
                ];

                $itemPrice = $itemProd->sale?$itemProd->getSaleCalcPrice($itemAttrProd):$itemProd->getCalcPrice($itemAttrProd);
                $totalPrice += $itemPrice*$item['prod_count'];
            }

            foreach ($cart['select_option']['checkbox'] as $checkbox){
                $addPrice = OrderOptCheckbox::findOne(['id' => (integer)$checkbox])->addPrice;
                $totalPrice += $addPrice;
            }

            foreach ($cart['select_option']['radio'] as $orderRadio){
                $addPrice = OrderOptRbItem::findOne(['id' => (integer)$orderRadio])->addPrice;
                $totalPrice += $addPrice;
            }
        }else{
            Yii::$app->session->setFlash('warning', 'Корзина пуста');
            return $this->redirect(Yii::$app->request->referrer);
        }

        if (empty($cartProduct)){
            Yii::$app->session->setFlash('warning', 'Корзина пуста');
            if (Yii::$app->request->pathInfo === Yii::$app->controller->id){
                return $this->redirect('/');
            }

            return $this->redirect(Yii::$app->request->referrer);
        }

        $orderCheckOptions = OrderOptCheckbox::find()->orderBy(['rank' => SORT_ASC])->all();
        $orderRadioOption = OrderOptRbSec::find()
            ->with(['orderOptRbItems' => function (\yii\db\ActiveQuery $query) {
                $query->orderBy(['rank' => SORT_ASC]);
            },])
            ->orderBy(['rank' => SORT_ASC])
            ->all();
//        VarDumper::dump($cartProduct,20,true);die;

        $cartOptCheckbox = Yii::$app->session->has('cart')?\yii\helpers\Json::encode(Yii::$app->session->get('cart')['select_option']['checkbox']):false;
        $cartOptRadio = Yii::$app->session->has('cart')?\yii\helpers\Json::encode(Yii::$app->session->get('cart')['select_option']['radio']):false;


        $orderForm = new OrderEnd();
        $orderForm->props_checkbox = $cartOptCheckbox;
        $orderForm->props_radiobutton = $cartOptRadio;
        $orderForm->products = Json::encode($cartProduct);
        $orderForm->total_price = $totalPrice;

        if (Yii::$app->request->isPjax){
            return $this->renderAjax('index', [
                'cartProduct' => $cartProduct,
                'totalPrice' => $totalPrice,
                'orderCheckOptions' => $orderCheckOptions,
                'orderRadioOption' => $orderRadioOption,
                'orderForm' => $orderForm,
                'cartOptCheckbox' => $cartOptCheckbox,
                'cartOptRadio' => $cartOptRadio,
            ]);
        }

        return $this->render('index', [
            'cartProduct' => $cartProduct,
            'totalPrice' => $totalPrice,
            'orderCheckOptions' => $orderCheckOptions,
            'orderRadioOption' => $orderRadioOption,
            'orderForm' => $orderForm,
            'cartOptCheckbox' => $cartOptCheckbox,
            'cartOptRadio' => $cartOptRadio,
        ]);
    }

    public function actionCartWidget()
    {
        return $this->renderAjax(CartWidget::widget());
    }

    public function actionSaveOrder()
    {
        $contactModel = new Contact();
        $contactModel->load(Yii::$app->params);
        $cartModel = new OrderEnd();

        if ($cartModel->load(Yii::$app->request->post())){

            $cartModel->props_checkbox = Json::decode($cartModel->props_checkbox);
            $cartModel->props_radiobutton = Json::decode($cartModel->props_radiobutton);
            $cartModel->products = Json::decode($cartModel->products);

            $order = new Order();

            $checkedOpt = [];

            foreach ($cartModel->props_checkbox as $checkbox_id){
                $checkedOpt[] = OrderOptCheckbox::findOne($checkbox_id)->title;
            }
            foreach ($cartModel->props_radiobutton as $radio_id){
                $rbItem = OrderOptRbItem::find()->where(['id' => $radio_id])->with(['section'])->one();
                $checkedOpt[] = $rbItem->section->title . ': ' . $rbItem->title;
            }

            $order->create_at = time();
            $order->checked_opt = Json::encode($checkedOpt);
            $order->customer_name = $cartModel->customer_name;
            $order->customer_phone = $cartModel->customer_phone;
            $order->customer_email = $cartModel->customer_email;
            $order->total_price = (integer)$cartModel->total_price;
            $order->state = 0;

            if ($order->save()){
                foreach ($cartModel->products as $product){
                    $modelProduct = Product::findOne($product['modelProduct']['id']); /* @var $modelProduct Product */

                    if ($modelProduct){
                        $orderItem = new OrderItem();

                        $prodAttr = [];

                        foreach ($product['attrValue'] as $attr_id){
                            $value = AttrValue::findOne($attr_id)->value;
                            $prodAttr[] = $value;
                        }

                        $orderItem->order_id = $order->id;
                        $orderItem->title = $modelProduct->title;
                        $orderItem->attr = Json::encode($prodAttr);
                        $orderItem->color = $product['color'];
                        $orderItem->count = (integer)$product['count'];
                        $orderItem->price = (integer)$modelProduct->getCalcPrice($product['modelProductAttr'], false);

                        $orderItem->save();
                    }
                }
                Yii::$app->session->destroy();
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. В ближайшее время с вами свяжется менеджер для подтверждения заказа.');
                if ($contactModel->chatId){
                    $message = "Новый заказ с сайта\n Имя: $order->customer_name \n Телефон: $order->customer_phone \n Сумма заказа: $order->total_price";
                    \Yii::$app->bot->sendMessage((integer)$contactModel->chatId, $message);
                }
                if ($contactModel->email) {
                    $order->sendEmail();
                }
            }else{
                Yii::$app->session->setFlash('error', 'Что то пошло не так. Попробуйте еще раз.');
            }
        }else{
            Yii::$app->session->setFlash('error', 'Что то пошло не так. Попробуйте еще раз.');
        }

        return $this->redirect('/');

    }
}
