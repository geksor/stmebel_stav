<?php
namespace frontend\widgets;

use common\models\Personal;
use yii\base\Widget;

class TeamWidget extends Widget
{
    public function run()
    {
        $model = Personal::find()
            ->where(['publish' => 1])
            ->all();

        return $this->render('teamWidget', [
            'model' => $model,
        ]);
    }
}