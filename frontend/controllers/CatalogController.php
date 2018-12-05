<?php
namespace frontend\controllers;

use common\models\Category;
use common\models\Product;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
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
        }else{
            $model = null;
            $query = Product::find()->where(['publish' => 1])->orderBy($prodOrder);
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



        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 9
        ]);
        $pages->pageSizeParam = false;
        $pages->forcePageParam = false;

        $products = $query
            ->with([
                'productOptionsList'  => function (\yii\db\ActiveQuery $query) {
                    $query->with(['options', 'optionsValue']);
                },
            ])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'model' => $model,
            'products' => $products,
            'pages' => $pages,
            'items' => $items
        ]);
    }

    public function actionItem($alias, $item)
    {
        $modelCat = Category::findOne(['alias' => $alias]);

        $model = Product::find()
            ->where(['alias' => $item])
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

    public function actionAddCart($prod_id, $prod_price, $prod_count)
    {
        $cart = Yii::$app->session->has('cart')
            ? Yii::$app->session->get('cart')
            : ['items' => [], 'item_count' => '0', 'total_price' => '0'];

        $prodAdd = true;
        foreach ($cart['items'] as $key => $item){
            if ($item['prod_id'] === $prod_id){
                $prodAdd = false;
                $cart['items'][$key]['prod_id'] = $item['prod_id'];
                $cart['items'][$key]['prod_price'] = $item['prod_price'];
                $cart['items'][$key]['prod_count'] = $item['prod_count'] + $prod_count;
                break;
            }
        }
        if ($prodAdd){
            $cart['items'][] = ['prod_id' => $prod_id, 'prod_price' => $prod_price, 'prod_count' => $prod_count];
        }
        $cart['item_count'] = $cart['item_count']+1;

        Yii::$app->session->set('cart', $cart);

        return $this->redirect(Yii::$app->request->referrer);
    }
}
