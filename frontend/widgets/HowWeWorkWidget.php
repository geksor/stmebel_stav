<?php
namespace frontend\widgets;

use common\models\HowWeWork;
use yii\base\Widget;

/**
 * Class HowWeWorkWidget
 * @package frontend\widgets
 *
 * @property $modelId int (default = 1)
 */

class HowWeWorkWidget extends Widget
{
    public $modelId = 1;

    public function run()
    {
        $model = HowWeWork::find()
            ->with([
                'howWeWorkSteps' => function (\yii\db\ActiveQuery $query){
                    $query->andWhere(['publish' => 1])->orderBy('rank');
                }
            ]
            )->where(['id' => $this->modelId])->one();

        return $this->render('howWeWorkWidget', [
            'model' => $model,
        ]);
    }
}