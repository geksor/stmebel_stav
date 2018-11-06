<?php
namespace frontend\widgets;

use backend\models\AboutHome;
use backend\models\AboutPage;
use yii\base\Widget;

class AboutPageWidget extends Widget
{
    public function run()
    {
        $model = new AboutPage();
        $model->load(\Yii::$app->params);


        return $this->render('about-pageWidget', [
            'model' => $model,
        ]);
    }
}