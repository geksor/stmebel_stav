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
    public function actionIndex($alias, $child)
    {
        $model = Category::find()
            ->where(['alias' => $alias])
            ->with([
                'child' => function (\yii\db\ActiveQuery $query){
                    $query->andWhere(['publish' => 1])->orderBy(['rank' => SORT_ASC]);
                },
            ])
            ->one();

        if (!$openCat = Category::find()->where(['alias' => $child])->with('categoryProducts')->one()){
            return $this->redirect('/');
        }
        $prodArr = ArrayHelper::getColumn($openCat->categoryProducts, 'product_id');

        $query = Product::find()->where(['publish' => 1, 'id' => $prodArr])->orderBy(['rank' => SORT_ASC]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 9
        ]);
        $pages->pageSizeParam = false;
        $pages->forcePageParam = false;

        $products = $query->with(['attributesOrder', 'productAttributesRank'])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'model' => $model,
            'products' => $products,
            'pages' => $pages,
            'child' => $child,
        ]);
    }

    public function actionItem($alias, $child, $item)
    {
        $modelCat = Category::findOne(['alias' => $child]);
        $model = Product::find()
            ->where(['alias' => $item])
            ->with(['attributesOrder', 'productAttributesRank'])
            ->one();

        return $this->render('item', [
            'model' => $model,
            'modelCat' => $modelCat,
            'alias' => $alias,
        ]);
    }

}
