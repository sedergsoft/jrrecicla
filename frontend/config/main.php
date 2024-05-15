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
        'view'=>[
            'theme'=>[
                'pathMap'=>[
                    '@app/views'=>'@frontend/theme/adminLTE3/views'
                    //  '@app/views' => '@vendor/hail812/yii2-adminlte3/src/views'
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
          //  'defaultRoles' => ['instalacion', 'gestor'],
        ],
        
    ],
    
    'modules' => [
        'audit' => [
              'class' => 'bedezign\yii2\audit\Audit',
              // the layout that should be applied for views within this module
              'layout' => 'main',
              // Name of the component to use for database access
              'db' => 'db', 
              // List of actions to track. '*' is allowed as the last character to use as wildcard
              'trackActions' => ['*'], 
              // Actions to ignore. '*' is allowed as the last character to use as wildcard (eg 'debug/*')
              'ignoreActions' => ['audit/*', 'debug/*','site/error','site/index'],
              // Maximum age (in days) of the audit entries before they are truncated
              'maxAge' => 'debug',
              // IP address or list of IP addresses with access to the viewer, null for everyone (if the IP matches)
              'accessIps' => ['127.0.0.1', '192.168.*'], 
              // Role or list of roles with access to the viewer, null for everyone (if the user matches)
              'accessRoles' => ['SiteAdmin'],
              // User ID or list of user IDs with access to the viewer, null for everyone (if the role matches)
              'accessUsers' => ['*'],
              // Compress extra data generated or just keep in text? For people who don't like binary data in the DB
              'compressData' => true,
              // The callback to use to convert a user id into an identifier (username, email, ...). Can also be html.
              'userIdentifierCallback' => ['common\models\User', 'userIdentifierCallback'],
              // If the value is a simple string, it is the identifier of an internal to activate (with default settings)
              // If the entry is a '<key>' => '<string>|<array>' it is a new panel. It can optionally override a core panel or add a new one.
              'panels' => [
                  'audit/request',
                  'audit/error',
                 //'audit/curl',
                  'audit/trail',
                  'app/views' => [
                      'class' => 'bedezign\yii2\audit\panels\ViewsPanel',
                      // ...
                  ],
              ],
              'panelsMerge' => [
                 // ... merge data (see below)
              ]
          ],
          'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],
      ],
    
   
    'params' => $params,
];
