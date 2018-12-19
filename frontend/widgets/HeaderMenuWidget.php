<?php
namespace frontend\widgets;

use yii\base\Widget;

class HeaderMenuWidget extends Widget
{
    public function run()
    {
        return $this->render('headerMenuWidget');
    }
}