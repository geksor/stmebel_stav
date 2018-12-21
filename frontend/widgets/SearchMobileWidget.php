<?php
namespace frontend\widgets;

use common\models\CallBack;
use common\models\Category;
use common\models\Product;
use frontend\models\SiteSearch;
use yii\base\Widget;

class SearchMobileWidget extends Widget
{
    public function run()
    {
        $model = new SiteSearch();

        return $this->render('search-mobile-widget', [
            'model' => $model,
        ]);
    }
}