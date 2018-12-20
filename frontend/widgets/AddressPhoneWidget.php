<?php
namespace frontend\widgets;

use common\models\Contact;
use Yii;
use yii\base\Widget;

class AddressPhoneWidget extends Widget
{
    public function run()
    {
        $model = new Contact();
        $model->load(Yii::$app->params);

        return $this->render('address-phone-widget', [
            'model' => $model
        ]);
    }
}