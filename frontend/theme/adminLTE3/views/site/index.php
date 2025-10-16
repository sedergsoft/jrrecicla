<?php

use dosamigos\chartjs\ChartJs;
use frontend\controllers\ClienteController;
use frontend\controllers\SolicitudController;
use frontend\controllers\UserController;
use frontend\models\Cliente;
use frontend\models\GrupoHotelero;
use frontend\models\Solicitud;
use kartik\grid\GridView;
use kartik\icons\Icon;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Url;
use yii\i18n\Formatter;
use yii\web\JsExpression;

$this->title = 'Panel Informátivo';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-lg-6">
            <?= \hail812\adminlte\widgets\Alert::widget([
                'type' => 'success',
                'body' => '<h3>Congratulations!</h3>',
            ]) ?>
            <?= \hail812\adminlte\widgets\Callout::widget([
                'type' => 'danger',
                'head' => 'I am a danger callout!',
                'body' => 'There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
            ]) ?>
        </div>
    </div> -->

    <?php
     if (Yii::$app->user->identity->rolid != 1)
     {
        ?>
        <div class="row">
        <div class="col-12 col-sm-6 col-md-6">
        <?= \hail812\adminlte\widgets\InfoBox::widget([
                            'text' => 'Cantidad de Solicitudes',
                            'number' => Solicitud::find()->andWhere(['status'=>1,'clienteid'=>UserController::findModel(Yii::$app->user->getId())->empresa->id])->count(),
                            'icon' => 'fas fa-clipboard-list',
                        ]) ?>
        
        </div>
        <div class="col-12 col-sm-6 col-md-6">
           <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Importe de Ventas',
                'number' =>Yii::$app->formatter->asCurrency(ClienteController::clienteimporte(UserController::findModel(Yii::$app->user->getId())->empresa->id,4)),
                'icon' => 'fas fa-dollar-sign',
                'iconTheme'=>'primary'
            ]) ?>
        </div>
    </div>
    <?php
     }else{
    ?>
                <div class="row">
                   
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <?= \hail812\adminlte\widgets\SmallBox::widget([
                            'title' => Cliente::find()->andWhere(['status'=>1])->count(),
                            'text' => 'Clientes',
                            'icon' => 'fas fa-users',
                            'linkText'=>'Ver Detalles',
                            'linkUrl'=> Url::to(['/cliente/index']),
                        ])?>
                     
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <?= \hail812\adminlte\widgets\SmallBox::widget([
                                    'title' => GrupoHotelero::find()->andWhere(['status'=>1])->count(),
                                    'text' => 'Cadenas',
                                    'icon' => 'fas fa-hotel',
                                    'linkText'=>'Ver Detalles',
                                    'theme'=>'primary',
                                    'linkUrl'=> Url::to(['/grupo-hotelero/index']),
                                ])?>
                        
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        
                            <?= \hail812\adminlte\widgets\SmallBox::widget([
                                                        'title' =>Yii::$app->formatter->asCurrency(SolicitudController::importeGeneralVentas(4)),
                                                        'text' => 'Importe de Compras',
                                                        'icon' => 'fas fa-dollar-sign',
                                                        'linkText'=>'Ver Detalles',
                                                        'theme'=>'success',
                                                        'linkUrl'=> Url::to(['/solicitudes/index']),
                                ])?>
                  
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                <?= \hail812\adminlte\widgets\SmallBox::widget([
                                                                    'title' =>Yii::$app->formatter->asCurrency(SolicitudController::importeGeneralVentas(3)),
                                                                    'text' => 'Importe de Compras Pendientes',
                                                                    'icon' => 'fas fa-money-check-alt',
                                                                    'linkText'=>'Ver Detalles',
                                                                    'theme'=>'danger',
                                                                    'linkUrl'=> Url::to(['/solicitudes/pendientes']),
                                ])?>
                    
                    
                    </div>
                </div>
               
          <?php  } ?>
    <!-- <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Messages',
                'number' => '1,410',
                'icon' => 'far fa-envelope',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Bookmarks',
                'number' => '410',
                 'theme' => 'success',
                'icon' => 'far fa-flag',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Uploads',
                'number' => '13,648',
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
    </div> -->

    <div class="row">
    <div class="col-md-6 col-sm-6 col-12 col-lg-3">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                 'id' => 'message-info-box',
                'text' => 'Solicitudes Activas',
                'theme'=>'info',
                'number' => $activas,
                'icon' => 'fas fa-paste',
            ]) 
           
            ?>
        </div>
        <div class="col-md-6 col-sm-6 col-12 col-lg-3">
            <?php
           // echo Yii::$app->formatter->asPercent(floatval(-0.009343));
            $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Nuevas Solicitudes',
                'number' => $nuevas,
               //  'theme' => 'info',
                'icon' => 'fas fa-clipboard',
                'progress' => [
                    'width' => $activas==0?0:$p =  ($nuevas/$activas)*100 .'%',
                   // 'description' => Yii::$app->formatter->asPercent(0.125, 2),
                'description' =>  $activas==0?0:SolicitudController::decimal(($nuevas/$activas)*100)   .' del total de Solicitudes activas'
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
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?php
           // echo Yii::$app->formatter->asPercent(floatval(-0.009343));
            $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Pendientes Solicitudes',
                'number' => $pendientes,
                'theme' => 'warning',
                'icon' => 'fas fa-clipboard',
                'progress' => [
                    'width' => $activas==0?0:$p =  ($pendientes/$activas)*100 .'%',
                   // 'description' => Yii::$app->formatter->asPercent(0.125, 2),
                'description' =>  $activas==0?0:SolicitudController::decimal(($pendientes/$activas)*100)   .' del total de Solicitudes activas'
                ]
            ]) ?>
        
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?php
           // echo Yii::$app->formatter->asPercent(floatval(-0.009343));
            $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Solicitudes Atendidas',
                'number' => $atendidas,
                'theme' => 'success',
                'icon' => 'fas fa-clipboard-check',
                'progress' => [
                    'width' => $activas==0?0:$p =  ($atendidas/$activas)*100 .'%',
                   // 'description' => Yii::$app->formatter->asPercent(0.125, 2),
                'description' =>  $activas==0?0:SolicitudController::decimal(($atendidas/$activas)*100)   .' del total de Solicitudes',
                ]
            ]) ?>
        
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>
      
    </div>

   <div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    <?php 
    echo GridView::widget([
        'dataProvider' => $solicitudes,
        'pjax'=>true,
        'export'=>false,
        'panel' => [
            'heading'=>'<h4 class="panel-title">'.Icon::show('calendar', ['class'=>'fa', 'framework' => Icon::FA]).'Solicitudes mas antiguas </h4>',
            'type'=>'warning',
            
            //'before'=>Html::a(Icon::show('plus', ['class'=>'fa', 'framework' => Icon::FA])." Agregar", ['create'], ['class' => 'btn btn-success', 'id'=>'agregar']),
            
        ],

       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'clienteid',
                'value'=>function($model)
                {
                    return $model->cliente->instalacion;
                }

            ],
            'fecha_solic',
           // 'fecha_aprob',
           // 'fecha_rec',
           // 'fecha_ejec',
            [
                'attribute'=>'tiempo',
                'label'=>'Duracion del Proceso',
                'class' => '\kartik\grid\DataColumn',
                
                'value'=>function ($model, $key, $index, $column)
                {
                    return  Yii::$app->formatter->asDuration($model->fecha_solic.'T00:00:00Z/'.Date('Y-m-d').'T00:00:00Z'); 
                }

            ],
            //'status',
            [
                'attribute'=>'tipo_estado_solicitudid',
                'format'=>'raw',
                'value'=>function($model)
                {
                    switch ($model->tipo_estado_solicitudid) {
                        case '1':
                            return '<h4><span class="badge badge-info">'.$model->tipoEstadoSolicitud->estado.'</span></h4>';
                            break;
                        case '2':
                            return '<h4><span class="badge badge-primary">'.$model->tipoEstadoSolicitud->estado.'</span></h4>';
                            break;
                        case '3':
                            return '<h4><span class="badge badge-danger">'.$model->tipoEstadoSolicitud->estado.'</span></h4>';
                            break;
                        case '4':
                            return '<h4><span class="badge badge-success">'.$model->tipoEstadoSolicitud->estado.'</span></h4>';
                            break;
                        case '5':
                            return '<h4><span class="badge badge-danger">'.$model->tipoEstadoSolicitud->estado.'</span></h4>';
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                    
                }

            ],
            
            
        ],
    ]); ?>   
    

        </div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    <?php     echo Highcharts::widget([
    'scripts' => [
      //  'modules/exporting',
       // 'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'Solicitudes',
        ],
        'xAxis' => [
            'categories' => ['Solicitudes'],
        ],
        // 'labels' => [
        //     'items' => [
        //         [
        //             'html' => 'Total fruit consumption',
        //             'style' => [
        //                 'left' => '50px',
        //                 'top' => '18px',
        //                 'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
        //             ],
        //         ],
        //     ],
        // ],
        // 'series'=> [
        //     'type' => 'pie',
        //     'name'=>'Browser share',
        //     'innerSize'=> '50%',
        //     'data'=> [
        //         ['Chrome', 73.86],
        //         ['Edge', 11.97],
        //         ['Firefox', 5.52],
        //         ['Safari', 2.98],
        //         ['Internet Explorer', 1.90],
        //         ['Other', 3.77]
        //     ]
        
                'series' => [
                    [
                        'type' => 'column',
                        'name' => 'Atendidas',
                        'data' => [$atendidas],
                    ],
                    [
                        'type' => 'column',
                        'name' => 'Pendientes',
                        'data' => [$pendientes],
                    ],
                    [
                        'type' => 'column',
                        'name' => 'Canceladas',
                        'data' => [$canceladas],
                    ],
            // [
            //     'type' => 'spline',
            //     'name' => 'Average',
            //     'data' => [3, 2.67, 3, 6.33, 3.33],
            //     'marker' => [
            //         'lineWidth' => 2,
            //         'lineColor' => new JsExpression('Highcharts.getOptions().colors[3]'),
            //         'fillColor' => 'white',
            //     ],
            // ],
            // [
            //     'type' => 'pie',
            //     'name' => 'Total consumption',
            //     'data' => [
            //         [
            //             'name' => 'Jane',
            //             'y' => 13,
            //             'color' => new JsExpression('Highcharts.getOptions().colors[0]'), // Jane's color
            //         ],
            //         [
            //             'name' => 'John',
            //             'y' => 23,
            //             'color' => new JsExpression('Highcharts.getOptions().colors[1]'), // John's color
            //         ],
            //         [
            //             'name' => 'Joe',
            //             'y' => 19,
            //             'color' => new JsExpression('Highcharts.getOptions().colors[2]'), // Joe's color
            //         ],
            //     ],
            //     'center' => [100, 80],
            //     'size' => 100,
            //     'showInLegend' => false,
            //     'dataLabels' => [
            //         'enabled' => false,
            //     ],
            // ],
        ],
    ]
]);
?>
        </div>
        
        
        
    </div> 
</div>