<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
                    'class' => \yii\caching\FileCache::class,
                    ],
                    'i18n' => [
                        'translations' => [
                            'yii2mod.user' => [
                                'class' => 'yii\i18n\PhpMessageSource',
                                'basePath' => '@yii2mod/user/messages',
                            ],
                            'yii2mod.rbac' => [
                                'class' => 'yii\i18n\PhpMessageSource',
                                'basePath' => '@yii2mod/rbac/messages',
                            ],
                          
                        ],
                    ],
                    // 'formatter' => [
                    // 'currencyCode' => '$',
                    // //    'locale' => 'ru-RU',
                    //     'numberFormatterSymbols'=>'$',
                    //   ],
    ],
    'modules' => [
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
                    ],
            'gridview' => ['class' => 'kartik\grid\Module'],
          
    ]
];
