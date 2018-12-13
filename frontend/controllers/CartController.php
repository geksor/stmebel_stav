<?php
namespace frontend\controllers;

use backend\models\Contact;
use common\models\CallBack;
use common\models\OrderOptCheckbox;
use common\models\OrderOptRbSec;
use common\models\Product;
use common\models\ProductAttr;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
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
    public function actionIndex($prod_id = null, $count = null, $attrValue = null, $color = null)
    {
        if (Yii::$app->request->isPjax){
            $cartChange = Yii::$app->session->get('cart');

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
                    $cartChange['items'][$key]['prod_id'] = $item['prod_id'];
                    $cartChange['items'][$key]['prod_price'] = $item['prod_price'];
                    $cartChange['items'][$key]['prod_count'] = $count;
                    $cartChange['items'][$key]['prod_attrValue'] = $item['prod_attrValue'];
                    $cartChange['items'][$key]['prod_color'] = $item['prod_color'];
                    break;
                }
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
        }

        $orderCheckOptions = OrderOptCheckbox::find()->orderBy(['rank' => SORT_ASC])->all();
        $orderRadioOption = OrderOptRbSec::find()
            ->with(['orderOptRbItems' => function (\yii\db\ActiveQuery $query) {
                $query->orderBy(['rank' => SORT_ASC]);
            },])
            ->orderBy(['rank' => SORT_ASC])
            ->all();
//        VarDumper::dump($cartProduct,20,true);die;

        if (Yii::$app->request->isPjax){
            return $this->renderAjax('index', [
                'cartProduct' => $cartProduct,
                'totalPrice' => $totalPrice,
                'orderCheckOptions' => $orderCheckOptions,
                'orderRadioOption' => $orderRadioOption,
            ]);
        }

        return $this->render('index', [
            'cartProduct' => $cartProduct,
            'totalPrice' => $totalPrice,
            'orderCheckOptions' => $orderCheckOptions,
            'orderRadioOption' => $orderRadioOption,
        ]);
    }

    public function actionCalcPrice($prod_id, $count, $attrValue = null, $color = null)
    {
        $cartChange = Yii::$app->session->get('cart');

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
                $cartChange['items'][$key]['prod_id'] = $item['prod_id'];
                $cartChange['items'][$key]['prod_price'] = $item['prod_price'];
                $cartChange['items'][$key]['prod_count'] = $count;
                $cartChange['items'][$key]['prod_attrValue'] = $item['prod_attrValue'];
                $cartChange['items'][$key]['prod_color'] = $item['prod_color'];
                break;
            }
        }

        Yii::$app->session->set('cart', $cartChange);

        return $this->redirect('/cart');
    }
}
