<?php
namespace frontend\widgets;

use backend\models\AboutHome;
use yii\base\Widget;

class AboutHomeWidget extends Widget
{
    public function run()
    {
        $model = new AboutHome();
        $model->load(\Yii::$app->params);


        return $this->render('about-homeWidget', [
            'model' => $model,
        ]);
    }
}