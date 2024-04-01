<?php

use frontend\models\TipoProductoProductos;
use frontend\models\TipoProductoProductosSearch;
use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use kartik\icons\Icon;

/** @var yii\web\View $this */
/** @var frontend\models\Solicitud $model */

$this->title = 'Solicitud - No.'.$modelSolicitud->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Solicitudes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="solicitud-view">

  

    <?= DetailView::widget([
    'model'=>$modelSolicitud,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>$this->title,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
           // 'id',
           [
               'attribute' =>  'clienteid',
               // 'label' => 'sexo ',
                'value'=> $modelSolicitud->cliente->instalacion,
               // 'type'=> DetailView::INPUT_TEXTAREA, 
              ],
            'fecha_solic',
            'fecha_rec',
            'fecha_aprob',
            'fecha_ejec',
            //'status',
            [
                'attribute' =>  'tipo_estado_solicitudid',
                // 'label' => 'sexo ',
                 'value'=> $modelSolicitud->tipoEstadoSolicitud->estado,
                // 'type'=> DetailView::INPUT_TEXTAREA, 
               ],
           // 'clienteid',
         //   'tipo_estado_solicitudid',
        ],
           'enableEditMode'=>FALSE,
           'hideIfEmpty'=> TRUE,
    'deleteOptions'=>[ // your ajax delete parameters
   'params' => ['id' => $modelSolicitud->id, 'custom_param' => true],
      'url' => ['delete', 'id' => $modelSolicitud->id],
]
    ]) ?>


<?= GridView::widget([
        'dataProvider' => $dataProviderProductos,
        'pjax'=>true,
        'showPageSummary' => true,
        'panel' => [
            'heading'=>'<h4 class="panel-title">'.Icon::show('address-book', ['class'=>'fa', 'framework' => Icon::FA]).'Productos ('. $this->title.') </h4>',
            'type'=>'info',
          
          //  'after'=>Html::a(Icon::show('plus', ['class'=>'fa', 'framework' => Icon::FA])." Agregar", ['create'], ['class' => 'btn btn-success', 'id'=>'agregar']),
           
        ],

        'filterModel' => $searchModelProductos,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '50px',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                // uncomment below and comment detail if you need to render via ajax
                // 'detailUrl' => Url::to(['/site/book-details']),
                'detail' => function ($model, $key, $index, $column) 
                    {
                        $dataProviderprod = TipoProductoProductos::find()->andWhere(['status'=>1,'productosid'=>$model->productosid])->all();
                      
                      
                    return Yii::$app->controller->renderPartial('_productos_detalles', 
                    ['dataProviderprod' => $dataProviderprod,
                   // 'searchModelprod'=>$searchModelprod,
                    'cant' =>$model->cant,
                ]);
                },
                'headerOptions' => ['class' => 'kartik-sheet-style'], 
                'expandOneOnly' => true
            ],
            [
                'attribute'=>'producto',
                'value'=>function($model)
                {
                  return $model->productos->producto;  
                },
                'pageSummary' => 'Total Solicitud',
                'pageSummaryOptions' => ['class' => 'text-right text-end'],
            ],
            [
                'attribute'=>'descripcion',
                'value'=>function($model)
                {
                  return $model->productos->descripcion;  
                }
            ],
            [
                'attribute'=>'cant',
                'pageSummary' => true
               
            ],
            [
                'attribute'=>'precio',
                'attribute'=>'Precio Unitario',
                'format'=>'currency',
                'value'=>function($model)
                {
                  return $model->productos->precio;  
                }
            ],
            [
                'class' => 'kartik\grid\FormulaColumn',
                'header' => 'Precio de Total (Producto)',
                'value' => function ($model, $key, $index, $widget) { 
                    $p = compact('model', 'key', 'index');
                    return $widget->col(4, $p) * $widget->col(5, $p);
                },
                'mergeHeader' => true,
                'width' => '150px',
                'hAlign' => 'right',
                'format' => 'currency',
                'pageSummary' => true
            ],
           
            
            //'status',
            // ['class' => 'yii\grid\ActionColumn',
            // 'template'=>'{view}',
            // 'buttons' => [
                 
            //     'view' => function ($url, $data){
                                                      
            //                                               return Html::a('<i class="fa fa-eye"></i>', 
            //                                                       ['view','id'=>$data['id']],
                                                                  
            //                                                       ['class' => 'btn btn-info btn-xs',
            //                                                         'title' => 'Ver'  
            //                                                           ]);
                                                      
            //                                            }, 
            // ],
            // ],
        ],
    ]); ?>
</div>
