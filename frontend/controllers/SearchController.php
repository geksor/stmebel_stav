<?php
namespace frontend\controllers;

use backend\models\Contact;
use common\models\AttrValue;
use common\models\CallBack;
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
use yii\helpers\VarDumper;
use yii\web\Controller;

/**
 * Site controller
 */
class SearchController extends Controller
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

                $totalPrice += $itemProd->getCalcPrice($itemAttrProd)*$item['prod_count'];
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

}
