<?php

namespace common\models;

use yii\base\Model;
use Yii;

/**
 * Class Contact
 * @package backend\models
 *
 * @property string $title
 * @property string $meta_title
 * @property string $meta_description
 * @property string $description
 */
class AboutPage extends Model
{
    public $title;
    public $meta_title;
    public $meta_description;
    public $description;



    public function rules()
    {
        return [
            [
                [
                    'title',
                    'meta_title',
                    'meta_description',
                    'description',
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
            'meta_title' => 'Meta-title',
            'meta_description' => 'Meta-description',
            'description' => 'Текст',
        ];
    }

    public function save($request){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = '{}';
        }
        $setPath = dirname(dirname(__DIR__)) . '/common/config/about-page.json';
        file_put_contents($setPath , $tempParams);
    }
}