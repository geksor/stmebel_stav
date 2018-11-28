<?php
namespace frontend\widgets;

use common\models\Category;
use yii\base\Widget;

class CategoryForMainWidget extends Widget
{
    public function run()
    {
        $models = Category::find()->where(['publish' => 1, 'view_from_main' => 1])->orderBy(['rank' => SORT_ASC])->limit(11)->all();

        return $this->render('categoryForMainWidget', [
            'models' => $models,
        ]);
    }
}