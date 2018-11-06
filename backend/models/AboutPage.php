<?php

namespace backend\models;

use yii\base\Model;
use Yii;

/**
 * Class Contact
 * @package backend\models
 *
 * @property string $description
 * @property string $image
 */
class AboutPage extends Model
{
    public $description;
    public $image;



    public function rules()
    {
        return [
            [
                [
                    'description',
                    'image',
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
            'description' => 'Текст',
            'image' => 'Изображение',
        ];
    }

    public function save($request){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = '{}';
        }
        $setPath = dirname(dirname(__DIR__)).'/common/config/about-page.json';
        file_put_contents($setPath , $tempParams);
    }
}