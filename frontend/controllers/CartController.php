<?php
namespace frontend\controllers;

use backend\models\Contact;
use common\models\CallBack;
use common\models\Product;
use common\models\ProductAttr;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;

/**
 * Site controller
 */
class CartController extends Controller
{

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)//Обязательно нужно отключить Csr валидацию, так не будет работать
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

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
    public function actionIndex()
    {
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
                ];

                $totalPrice += $itemProd->getCalcPrice($itemAttrProd)*$item['prod_count'];
            }
        }
//        VarDumper::dump($cartProduct,20,true);die;
        return $this->render('index', [
            'cartProduct' => $cartProduct,
            'totalPrice' => $totalPrice,
        ]);
    }
}
