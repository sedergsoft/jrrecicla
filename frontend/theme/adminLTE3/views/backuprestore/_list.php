<?php

use yii\helpers\Html;

//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Base de Datos - Admin';
$this->params['tittle'][]= 'Gestionar Salvas de Base de Datos';
?>

  
 <?php  // echo $this->render('_search', ['model' => $searchModel]); ?>
    <hr>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <?php
        echo
        kartik\grid\GridView::widget([
            'id' => 'install-grid',
            'export' => false,
            'dataProvider' => $dataProvider,
            'resizableColumns' => false,
            'showPageSummary' => false,
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'responsive' => true,
            'hover' => true,
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="fas fa-database"></i> Salvas de Base de datos</h3>',
                'type' => 'primary',
                'showFooter' => false,
                'before'=> Html::a('<i class="fa fa-plus"></i>  Crear Salva ', ['create'], ['class' => 'btn btn-success create-backup margin-right5']),
           
            ],
//            
//                 Html::a('<i class="glyphicon glyphicon-plus"></i>  Vaciar BD  ', ['limpiar'], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
//                'method' => 'post',
//            ],
//        ]),
//            
            
            // set your toolbar
            'toolbar' => [
                ['content' => 
           // Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['data-pjax' => 0, 'class' => 'btn btn-success', 'title' => 'Agregar Indicador']). ' '.
            //Html::a('<i class="glyphicon glyphicon-ok-sign"></i>', ['activarperiodoevaluacion'], ['data-pjax' => 0, 'class' => 'btn btn-info', 'title' => 'Activar periodo de edicion de los critertio','data-confirm'=>'Está seguro de querer activar el periodo de edición de los indicadores de gestión?'])  . ' '.
           // Html::button('<i class="glyphicon glyphicon-minus-sign"></i>', ['value'=>Url::to(['indicadoresgestion/cerrarperiodoevaluacion']),'type' => 'button', 'title' => 'Cerrar periodo de evaluacion', 'class' => 'btn btn-danger','data-confirm'=>'Está seguro de querer cerrar el periodo de edicion de los indicadores de gestión?'])
            Html::a('<i class="fas fa-eraser"></i> ', ['limpiar'], ['data-pjax' => 0, 'class' => 'btn btn-danger', 'title' => 'Vaciar base de datos actual','data-confirm'=>'Esta Seguro que desea Vaciar La Base de Datos? Al hacerlo se perderan toda la información. Si esta seguro de hacerlo presione Aceptar, de lo contrario presione Cancelar.']) . ' '.
          Html::a('<i class="fas fa-redo"></i>', ['limpiardatos'], ['data-pjax' => 0, 'class' => 'btn btn-warning', 'title' => 'Borrar evaluaciones exixtentes','data-confirm'=>'Esta Seguro que desea Borrar Las evaluaciones? Al hacerlo se perderan toda la información referente a las Autoevaluaciones realizadas hasta ahora. Si esta seguro de hacerlo presione Aceptar, de lo contrario presione Cancelar']) 
       
            ],
//                ['content' =>    Html::a('<i class="glyphicon glyphicon-erase"></i>  Vaciar BD  ', ['limpiar'], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => Yii::t('app', 'Esta Seguro que desea Vaciar La Base de Datos? Al hacerlo se perderan toda la información. Si esta seguro de hacerlo presione Aceptar, de lo contrario presione Cancelar;'),
//                'method' => 'post',
//            ],
//        ]),
//                Html::a('<i class="glyphicon glyphicon-erase"></i>  Borrar Evaluaciones  ', ['limpiar'], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => Yii::t('app', 'Esta Seguro que desea Vaciar La Base de Datos? Al hacerlo se perderan toda la información. Si esta seguro de hacerlo presione Aceptar, de lo contrario presione Cancelar;'),
//                'method' => 'post',
//            ],
//        ])
//                   
//                    ],
            ],
            'columns' => array(
                'name',
                'size:size',
                'create_time',
                'modified_time:relativeTime',
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{restore_action}',
                    'header' => 'Restaurar',
                    'buttons' => [
                        'restore_action' => function ($url, $model) {
                            return Html::a('<span class="fas fa-file-import"></span>', $url, [
                                'title' => 'Restore','class'=>'restore'
                            ]);
                        }
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'restore_action') {
							$url = Url::to(['backuprestore/restore', 'filename' => $model['name']]);
                            return $url;
                        }
                    }
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{delete_action}',
                    'header' => 'Eliminar',
                    'buttons' => [
                        'delete_action' => function ($url, $model) {
                            return Html::a('<span class="fas fa-trash"></span>', $url, [
                                'title' => Yii::t('app', 'Delete Database'),'class'=>'delete',
                            ]);
                        }
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'delete_action') {
                            $url = Url::to(['backuprestore/delete', 'filename' => $model['name']]);
                            return $url;
                        }
                    }
                ],
            ),
        ]);
        ?>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
