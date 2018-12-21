<?php
namespace frontend\widgets;

use yii\base\Widget;

class FooterMenuWidget extends Widget
{
    public function run()
    {
        return $this->render('footer-menu-widget');
    }
}