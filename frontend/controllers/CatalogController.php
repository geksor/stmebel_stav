<?php
namespace frontend\controllers;

use common\models\Category;
use common\models\Product;
use frontend\widgets\CartWidget;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\Controller;

/**
 * Site controller
 */
class CatalogController extends Controller
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
     * @param $alias
     * @return string
     *
     */
    public function actionIndex($alias = null, $orderPrice = null)
    {
        $prodOrder = ['rank' => SORT_ASC];
        if ((integer)$orderPrice === 1){
            $prodOrder = ['price' => SORT_DESC];
        }
        if ((integer)$orderPrice === 2){
            $prodOrder = ['price' => SORT_ASC];
        }
        if ($alias) {
            $model = Category::find()
                ->where(['alias' => $alias])
                ->with([
                    'child' => function (\yii\db\ActiveQuery $query) {
                        $query->andWhere(['publish' => 1])->orderBy(['rank' => SORT_ASC]);
                    },
                ])
                ->one();

            $prodArr = ArrayHelper::getColumn($model->categoryProducts, 'product_id');

            $query = Product::find()->where(['publish' => 1, 'id' => $prodArr])->orderBy($prodOrder);

            $categories = null;
        }else{
            $model = null;
            $query = null;
            $categories = Category::find()->where(['publish' => 1])->orderBy(['rank' => SORT_ASC])->all();
        }

        $modelsFromLeft = Category::find()
            ->where(['parent_id' => 0, 'publish' => 1])
            ->with([
                'child' => function (\yii\db\ActiveQuery $query) {
                    $query
                        ->andWhere(['publish' => 1])->orderBy(['rank' => SORT_ASC])
                        ->with([
                            'child' => function (\yii\db\ActiveQuery $query) {
                                $query->andWhere(['publish' => 1])->orderBy(['rank' => SORT_ASC]);
                            },
                        ]);
                },
            ])
            ->orderBy(['rank' => SORT_ASC])
            ->all();

        $items = [];

        foreach ($modelsFromLeft as $item){
            /* @var $item Category */
            $itemsChild = [];

            if ($item->child){
                foreach ($item->child as $itemChild){
                    /* @var $itemChild Category */
                    if ($itemChild->child){
                        foreach ($itemChild->child as $itemChildChild){
                            /* @var $itemChildChild Category */
                            $itemsChildChild[] = [
                                'label' => $itemChildChild->title,
                                'url' => $itemChildChild->url,
                            ];
                        }
                        $itemsChild[] = [
                            'label' => $itemChild->title,
                            'url' => $itemChild->url,
                            'items' => $itemsChildChild,
                        ];
                    }else{
                        $itemsChild[] = [
                            'label' => $itemChild->title,
                            'url' => $itemChild->url,
                        ];
                    }
                }
                $items[] = [
                    'label' => $item->title,
                    'url' => $item->url,
                    'template' => '<a href="{url}">'.$item->image.'<h3>{label}</h3></a>',
                    'items' => $itemsChild,
                ];

            }else{
                $items[] = [
                    'label' => $item->title,
                    'url' => $item->url,
                    'template' => '<a href="{url}">'.$item->image.'<h3>{label}</h3></a>',
                ];
            }
        }



//        $countQuery = clone $query;
//        $pages = new Pagination([
//            'totalCount' => $countQuery->count(),
//            'pageSize' => 9
//        ]);
//        $pages->pageSizeParam = false;
//        $pages->forcePageParam = false;

        if ($query){
            $products = $query
                ->with([
                    'productOptionsList'  => function (\yii\db\ActiveQuery $query) {
                        $query->with(['options', 'optionsValue']);
                    },
                ])
//            ->offset($pages->offset)
//            ->limit($pages->limit)
                ->all();
        }else{
            $products = null;
        }

        return $this->render('index', [
            'model' => $model,
            'products' => $products,
//            'pages' => $pages,
            'items' => $items,
            'categories' => $categories,
        ]);
    }

    public function actionItem($alias, $item)
    {
        $modelCat = Category::findOne(['alias' => $alias]);

        $model = Product::find()
            ->where(['alias' => $item])
            ->with([
                'productAttrsCats'  => function (\yii\db\ActiveQuery $query) {
                    $query
                        ->with(['attrValue', 'attr'])
                        ->orderBy(['rank' => SORT_ASC]);
                },
            ])
            ->with([
                'attrsCats'  => function (\yii\db\ActiveQuery $query) {
                    $query->orderBy(['rank' => SORT_ASC]);
                },
            ])
            ->with([
                'productOptionsShort'  => function (\yii\db\ActiveQuery $query) {
                    $query->with(['options', 'optionsValue']);
                },
            ])
            ->with([
                'productOptionsAll'  => function (\yii\db\ActiveQuery $query) {
                    $query->with(['options', 'optionsValue']);
                },
            ])
            ->with(['productImages', 'recommProducts'  => function (\yii\db\ActiveQuery $query) {
                $query->with([
                    'productOptionsList'  => function (\yii\db\ActiveQuery $query) {
                        $query->with(['options', 'optionsValue']);
                    },
                ]);
            },])
            ->one();


        return $this->render('item', [
            'model' => $model,
            'modelCat' => $modelCat,
        ]);
    }

    public function actionAddCart($prod_id, $prod_price, $prod_count, $prod_attrValue, $prodColor)
    {
        $cart = Yii::$app->session->has('cart')
            ? Yii::$app->session->get('cart')
            : ['items' => [], 'item_count' => '0', 'prod_count' => '0', 'total_price' => '0', 'select_option' => ['checkbox' => [], 'radio' => []]];

        $prod_attrValue = Json::decode($prod_attrValue);
        $attrCheck = '';
        foreach ($prod_attrValue as $value){
            $attrCheck .= $value;
        }

        $prodAdd = true;
        foreach ($cart['items'] as $key => $item){
            $attrChecked = '';
            if (ArrayHelper::keyExists('prod_attrValue', $item)){
                foreach ($item['prod_attrValue'] as $value){
                    $attrChecked .= $value;
                }
            }
            if ($item['prod_id'] === $prod_id && (int)$attrCheck === (int)$attrChecked && $item['prod_color'] === $prodColor){
                $prodAdd = false;
                $cart['items'][$key]['prod_id'] = $item['prod_id'];
                $cart['items'][$key]['prod_price'] = $item['prod_price'];
                $cart['items'][$key]['prod_count'] = $item['prod_count'] + $prod_count;
                $cart['items'][$key]['prod_attrValue'] = $item['prod_attrValue'];
                $cart['items'][$key]['prod_color'] = $item['prod_color'];
                break;
            }
        }
        if ($prodAdd){
            $cart['items'][] = [
                'prod_id' => $prod_id,
                'prod_price' => $prod_price,
                'prod_count' => $prod_count,
                'prod_attrValue' => $prod_attrValue,
                'prod_color' => $prodColor,
            ];
            $cart['item_count'] = $cart['item_count']+1;
        }
        $cart['prod_count'] = $cart['prod_count']+$prod_count;
        $cart['total_price'] = $cart['total_price']+$prod_count*$prod_price;

        Yii::$app->session->set('cart', $cart);
//        Yii::$app->session->destroy();
        Yii::$app->session->setFlash('success', 'Товар добавлен в корзину');

        return $this->renderAjax(CartWidget::widget());
    }

    public $valuesId;
    public $attrsId;

    public function actionCalcPrice($id, $attrsId, $valuesId)
    {
        if ($attrsId && $valuesId){
            $this->valuesId = Json::decode($valuesId);
            $this->attrsId = Json::decode($attrsId);

            $model = Product::find()
                ->where(['id' => $id])
                ->with([
                    'productAttrs' => function (\yii\db\ActiveQuery $query) {
                        $query->andWhere(['attr_id' => $this->attrsId, 'attrValue_id' => $this->valuesId]);
                    },
                ])
                ->one();


            return $this->renderAjax('price', [
                'model' => $model,
            ]);

        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
