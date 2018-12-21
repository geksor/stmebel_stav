<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'homeUrl' => '/',
    'components' => [
        'view' => [
            'class' => 'frontend\components\View',
        ],
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/catalog/add-cart' => 'catalog/add-cart',
                '/catalog/calc-price' => 'catalog/calc-price',
                '/catalog/<alias>/page/<page:\d+>' => 'catalog/index',
                '/catalog/<alias>/sort/<orderPrice:\d+>' => 'catalog/index',
                '/catalog/sort/<orderPrice:\d+>' => 'catalog/index',

                '/catalog/<alias>' => 'catalog/index',
                '/catalog/<alias>/<item>' => 'catalog/item',
                '<controller:catalog>' => 'catalog/index',
                '<controller:cart>' => '<controller>/index',
                '<controller:reviews>' => '<controller>/index',

                '/' => 'site/index',
                '<action:\w+>' => 'site/<action>',

            ],
        ],
    ],
    'params' => $params,
    'language' => 'ru-RU',
];
