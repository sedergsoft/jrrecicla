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
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        // 'user' => [
        //     'identityClass' => 'common\models\User',
        //     'enableAutoLogin' => true,
        //     'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        // ],
        'user' => [
            'identityClass' => 'yii2mod\user\models\UserModel',
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'enableAutoLogin' => false,
            // for update last login date for user, you can call the `afterLogin` event as follows
            'on afterLogin' => function ($event) {
                $event->identity->updateLastLogin();
            }
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
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
                'login'=>'site/login',
                'solicitudes/nuevas'=>'solicitud/nuevasolicitudes',
                'solicitudes/nueva'=>'solicitud/create',
                'solicitudes/todas'=>'solicitud/index',
                'solicitudes/aprobadas'=>'solicitud/aprobadas',
                'solicitudes/pendientes'=>'solicitud/pendiente',
                'solicitudes/rechazadas'=>'solicitud/rechazadas',
                'solicitudes/historial'=>'solicitud/historial',
                '<controller:[\w-]+>' => '<controller>/index',
                '<controller:[\w-]+>/<id:\d+>'=> '<controller>/view',
            ],
        ],
        
    ],
    'params' => $params,
];
