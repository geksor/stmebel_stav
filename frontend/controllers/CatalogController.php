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
    public function actionIndex($alias = null)
    {
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

            $query = Product::find()->where(['publish' => 1, 'id' => $prodArr])->orderBy(['rank' => SORT_ASC]);
        }else{
            $model = null;
            $query = Product::find()->where(['publish' => 1])->orderBy(['rank' => SORT_ASC]);
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
                    }
                    $itemsChild[] = [
                        'label' => $itemChild->title,
                        'url' => $itemChild->url,
                        'items' => $itemsChildChild,
                    ];
                }
            }
            $items[] = [
                'label' => $item->title,
                'url' => $item->url,
                'template' => '<a href="{url}">'.$item->image.'<h3>{label}</h3></a>',
                'items' => $itemsChild,
            ];
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
}
