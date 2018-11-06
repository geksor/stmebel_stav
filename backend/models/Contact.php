<?php

namespace backend\models;

use yii\base\Model;
use Yii;

/**
 * Class Contact
 * @package backend\models
 *
 * @property string $email
 * @property string $phone_1
 * @property string $phone_2
 * @property string $address
 * @property string $coordinate_N
 * @property string $coordinate_E
 * @property string $companyType
 * @property string $company_name
 * @property string $corpAddress
 * @property string $inn
 * @property string $kpp
 * @property string $ogrn
 * @property string $bank
 */
class Contact extends Model
{
    public $email;
    public $phone_1;
    public $phone_2;
    public $address;
    public $coordinate_N;
    public $coordinate_E;

    public $companyType;
    public $company_name;
    public $corpAddress;
    public $inn;
    public $kpp;
    public $ogrn;
    public $bank;



    public function rules()
    {
        return [
            [
                [
                    'email',
                    'phone_1',
                    'phone_2',
                    'address',
                    'coordinate_N',
                    'coordinate_E',
                    'companyType',
                    'company_name',
                    'corpAddress',
                    'inn',
                    'kpp',
                    'ogrn',
                    'bank',
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
            'email' => 'E-mail',
            'phone_1' => 'Телефон-1',
            'phone_2' => 'Телефон-2',
            'address' => 'Адрес',
            'coordinate_N' => 'Координаты широта',
            'coordinate_E' => 'Координаты долгота',
            'companyType' => 'Тип фирмы',
            'company_name' => 'Название фирмы',
            'corpAddress' => 'Юридический адрес',
            'inn' => 'ИНН',
            'kpp' => 'КПП',
            'ogrn' => 'ОГРН',
            'bank' => 'Банк',
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