<?php
namespace frontend\widgets;

use common\models\HowWeWork;
use common\models\WePartner;
use yii\base\Widget;

/**
 * Class PartnerWidget
 * @package frontend\widgets
 *
 * @property $modelId int (default = 1)
 * @property $imageCount int (default = 4)
 */

class PartnerWidget extends Widget
{
    public $modelId = 1;
    public $imageCount = 4;

    public function run()
    {
        $model = WePartner::findOne(['id' => $this->modelId]);

        return $this->render('partnerWidget', [
            'model' => $model,
            'imageCount' => $this->imageCount,
        ]);
    }
}