<?php

namespace backend\models;

use yii\base\Model;
use Yii;

/**
 * Class Contact
 * @package backend\models
 *
 * @property int $homePagePartner_id
 * @property int $homePagePartner_count
 * @property int $pagePartner_id
 *
 * @property int $certificate_id
 *
 */
class SiteSettings extends Model
{
    public $homePagePartner_id;
    public $homePagePartner_count;
    public $pagePartner_id;

    public $certificate_id;

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
                ],
                'safe'
            ],
            [
                [
                    'homePagePartner_id',
                    'homePagePartner_count',
                    'pagePartner_id',

                    'certificate_id',
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
            'homePagePartner_id' => 'ID галлереи для вывода на главной',
            'homePagePartner_count' => 'Количество изображений на главной',
            'pagePartner_id' => 'ID галлереи для вывода на странице Партнеры',

            'certificate_id' => 'ID галлереи Сертификатов для вывода на странице',
        ];
    }

    public function save($request){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = '{}';
        }
        $setPath = dirname(dirname(__DIR__)).'/common/config/site-settings.json';
        file_put_contents($setPath , $tempParams);
    }
}