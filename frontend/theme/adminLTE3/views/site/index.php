<?php

use dosamigos\chartjs\ChartJs;
use frontend\controllers\SolicitudController;
use frontend\models\Cliente;
use frontend\models\GrupoHotelero;
use kartik\grid\GridView;
use kartik\icons\Icon;
use miloschuman\highcharts\Highcharts;
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

    <div class="row">
        <div class="col-12 col-sm-6 col-md-6">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Clientes',
                'number' => Cliente::find()->andWhere(['status'=>1])->count(),
                'icon' => 'fas fa-users',
            ]) ?>
        </div>
        <div class="col-12 col-sm-6 col-md-6">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Cadenas',
                'number' =>GrupoHotelero::find()->andWhere(['status'=>1])->count(),
                'icon' => 'fas fa-hotel',
                'iconTheme'=>'primary'
            ]) ?>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
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
    <div class="col-md-3 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Solicitudes Activas',
                'theme'=>'info',
                'number' => $activas,
                'icon' => 'fas fa-paste',
            ]) ?>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
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
        <div class="col-md-3 col-sm-6 col-12">
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
        
        <div class="col-md-3 col-sm-6 col-12">
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
      
    </div>

   <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
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
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
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