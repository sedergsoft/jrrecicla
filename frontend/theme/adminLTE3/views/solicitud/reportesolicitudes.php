<?php

use frontend\controllers\ClienteController;
use frontend\controllers\SolicitudController;
use frontend\controllers\UserController;
use frontend\models\Cliente;
use frontend\models\GrupoHotelero;
use frontend\models\Solicitud;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Url;

if (Yii::$app->user->identity->rolid != 1)
     {
        ?>
        <div class="row">
        <div class="col-12 col-sm-12 col-md-6">
        <?= \hail812\adminlte\widgets\InfoBox::widget([
                            'text' => 'Cantidad de Solicitudes',
                            'number' => Solicitud::find()->andWhere(['status'=>1,'clienteid'=>UserController::findModel(Yii::$app->user->getId())->empresa->id])->count(),
                            'icon' => 'fas fa-clipboard-list',
                        ]) ?>
        
        </div>
        <div class="col-12 col-sm-12 col-md-6">
           <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Importe de Ventas',
                'number' =>$ventas = Yii::$app->formatter->asCurrency(ClienteController::clienteimporte(UserController::findModel(Yii::$app->user->getId())->empresa->id,4)),
                'icon' => 'fas fa-dollar-sign',
                'iconTheme'=>'primary'
            ]) ?>
        </div>
    </div>
    <?php
     }else{
    ?>
                <div class="row">
                   
                   
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        
                            <?= \hail812\adminlte\widgets\SmallBox::widget([
                                                        'title' =>Yii::$app->formatter->asCurrency($ventas),
                                                        'text' => 'Importe de Compras',
                                                        'icon' => 'fas fa-dollar-sign',
                                                        'linkText'=>'Reyciklando',
                                                        'theme'=>'success',
                                                        //'linkUrl'=> Url::to(['/grupo-hotelero/index']),
                                ])?>
                  
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <?= \hail812\adminlte\widgets\SmallBox::widget([
                                                                    'title' =>Yii::$app->formatter->asCurrency($Vpendientes),
                                                                    'text' => 'Importe de Compras Pendientes',
                                                                    'icon' => 'fas fa-money-check-alt',
                                                                     'linkText'=>'Reyciklando',
                                                                    'theme'=>'danger',
                                                                  //  'linkUrl'=> Url::to(['/grupo-hotelero/index']),
                                ])?>
                    
                    
                    </div>
                </div>
               
          <?php  } ?>

          <div class="row"> 
        <div class="col-md-6 col-sm-12 col-12 col-lg-4">
            <?php
           // echo Yii::$app->formatter->asPercent(floatval(-0.009343));
            $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Nuevas Solicitudes',
                'number' => $nuevas,
               //  'theme' => 'info',
                'icon' => 'fas fa-clipboard',
                'progress' => [
                    'width' => $p =  ($nuevas/$activas)*100 .'%',
                   // 'description' => Yii::$app->formatter->asPercent(0.125, 2),
                'description' =>  SolicitudController::decimal(($nuevas/$activas)*100)   .' del total de Solicitudes activas'
                ]
            ]) ?>
            <?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $infoBox->id.'-ribbon',
                'text' => 'Nuevas',
                'theme' => 'danger',
               // 'size' => 'lg',
               // 'textSize' => 'lg'
            ]) ?>
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <?php
           // echo Yii::$app->formatter->asPercent(floatval(-0.009343));
            $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Pendientes Solicitudes',
                'number' => $pendientes,
                'theme' => 'warning',
                'icon' => 'fas fa-clipboard',
                'progress' => [
                    'width' => $p =  ($pendientes/$activas)*100 .'%',
                   // 'description' => Yii::$app->formatter->asPercent(0.125, 2),
                'description' =>  SolicitudController::decimal(($pendientes/$activas)*100)   .' del total de Solicitudes activas'
                ]
            ]) ?>
        
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>
        
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <?php
           // echo Yii::$app->formatter->asPercent(floatval(-0.009343));
            $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Solicitudes Atendidas',
                'number' => $atendidas,
                'theme' => 'success',
                'icon' => 'fas fa-clipboard-check',
                'progress' => [
                    'width' => $p =  ($atendidas/$activas)*100 .'%',
                   // 'description' => Yii::$app->formatter->asPercent(0.125, 2),
                'description' =>  SolicitudController::decimal(($atendidas/$activas)*100)   .' del total de Solicitudes',
                ]
            ]) ?>
        
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    <?php     echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'Solicitudes',
        ],
        'xAxis' => [
            'categories' => ['Solicitudes'],
        ],
        
                'series' => [
                    [
                        'type' => 'column',
                        'name' => 'Atendidas',
                        'data' => [$atendidas],
                    ],
                    [
                        'type' => 'column',
                        'name' => 'Pendientes',
                        'color'=>'orange',
                        'data' => [$pendientes],
                    ],
                    [
                        'type' => 'column',
                        'name' => 'Canceladas',
                        'color'=>'red',
                        'data' => [$canceladas],
                    ],
           
        ],
    ]
]);
?>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    <?php     echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
       // 'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'Importes',
        ],
        'xAxis' => [
            'categories' => ['Solicitudes'],
        ],
        // 'yAxis' => [
        //     'categories' => ['Pesos'],
        // ],
        
                'series' => [
                    [
                        'type' => 'bar',
                        'name' => 'Ventas Realizadas',
                        'color'=>'green',
                        'data' => [$ventas],
                    ],
                    [
                        'type' => 'bar',
                        'name' => 'Ventas Pendientes',
                        'color'=>'orange',
                        'data' => [$Vpendientes],
                    ],
                    [
                        'type' => 'bar',
                        'color'=>'red',
                        'name' => 'Ventas Canceladas',
                        'data' => [$Vcancelada],
                    ],
           
        ],
    ]
]);
?>
        </div>
      
    </div>