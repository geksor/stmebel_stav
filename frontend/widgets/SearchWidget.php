<?php
namespace frontend\widgets;

use common\models\CallBack;
use common\models\Category;
use common\models\Product;
use yii\base\Widget;

class SearchWidget extends Widget
{
    public function run()
    {
        $selectBox = Product::getCatFromDropDown();

        return $this->render('search-widget', [
            'selectBox' => $selectBox,
        ]);
    }
}