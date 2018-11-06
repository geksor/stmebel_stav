<?php

namespace backend\models;

use yii\base\Model;
use Yii;

/**
 * Class Contact
 * @package backend\models
 *
 * @property string $image1
 * @property string $text1
 * @property string $image2
 * @property string $text2
 * @property string $image3
 * @property string $text3
 * @property string $image4
 * @property string $text4
 */
class Advantage extends Model
{
    public $image1;
    public $text1;
    public $image2;
    public $text2;
    public $image3;
    public $text3;
    public $image4;
    public $text4;



    public function rules()
    {
        return [
            [
                [
                    'image1',
                    'text1',
                    'image2',
                    'text2',
                    'image3',
                    'text3',
                    'image4',
                    'text4',
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
            'image1' => 'Изображение',
            'text1' => 'Текст',
            'image2' => 'Изображение',
            'text2' => 'Текст',
            'image3' => 'Изображение',
            'text3' => 'Текст',
            'image4' => 'Изображение',
            'text4' => 'Текст',
        ];
    }

    public function save($request){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = '{}';
        }
        $setPath = dirname(dirname(__DIR__)).'/common/config/advantage.json';
        file_put_contents($setPath , $tempParams);
    }
}