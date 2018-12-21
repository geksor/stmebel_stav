<?php

namespace common\models;

use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class DeliveryPage
 * @package backend\models
 *
 * @property string $title
 * @property string $meta_title
 * @property string $meta_description
 * @property string $pageCode
 *
 */
class AgreePage extends Model
{
    public $title;
    public $meta_title;
    public $meta_description;
    public $pageCode;

    public function init()
    {
        parent::init();
        $this->load(Yii::$app->params);
    }

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'meta_title',
                    'meta_description',
                    'pageCode',
                ],
                'safe'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок страницы',
            'meta_title' => 'Meta-title по умолчанию',
            'meta_description' => 'Meta-description по умолчанию',
            'pageCode' => 'Код страницы',
        ];
    }

    public function getSliderFromDropDown()
    {
        return ArrayHelper::map(Slider::find()->all(), 'id', 'title');
    }

    public function save($request){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = '{}';
        }
        $setPath = dirname(dirname(__DIR__)) . '/common/config/agree-page.json';
        file_put_contents($setPath , $tempParams);
    }
}