<?php
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'ecg-sermons',
    'name' => 'Sermons',
    'language' => 'de',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
            ],
        ],
        'request' => [
            'class' => '\yii\web\Request',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCookieValidation' => false,
        ],
        'log' => [
            'traceLevel' => 3,
            'targets' => [
                [
                    'class' => 'yii\log\SyslogTarget',
                    'levels' => ['error', 'warning'],
                    'except' => [
                        'yii\web\HttpException:404',
                        'yii\web\HttpException:403',
                    ],

                ],
                [
                    'class' => 'app\components\DatadogTarget',
                    'levels' => ['error', 'warning'],
                    'except' => [
                        'yii\web\HttpException:404',
                        'yii\web\HttpException:403',
                    ],
                    'tags' => ['bko'],
                    'apiKey' => $params['datadog']['apiKey'],
                    'appKey' => $params['datadog']['appKey'],

                ],

            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];


if (YII_DEBUG === true) {
    $debug = require(__DIR__ . '/debug.php');
    $config = \yii\helpers\ArrayHelper::merge($config, $debug);
    $config['components']['log']['targets'][] = [
        'class' => 'yii\log\FileTarget',
        'levels' => ['info']
    ];
}
return $config;
