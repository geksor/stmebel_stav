<?php

namespace backend\models;

use yii\base\Model;
use Yii;

/**
 * Class Contact
 * @package backend\models
 *
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $blockTitle_1
 * @property string $blockDesc_1
 * @property string $blockTitle_2
 * @property string $blockDesc_2
 * @property string $blockTitle_3
 * @property string $blockDesc_3
 */
class AboutHome extends Model
{
    public $title;
    public $description;
    public $image;
    public $blockTitle_1;
    public $blockDesc_1;
    public $blockTitle_2;
    public $blockDesc_2;
    public $blockTitle_3;
    public $blockDesc_3;



    public function rules()
    {
        return [
            [
                [
                    'title',
                    'description',
                    'image',
                    'blockTitle_1',
                    'blockDesc_1',
                    'blockTitle_2',
                    'blockDesc_2',
                    'blockTitle_3',
                    'blockDesc_3',
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
            'title' => 'Заголовок',
            'description' => 'Текст',
            'image' => 'Изображение',
            'blockTitle_1' => 'Заголовок',
            'blockDesc_1' => 'Текст',
            'blockTitle_2' => 'Заголовок',
            'blockDesc_2' => 'Текст',
            'blockTitle_3' => 'Заголовок',
            'blockDesc_3' => 'Текст',
        ];
    }

    public function save($request){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = '{}';
        }
        $setPath = dirname(dirname(__DIR__)).'/common/config/about-home.json';
        file_put_contents($setPath , $tempParams);
    }
}