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
use common\models\SiteSettings;
use frontend\models\OrderEnd;
use frontend\models\SiteSearch;
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SiteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        VarDumper::dump($searchModel->title, 20,true);die;

        $products = $dataProvider->getModels();

        $siteSettings = new SiteSettings();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'products' => $products,
            'siteSettings' => $siteSettings,
        ]);
    }

}
