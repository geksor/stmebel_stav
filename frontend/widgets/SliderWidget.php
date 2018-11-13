<?php
namespace frontend\widgets;

use common\models\Category;
use common\models\Slider;
use yii\base\Widget;

/**
 * Class SliderWidget
 * @package frontend\widgets
 *
 * @property int $sliderId
 */
class SliderWidget extends Widget
{
    public $sliderId = 1;

    public function run()
    {
        $model = Slider::findOne(['id' => $this->sliderId]);

        return $this->render('sliderWidget', [
            'model' => $model,
        ]);
    }
}