<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Inicio', 'url' => ['/site/index']],
       
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    }else{
        if(Yii::$app->user->identity->rolid == "1")//menu que se muestra para el usuario SuperAdmin
                {
                $menuItems[] = ['label' => 'Gestionar',
                                    'items' =>[
                                                    ['label' => 'Grupos Hoteleros', 'url' => ['/grupo-hotelero/index']],
                                                    ['label' => 'Cargos', 'url' => ['/cargos/index']],
                                                    ['label' => 'Clientes', 'url' => ['/cliente/index']],
                                                    ['label' => 'Tipo de Productos', 'url' => ['/tipo-producto/index']],
                                                    ['label' => 'Productos', 'url' => ['/productos/index']],
                                                    ['label' => 'Solicitudes', 'url' => ['/solicitud/index']],
                                                    ['label' => 'Transportistas', 'url' => ['/transportista/index']],
                                        
                                              ]
                               ];
                $menuItems[] = ['label' => 'Solicitudes',
                            'items' =>[
               
                                              ['label' => 'Nuevas Solicitudes', 'url' => ['/solicitudes/nuevas']],
                                              ['label' => 'Solicitudes Aprobadas', 'url' => ['/solicitudes/aprobadas']],
                                              ['label' => 'Solicitudes Pendientes', 'url' => ['/solicitudes/pendientes']],
                                              ['label' => 'Solicitudes Rechazadas', 'url' => ['/solicitudes/rechazadas']],
                                              ['label' => 'Historial ', 'url' => ['/solicitudes/historial']],
                                              ],
                    //             ['label' => 'Elemento', 'url' => ['/elemento/index']],
                                 //['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                    //  ]
                       ];
            
                
               $menuItems[] = ['label' => 'Reportes',
                            'items' =>[
                              //['label' => 'Información General por Empresa', 'url' => ['/reporte/general']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                      ]
                       ];
                $menuItems[] = ['label' => 'Seguridad',
                            'items' =>[
                                  ['label' => 'Usuarios', 'url' => ['/user/index']],
                //                 ['label' => 'Asignar Permisos', 'url' => ['/rbac/assignment']],
                                  ['label'=> 'Cambiar contraseña' , 'url' => ['/user/password','id'=> Yii::$app->user->getId()]],
                            //    ['label'=> 'Base de datos' , 'url' => ['/backuprestore/index']],
                                
                               ]]; 
                $menuItems[] = ['label' => 'Ayuda',
                            'items' =>[
                                ['label' => 'Manual de Usurio', 'url' => ['/site/manual']],
                                  ['label' => 'Documentos Rectores', 'url' => ['/documentos/index']],
                //                 ['label' => 'Asignar Permisos', 'url' => ['/rbac/assignment']],
                                 // ['label'=> 'Cambiar contraseña' , 'url' => ['/user/password','id'=> Yii::$app->user->getId()]],
                            //    ['label'=> 'Base de datos' , 'url' => ['/backuprestore/index']],
                                
                               ]]; 
     
                 
             
                                 
             }  
             if(Yii::$app->user->identity->rolid == "2")//menu que se muestra para el usuario SuperAdmin
             {
            //  $menuItems[] = ['label' => 'Gestionar',
            //                      'items' =>[
            //                                      ['label' => 'Grupos Hoteleros', 'url' => ['/grupo-hotelero/index']],
            //                                      ['label' => 'Cargos', 'url' => ['/cargos/index']],
            //                                      ['label' => 'Clientes', 'url' => ['/cliente/index']],
            //                                      ['label' => 'Tipo de Productos', 'url' => ['/tipo-producto/index']],
            //                                      ['label' => 'Productos', 'url' => ['/productos/index']],
            //                                      ['label' => 'Solicitudes', 'url' => ['/solicitud/index']],
            //                                      ['label' => 'Transportistas', 'url' => ['/transportista/index']],
                                     
            //                                ]
            //                 ];
             $menuItems[] = ['label' => 'Solicitudes',
                         'items' =>[
            
                                        ['label' => 'Ver Solicitudes', 'url' => ['/solicitudes/todas']],
                                        ['label' => 'Nueva Solicitud', 'url' => ['/solicitudes/nueva']],
                                        ['label' => 'Solicitudes Aprobadas', 'url' => ['/solicitudes/aprobadas']],
                                        ['label' => 'Solicitudes Pendientes', 'url' => ['/solicitudes/pendientes']],
                                        ['label' => 'Solicitudes Rechazadas', 'url' => ['/solicitudes/rechazadas']],
                                        ['label' => 'Historial ', 'url' => ['/solicitudes/historial']],
                                    ],
                 //             ['label' => 'Elemento', 'url' => ['/elemento/index']],
                              //['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                              // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                 //  ]
                    ];
         
             
            $menuItems[] = ['label' => 'Reportes',
                         'items' =>[
                           //['label' => 'Información General por Empresa', 'url' => ['/reporte/general']],
                              // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                   ]
                    ];
             $menuItems[] = ['label' => 'Seguridad',
                         'items' =>[
                              // ['label' => 'Usuarios', 'url' => ['/user/index']],
             //                 ['label' => 'Asignar Permisos', 'url' => ['/rbac/assignment']],
                               ['label'=> 'Cambiar contraseña' , 'url' => ['/user/password','id'=> Yii::$app->user->getId()]],
                         //    ['label'=> 'Base de datos' , 'url' => ['/backuprestore/index']],
                             
                            ]]; 
             $menuItems[] = ['label' => 'Ayuda',
                         'items' =>[
                             ['label' => 'Manual de Usurio', 'url' => ['/site/manual']],
                               ['label' => 'Documentos Rectores', 'url' => ['/documentos/index']],
             //                 ['label' => 'Asignar Permisos', 'url' => ['/rbac/assignment']],
                              // ['label'=> 'Cambiar contraseña' , 'url' => ['/user/password','id'=> Yii::$app->user->getId()]],
                         //    ['label'=> 'Base de datos' , 'url' => ['/backuprestore/index']],
                             
                            ]]; 
  
              
          
                              
          }                    
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
