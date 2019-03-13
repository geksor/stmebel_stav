<?php

namespace common\models;

use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class Contact
 * @package backend\models
 *
 * @property string $title_home
 * @property string $meta_title
 * @property string $meta_description
 * @property int $slider
 *
 */
class SiteSettings extends Model
{
    public $title_home;
    public $meta_title;
    public $meta_description;
    public $slider;

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
                    'title_home',
                    'meta_title',
                    'meta_description',
                ],
                'safe'
            ],
            [
                [
                    'slider',
                ],
                'integer'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title_home' => 'Заголовок главной страницы',
            'meta_title' => 'Meta-title по умолчанию',
            'meta_description' => 'Meta-description по умолчанию',
            'slider' => 'Слайдер на главную'
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
        $setPath = dirname(dirname(__DIR__)) . '/common/config/site-settings.json';
        file_put_contents($setPath , $tempParams);
    }
}