<?php

namespace common\models;

use yii\base\Model;
use Yii;

/**
 * Class DeliveryPage
 * @package backend\models
 *
 * @property string $one_title
 * @property string $two_title
 * @property string $three_title
 *
 * @property string $one_image
 * @property string $two_image
 * @property string $three_image
 *
 * @property string $one_text
 * @property string $two_text
 * @property string $three_text
 *
 */
class ThreeBlock extends Model
{
    public $one_title;
    public $two_title;
    public $three_title;

    public $one_image;
    public $two_image;
    public $three_image;

    public $one_text;
    public $two_text;
    public $three_text;

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
                    'one_title',
                    'two_title',
                    'three_title',
                    'one_image',
                    'two_image',
                    'three_image',
                    'one_text',
                    'two_text',
                    'three_text',
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
            'one_title' => 'Заголовок блока',
            'two_title' => 'Заголовок блока',
            'three_title' => 'Заголовок блока',
            'one_image' => 'Изображение блока',
            'two_image' => 'Изображение блока',
            'three_image' => 'Изображение блока',
            'one_text' => 'Текст блока',
            'two_text' => 'Текст блока',
            'three_text' => 'Текст блока',
        ];
    }

    public function save($request){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = '{}';
        }
        $setPath = dirname(dirname(__DIR__)) . '/common/config/three-block.json';
        file_put_contents($setPath , $tempParams);
    }
}