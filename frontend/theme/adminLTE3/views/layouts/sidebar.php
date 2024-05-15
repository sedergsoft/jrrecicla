<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href=<?=Yii::$app->homeUrl?> class="brand-link">
        <img src="<?=$assetDir?>/img/reyciklando.png" alt="Reyciklando logo" class="brand-image img-circle elevation-3" >
        <span class="brand-text font-weight-light"><b style="color: #85e9ce;">REY</b>CIKLANDO</span>
        
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?=Yii::$app->urlManager->createUrl(['user/view','id'=>Yii::$app->user->identity->id])?>" class="d-block"><?=Yii::$app->user->isGuest?'Invitado':Yii::$app->user->identity->username/* .' - './*Yii::$app->user->identity->username->rol->rol*/?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            if(Yii::$app->user->identity->rolid==2)
            {
     
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Panel Informátivo', 'icon' => 'tachometer-alt', 'url' => ['site/index'],  'iconStyle' => 'fa'],
                    // [
                    //     'label' => 'Gestionar',
                    //     'icon' => 'cogs',
                    //     // 'badge' => '<span class="right badge badge-info">2</span>',
                    //     'items' => [
                    //         ['label' => 'Grupos Hoteleros', 'url' => ['/grupo-hotelero/index'], 'iconStyle' => 'fa', 'icon' => 'hotel'/*, 'iconClassAdded'=>'fa-9x'*/],
                    //         ['label' => 'Cargos', 'url' => ['/cargos/index'], 'iconStyle' => 'fa', 'icon' => 'user-tie'],
                    //         ['label' => 'Clientes', 'url' => ['/cliente/index'],'iconStyle' => 'fa', 'icon' => 'address-book'],
                    //         ['label' => 'Tipo de Productos', 'url' => ['/tipo-producto/index'],'iconStyle' => 'fa', 'icon' => 'project-diagram'],
                    //         ['label' => 'Productos', 'url' => ['/productos/index'],'iconStyle' => 'fas', 'icon' => 'boxes'],
                    //         ['label' => 'Solicitudes', 'url' => ['/solicitud/index'],'iconStyle' => 'fas', 'icon' => 'clipboard-list'],
                    //         ['label' => 'Transportistas', 'url' => ['/transportista/index'],'iconStyle' => 'fas', 'icon' => 'shipping-fast'],
                                        
                    //         //  ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                    //     ]
                    // ],
                    [
                        'label' => 'Solicitudes',
                        'icon' => 'clipboard',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Mis Solicitudes', 'url' => ['/solicitud/index'], 'iconStyle' => 'fa','icon' => 'paste' ],
                            ['label' => 'Nueva Solicitud', 'url' => ['/solicitud/create'],'iconStyle' => 'fa', 'icon' => 'plus-circle'/*, 'iconClassAdded'=>'fa-9x'*/],
                            ['label' => 'Solicitudes Pendientes', 'url' => ['/solicitudes/pendientes'], 'iconStyle' => 'fa', 'icon' => 'clock'],
                            ['label' => 'Solicitudes Rechazadas', 'url' => ['/solicitudes/rechazadas'],'iconStyle' => 'fa', 'icon' => 'times'],
                            ['label' => 'Historial ', 'url' => ['/solicitudes/historial'],'iconStyle' => 'fa', 'icon' => 'list'],
                                        
                            //  ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Reportes',
                        'icon' => 'file-alt',
                        'items' => [
                            ['label' => 'Tiempo de respuesta', 'url' => ['/solicitud/tiempo'], 'iconStyle' => 'fa','icon' => 'clock' ],
                            ['label' => 'Solicitudes por Clientes', 'url' => ['/solicitud/solicitudesxcliente','id'=> Yii::$app->user->getId()],'iconStyle' => 'fa', 'icon' => 'fingerprint'/*, 'iconClassAdded'=>'fa-9x'*/],
                            ['label' => 'Cantidad de Productos', 'url' => ['/tipo-producto/cant'], 'iconStyle' => 'fa', 'icon' => 'clock'],
                            // ['label' => 'Solicitudes Rechazadas', 'url' => ['/solicitudes/rechazadas'],'iconStyle' => 'fa', 'icon' => 'times'],
                            // ['label' => 'Historial ', 'url' => ['/solicitudes/historial'],'iconStyle' => 'fa', 'icon' => 'list'],
                                        
                            //  ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Seguridad',
                        'icon' => 'shield-alt',
                        'items' => [
                           // ['label' => 'Usuarios', 'url' => ['/user/index'], 'iconStyle' => 'fa','icon' => 'users' ],
                            ['label' => 'Cambiar Contraseña', 'url' => ['/user/password','id'=> Yii::$app->user->getId()],'iconStyle' => 'fa', 'icon' => 'fingerprint'/*, 'iconClassAdded'=>'fa-9x'*/],
                            // ['label' => 'Solicitudes Pendientes', 'url' => ['/solicitudes/pendientes'], 'iconStyle' => 'fa', 'icon' => 'clock'],
                            // ['label' => 'Solicitudes Rechazadas', 'url' => ['/solicitudes/rechazadas'],'iconStyle' => 'fa', 'icon' => 'times'],
                            // ['label' => 'Historial ', 'url' => ['/solicitudes/historial'],'iconStyle' => 'fa', 'icon' => 'list'],
                                        
                            //  ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        ]
                    ],
                   ],
            ]);
            }
            if(Yii::$app->user->identity->rolid==1)
            {
     
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Panel Informátivo', 'icon' => 'tachometer-alt', 'url' => ['site/index'],  'iconStyle' => 'fa'],
                    [
                        'label' => 'Gestionar',
                        'icon' => 'cogs',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Grupos Hoteleros', 'url' => ['/grupo-hotelero/index'], 'iconStyle' => 'fa', 'icon' => 'hotel'/*, 'iconClassAdded'=>'fa-9x'*/],
                            ['label' => 'Cargos', 'url' => ['/cargos/index'], 'iconStyle' => 'fa', 'icon' => 'user-tie'],
                            ['label' => 'Clientes', 'url' => ['/cliente/index'],'iconStyle' => 'fa', 'icon' => 'address-book'],
                            ['label' => 'Tipo de Productos', 'url' => ['/tipo-producto/index'],'iconStyle' => 'fa', 'icon' => 'project-diagram'],
                            ['label' => 'Productos', 'url' => ['/productos/index'],'iconStyle' => 'fas', 'icon' => 'boxes'],
                            ['label' => 'Solicitudes', 'url' => ['/solicitud/index'],'iconStyle' => 'fas', 'icon' => 'clipboard-list'],
                            ['label' => 'Transportistas', 'url' => ['/transportista/index'],'iconStyle' => 'fas', 'icon' => 'shipping-fast'],
                                        
                            //  ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Solicitudes',
                        'icon' => 'clipboard',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Nuevas Solicitudes', 'url' => ['/solicitudes/nuevas'], 'iconStyle' => 'fa','icon' => 'plus-circle' ],
                            ['label' => 'Solicitudes Aprobadas', 'url' => ['/solicitudes/aprobadas'],'iconStyle' => 'fa', 'icon' => 'check'/*, 'iconClassAdded'=>'fa-9x'*/],
                            ['label' => 'Solicitudes Pendientes', 'url' => ['/solicitudes/pendientes'], 'iconStyle' => 'fa', 'icon' => 'clock'],
                            ['label' => 'Solicitudes Rechazadas', 'url' => ['/solicitudes/rechazadas'],'iconStyle' => 'fa', 'icon' => 'times'],
                            ['label' => 'Historial ', 'url' => ['/solicitudes/historial'],'iconStyle' => 'fa', 'icon' => 'list'],
                                        
                            //  ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Reportes',
                        'icon' => 'file-alt',
                        'items' => [
                            ['label' => 'Tiempo de respuesta', 'url' => ['/solicitud/tiempo'], 'iconStyle' => 'fa','icon' => 'clock' ],
                            ['label' => 'Solicitudes por Clientes', 'url' => ['/solicitud/solicitudesxcliente','id'=> Yii::$app->user->getId()],'iconStyle' => 'fa', 'icon' => 'fingerprint'/*, 'iconClassAdded'=>'fa-9x'*/],
                            ['label' => 'Cantidad de Productos', 'url' => ['/tipo-producto/cant'], 'iconStyle' => 'fa', 'icon' => 'clock'],
                            // ['label' => 'Solicitudes Rechazadas', 'url' => ['/solicitudes/rechazadas'],'iconStyle' => 'fa', 'icon' => 'times'],
                            // ['label' => 'Historial ', 'url' => ['/solicitudes/historial'],'iconStyle' => 'fa', 'icon' => 'list'],
                                        
                            //  ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Seguridad',
                        'icon' => 'shield-alt',
                        'items' => [
                            ['label' => 'Usuarios', 'url' => ['/user/index'], 'iconStyle' => 'fa','icon' => 'users' ],
                            ['label' => 'Cambiar Contraseña', 'url' => ['/user/password','id'=> Yii::$app->user->getId()],'iconStyle' => 'fa', 'icon' => 'fingerprint'/*, 'iconClassAdded'=>'fa-9x'*/],
                            // ['label' => 'Solicitudes Pendientes', 'url' => ['/solicitudes/pendientes'], 'iconStyle' => 'fa', 'icon' => 'clock'],
                            // ['label' => 'Solicitudes Rechazadas', 'url' => ['/solicitudes/rechazadas'],'iconStyle' => 'fa', 'icon' => 'times'],
                            // ['label' => 'Historial ', 'url' => ['/solicitudes/historial'],'iconStyle' => 'fa', 'icon' => 'list'],
                                        
                            //  ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Configuacion',
                        'icon' => 'cog',
                        'items' => [
                            ['label' => 'Permisos', 'url' => ['/rbac/assignment'], 'iconStyle' => 'fa','icon' => 'user-shield' ],
                        ['label' => 'Roles', 'url' => ['/rbac/role'],'iconStyle' => 'fa', 'icon' => 'user-tag'/*, 'iconClassAdded'=>'fa-9x'*/],
                        ['label' => 'Base De Datos', 'url' => ['/backuprestore/index'], 'iconStyle' => 'fa', 'icon' => 'database'],
                        ['label' => 'Trazas', 'url' => ['/solicitudes/rechazadas'],'iconStyle' => 'fa', 'icon' => 'shoe-prints'],
                        // ['label' => 'Solicitudes Pendientes', 'url' => ['/solicitudes/pendientes'], 'iconStyle' => 'fa', 'icon' => 'clock'],
                            // ['label' => 'Solicitudes Rechazadas', 'url' => ['/solicitudes/rechazadas'],'iconStyle' => 'fa', 'icon' => 'times'],
                            // ['label' => 'Historial ', 'url' => ['/solicitudes/historial'],'iconStyle' => 'fa', 'icon' => 'list'],
                                        
                            //  ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        ]
                    ],
                   ],
            ]);
            }
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>