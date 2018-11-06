<?php
namespace frontend\widgets;

use backend\models\AboutHome;
use backend\models\Advantage;
use yii\base\Widget;

class AdvantageWidget extends Widget
{
    public function run()
    {
        $model = new Advantage();
        $model->load(\Yii::$app->params);


        return $this->render('advantageWidget', [
            'model' => $model,
        ]);
    }
}