<?php
namespace frontend\widgets;

use common\models\Category;
use common\models\Product;
use yii\base\Widget;
use yii\helpers\VarDumper;

class ProductsForMainWidget extends Widget
{
    public function run()
    {
        $modelsHot = Product::find()
            ->where(['publish' => 1, 'hot' => 1])
            ->orderBy(['rank' => SORT_ASC])
//            ->with([
//                'productOptionsList'  => function (\yii\db\ActiveQuery $query) {
//                    $query->with(['options', 'optionsValue']);
//                },
//            ])
            ->all();
        $modelsNew = Product::find()
            ->where(['publish' => 1, 'new' => 1])
            ->orderBy(['rank' => SORT_ASC])
//            ->with([
//                'productOptionsList'  => function (\yii\db\ActiveQuery $query) {
//                    $query->with(['options', 'optionsValue']);
//                },
//            ])
            ->all();
        $modelsSale = Product::find()
            ->where(['publish' => 1])
            ->andWhere(['not in', 'sale', 'null'])
            ->orderBy(['rank' => SORT_ASC])
//            ->with([
//                'productOptionsList'  => function (\yii\db\ActiveQuery $query) {
//                    $query->with(['options', 'optionsValue']);
//                },
//            ])
            ->all();

        return $this->render('products-for-mainWidget', [
            'modelsHot' => $modelsHot,
            'modelsNew' => $modelsNew,
            'modelsSale' => $modelsSale,
        ]);
    }
}