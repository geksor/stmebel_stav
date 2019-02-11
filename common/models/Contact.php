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
 *
 * @property string $email
 * @property string $phone_1
 * @property string $phone_2
 * @property string $address
 * @property string $addressShort
 * @property string $mapScript
 *
 *
 * @property string $company_name
 * @property string $corpAddress
 * @property string $inn
 * @property string $kpp
 * @property string $ogrn
 *
 * @property string $insta
 * @property string $telegram
 * @property string $whatsApp
 *
 * @property int $chatId
 *
 * @property int $mo_sa
 * @property int $su
 * @property int $break
 */
class Contact extends Model
{
    public $title;
    public $meta_title;
    public $meta_description;

    public $email;
    public $phone_1;
    public $phone_2;
    public $address;
    public $addressShort;
    public $mapScript;

    public $company_name;
    public $corpAddress;
    public $inn;
    public $kpp;
    public $ogrn;

    public $insta;
    public $telegram;
    public $whatsApp;

    public $chatId;

    public $mo_sa;
    public $su;
    public $break;

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'meta_title',
                    'meta_description',

                    'email',
                    'phone_1',
                    'phone_2',
                    'address',
                    'addressShort',
                    'mapScript',

                    'company_name',
                    'corpAddress',
                    'inn',
                    'kpp',
                    'ogrn',

                    'insta',
                    'telegram',
                    'whatsApp',

                    'chatId',

                    'mo_sa',
                    'su',
                    'break',
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

            'email' => 'E-mail',
            'phone_1' => 'Телефон-1',
            'phone_2' => 'Телефон-2',
            'address' => 'Адрес',
            'addressShort' => 'Адрес в шапке сайта',
            'mapScript' => 'Код карты',

            'company_name' => 'Название фирмы',
            'corpAddress' => 'Юридический адрес',
            'inn' => 'ИНН',
            'kpp' => 'КПП',
            'ogrn' => 'ОГРН',

            'insta' => 'Инстаграмм (Ссылка на профиль)',
            'telegram' => 'Телеграм (Имя пользователя)',
            'whatsApp' => 'WhatsApp (Номер телефона без плюса только цифры начинать с 7)',

            'chatId' => 'ID чата',

            'mo_sa' => 'Пн-Вт',
            'su' => 'Воскресенье',
            'break' => 'Перерыв',
        ];
    }

    public function save($request){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = '{}';
        }
        $setPath = dirname(dirname(__DIR__)).'/common/config/contact.json';
        file_put_contents($setPath , $tempParams);
    }
}