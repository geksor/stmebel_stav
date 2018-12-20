<?php
namespace frontend\widgets;

use common\models\CallBack;
use common\models\Category;
use common\models\Product;
use frontend\models\SiteSearch;
use yii\base\Widget;

class SearchWidget extends Widget
{
    public function run()
    {
        $selectBox = Product::getCatFromDropDown();
        $model = new SiteSearch();

        return $this->render('search-widget', [
            'selectBox' => $selectBox,
            'model' => $model,
        ]);
    }
}