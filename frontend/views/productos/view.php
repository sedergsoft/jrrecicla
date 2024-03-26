<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use kartik\icons\Icon;

/** @var yii\web\View $this */
/** @var frontend\models\Productos $model */

$this->title = $model->producto;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="productos-view">

  

 

<div>
<?= DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>'Cargo (' . $model->producto.')',
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
           // 'id',
            'producto',
            'descripcion',
            'um',
            'precio',
          //  'status',
        ],
          // 'enableEditMode'=>FALSE,
    'deleteOptions'=>[ // your ajax delete parameters
   'params' => ['id' => $model->id, 'custom_param' => true],
      'url' => ['delete', 'id' => $model->id],
]
    ]) ?>
</div>
<div style="margin-top: 10px;">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax'=>true,
        'panel' => [
            'heading'=>'<h4 class="panel-title">'.Icon::show('list', ['class'=>'fa', 'framework' => Icon::FA]). 'Tipos de producto que lo componen </h4>',
            'type'=>'info',
          
            //'before'=>Html::a(Icon::show('plus', ['class'=>'fa', 'framework' => Icon::FA])." Agregar", ['create'], ['class' => 'btn btn-success', 'id'=>'agregar']),
           
        ],

        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           [
            'attribute'=>'tipo_productoid',
            'value'=>function($model)
            {
             return $model->tipoProducto->tipo;
            }
           ],
           // 'status',
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
    

</div>
