<?php
namespace frontend\widgets;

use yii\base\Widget;

class ModalsWidget extends Widget
{
    public function run()
    {
        return $this->render('modals-widget');
    }
}