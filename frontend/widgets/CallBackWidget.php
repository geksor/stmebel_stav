<?php
namespace frontend\widgets;

use common\models\CallBack;
use yii\base\Widget;

class CallBackWidget extends Widget
{
    public function run()
    {
        $model = new CallBack();

        return $this->render('callBackWidget', [
            'model' => $model,
        ]);
    }
}