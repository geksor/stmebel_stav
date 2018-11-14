<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@uploads'   => '@frontend/web/uploads',
    ],
    'name' => 'Bro & Bro',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'yandexMapsApi' => [
            'class' => 'mirocow\yandexmaps\Api',
        ],
    ],
    'modules' => [
        'stat' => [
            'class' => akiraz2\stat\Module::className(),
//            'yandexMetrika' => [ // false by default
//                'id' => 13788753,
//                'params' => [
//                    'clickmap' => true,
//                    'trackLinks' => true,
//                    'accurateTrackBounce' => true,
//                    'webvisor' => true
//                ]
//            ],
//            'googleAnalytics' => [ // false by default
//                'id' => 'UA-114443409-2',
//            ],
            'ownStat' => true, //false by default
            'ownStatCookieId' => 'yii2_counter_id', // 'yii2_counter_id' default
            'onlyGuestUsers' => true, // true default
            'countBot' => false, // false default
            'appId' => ['app-frontend'], // by default count visits only from Frontend App (in backend app we dont need it)
            'blackIpList' => [] // ['127.0.0.1'] by default
        ],
     ],
];
