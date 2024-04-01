<?php

use frontend\models\Solicitud;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\SolicitudSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Solicitudes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-index">

  

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax'=>true,
        'panel' => [
            'heading'=>'<h3 class="panel-title">'.Icon::show('address-book', ['class'=>'fa', 'framework' => Icon::FA]). $this->title.' </h3>',
            'type'=>'primary',
          
            'before'=>Html::a(Icon::show('plus', ['class'=>'fa', 'framework' => Icon::FA])." Agregar", ['create'], ['class' => 'btn btn-success', 'id'=>'agregar']),
           
        ],

        'filterModel' => $searchModel,
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
           // 'fecha_ejec',
            //'status',
            [
                'attribute'=>'tipo_estado_solicitudid',
                'format'=>'raw',
                'value'=>function($model)
                {
                    switch ($model->tipo_estado_solicitudid) {
                        case '1':
                            return '<h4><span class="badge text-bg-info">'.$model->tipoEstadoSolicitud->estado.'</span></h4>';
                            break;
                        case '2':
                            return '<h4><span class="badge text-bg-primary">'.$model->tipoEstadoSolicitud->estado.'</span></h4>';
                            break;
                        case '3':
                            return '<h4><span class="badge text-bg-warning">'.$model->tipoEstadoSolicitud->estado.'</span></h4>';
                            break;
                        case '4':
                            return '<h4><span class="badge text-bg-success">'.$model->tipoEstadoSolicitud->estado.'</span></h4>';
                            break;
                        case '5':
                            return '<h4><span class="badge text-bg-danger">'.$model->tipoEstadoSolicitud->estado.'</span></h4>';
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                   
                }

            ],
           
            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}',
            'buttons' => [
                 
                'view' => function ($url, $data){
                                                      
                                                          return Html::a('<i class="fa fa-eye"></i>', 
                                                                  ['detalles','id'=>$data['id']],
                                                                  
                                                                  ['class' => 'btn btn-info btn-xs',
                                                                    'title' => 'Ver detalles de Solicitud'  
                                                                      ]);
                                                      
                                                       }, 
            ],
            ],
        ],
    ]); ?>


</div>
