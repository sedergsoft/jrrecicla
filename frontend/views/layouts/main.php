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
<div id="main-wrapper">

<!--**********************************
    Nav header start
***********************************-->
<div class="nav-header">
    <a href="index.html" class="brand-logo">
        <img class="logo-abbr" src="./theme/images/logo.png" alt="">
        <img class="logo-compact" src="./theme/images/logo-text.png" alt="">
        <img class="brand-title" src="./theme/images/logo-text.png" alt="">
    </a>

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->

<!--**********************************
    Header start
***********************************-->
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="search_bar dropdown">
                        <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                            <i class="mdi mdi-magnify"></i>
                        </span>
                        <div class="dropdown-menu p-0 m-0">
                            <form>
                                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                            </form>
                        </div>
                    </div>
                </div>

                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <i class="mdi mdi-bell"></i>
                            <div class="pulse-css"></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="list-unstyled">
                                <li class="media dropdown-item">
                                    <span class="success"><i class="ti-user"></i></span>
                                    <div class="media-body">
                                        <a href="#">
                                            <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully
                                            </p>
                                        </a>
                                    </div>
                                    <span class="notify-time">3:20 am</span>
                                </li>
                                <li class="media dropdown-item">
                                    <span class="primary"><i class="ti-shopping-cart"></i></span>
                                    <div class="media-body">
                                        <a href="#">
                                            <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                        </a>
                                    </div>
                                    <span class="notify-time">3:20 am</span>
                                </li>
                                <li class="media dropdown-item">
                                    <span class="danger"><i class="ti-bookmark"></i></span>
                                    <div class="media-body">
                                        <a href="#">
                                            <p><strong>Robin</strong> marked a <strong>ticket</strong> as unsolved.
                                            </p>
                                        </a>
                                    </div>
                                    <span class="notify-time">3:20 am</span>
                                </li>
                                <li class="media dropdown-item">
                                    <span class="primary"><i class="ti-heart"></i></span>
                                    <div class="media-body">
                                        <a href="#">
                                            <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                        </a>
                                    </div>
                                    <span class="notify-time">3:20 am</span>
                                </li>
                                <li class="media dropdown-item">
                                    <span class="success"><i class="ti-image"></i></span>
                                    <div class="media-body">
                                        <a href="#">
                                            <p><strong> James.</strong> has added a<strong>customer</strong> Successfully
                                            </p>
                                        </a>
                                    </div>
                                    <span class="notify-time">3:20 am</span>
                                </li>
                            </ul>
                            <a class="all-notification" href="#">See all notifications <i
                                    class="ti-arrow-right"></i></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <i class="mdi mdi-account"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="./theme/app-profile.html" class="dropdown-item">
                                <i class="icon-user"></i>
                                <span class="ml-2">Profile </span>
                            </a>
                            <a href="./theme/email-inbox.html" class="dropdown-item">
                                <i class="icon-envelope-open"></i>
                                <span class="ml-2">Inbox </span>
                            </a>
                            <a href="./theme/page-login.html" class="dropdown-item">
                                <i class="icon-key"></i>
                                <span class="ml-2">Logout </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!--**********************************
    Header end ti-comment-alt
***********************************-->

<!--**********************************
    Sidebar start
***********************************-->
<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                <ul aria-expanded="false">
                    <li><a href="./theme/index.html">Dashboard 1</a></li>
                    <li><a href="./theme/index2.html">Dashboard 2</a></li>
                </ul>
            </li>
            <li class="nav-label">Apps</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-app-store"></i><span class="nav-text">Apps</span></a>
                <ul aria-expanded="false">
                    <li><a href="./theme/app-profile.html">Profile</a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                        <ul aria-expanded="false">
                            <li><a href="./theme/email-compose.html">Compose</a></li>
                            <li><a href="./theme/email-inbox.html">Inbox</a></li>
                            <li><a href="./theme/email-read.html">Read</a></li>
                        </ul>
                    </li>
                    <li><a href="./theme/app-calender.html">Calendar</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-chart-bar-33"></i><span class="nav-text">Charts</span></a>
                <ul aria-expanded="false">
                    <li><a href="./theme/chart-flot.html">Flot</a></li>
                    <li><a href="./theme/chart-morris.html">Morris</a></li>
                    <li><a href="./theme/chart-chartjs.html">Chartjs</a></li>
                    <li><a href="./theme/chart-chartist.html">Chartist</a></li>
                    <li><a href="./theme/chart-sparkline.html">Sparkline</a></li>
                    <li><a href="./theme/chart-peity.html">Peity</a></li>
                </ul>
            </li>
            <li class="nav-label">Components</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-world-2"></i><span class="nav-text">Bootstrap</span></a>
                <ul aria-expanded="false">
                    <li><a href="./theme/ui-accordion.html">Accordion</a></li>
                    <li><a href="./theme/ui-alert.html">Alert</a></li>
                    <li><a href="./theme/ui-badge.html">Badge</a></li>
                    <li><a href="./theme/ui-button.html">Button</a></li>
                    <li><a href="./theme/ui-modal.html">Modal</a></li>
                    <li><a href="./theme/ui-button-group.html">Button Group</a></li>
                    <li><a href="./theme/ui-list-group.html">List Group</a></li>
                    <li><a href="./theme/ui-media-object.html">Media Object</a></li>
                    <li><a href="./theme/ui-card.html">Cards</a></li>
                    <li><a href="./theme/ui-carousel.html">Carousel</a></li>
                    <li><a href="./theme/ui-dropdown.html">Dropdown</a></li>
                    <li><a href="./theme/ui-popover.html">Popover</a></li>
                    <li><a href="./theme/ui-progressbar.html">Progressbar</a></li>
                    <li><a href="./theme/ui-tab.html">Tab</a></li>
                    <li><a href="./theme/ui-typography.html">Typography</a></li>
                    <li><a href="./theme/ui-pagination.html">Pagination</a></li>
                    <li><a href="./theme/ui-grid.html">Grid</a></li>

                </ul>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-plug"></i><span class="nav-text">Plugins</span></a>
                <ul aria-expanded="false">
                    <li><a href="./theme/uc-select2.html">Select 2</a></li>
                    <li><a href="./theme/uc-nestable.html">Nestedable</a></li>
                    <li><a href="./theme/uc-noui-slider.html">Noui Slider</a></li>
                    <li><a href="./theme/uc-sweetalert.html">Sweet Alert</a></li>
                    <li><a href="./theme/uc-toastr.html">Toastr</a></li>
                    <li><a href="./theme/map-jqvmap.html">Jqv Map</a></li>
                </ul>
            </li>
            <li><a href="widget-basic.html" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                        class="nav-text">Widget</span></a></li>
            <li class="nav-label">Forms</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-form"></i><span class="nav-text">Forms</span></a>
                <ul aria-expanded="false">
                    <li><a href="./theme/form-element.html">Form Elements</a></li>
                    <li><a href="./theme/form-wizard.html">Wizard</a></li>
                    <li><a href="./theme/form-editor-summernote.html">Summernote</a></li>
                    <li><a href="form-pickers.html">Pickers</a></li>
                    <li><a href="form-validation-jquery.html">Jquery Validate</a></li>
                </ul>
            </li>
            <li class="nav-label">Table</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-layout-25"></i><span class="nav-text">Table</span></a>
                <ul aria-expanded="false">
                    <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                    <li><a href="table-datatable-basic.html">Datatable</a></li>
                </ul>
            </li>

            <li class="nav-label">Extra</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-single-copy-06"></i><span class="nav-text">Pages</span></a>
                <ul aria-expanded="false">
                    <li><a href="./theme/page-register.html">Register</a></li>
                    <li><a href="./theme/page-login.html">Login</a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                        <ul aria-expanded="false">
                            <li><a href="./theme/page-error-400.html">Error 400</a></li>
                            <li><a href="./theme/page-error-403.html">Error 403</a></li>
                            <li><a href="./theme/page-error-404.html">Error 404</a></li>
                            <li><a href="./theme/page-error-500.html">Error 500</a></li>
                            <li><a href="./theme/page-error-503.html">Error 503</a></li>
                        </ul>
                    </li>
                    <li><a href="./theme/page-lock-screen.html">Lock Screen</a></li>
                </ul>
            </li>
        </ul>
    </div>


</div>
<!--**********************************
    Sidebar end
***********************************-->

<!--**********************************
    Content body start
***********************************-->

<!--**********************************
    Content body end
***********************************-->


<!--**********************************
    Footer start
***********************************-->
<div class="footer">
    <div class="copyright">
        <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
    </div>
</div>
<!--**********************************
    Footer end
***********************************-->

<!--**********************************
   Support ticket button start
***********************************-->

<!--**********************************
   Support ticket button end
***********************************-->


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
<script src="./theme/vendor/global/global.min.js"></script>
    <script src="./theme/js/quixnav-init.js"></script>
    <script src="./theme/js/custom.min.js"></script>


    <!-- Vectormap -->
    <script src="./theme/vendor/raphael/raphael.min.js"></script>
    <script src="./theme/vendor/morris/morris.min.js"></script>


    <script src="./theme/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="./theme/vendor/chart.js/Chart.bundle.min.js"></script>

    <script src="./theme/vendor/gaugeJS/dist/gauge.min.js"></script>

    <!--  flot-chart js -->
    <script src="./theme/vendor/flot/jquery.flot.js"></script>
    <script src="./theme/vendor/flot/jquery.flot.resize.js"></script>

    <!-- Owl Carousel -->
    <script src="./theme/vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Counter Up -->
    <script src="./theme/vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="./theme/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="./theme/vendor/jquery.counterup/jquery.counterup.min.js"></script>


    <script src="./theme/js/dashboard/dashboard-1.js"></script>
</html>
<?php $this->endPage();
