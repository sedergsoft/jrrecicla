<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use kartik\icons\Icon;

/** @var yii\web\View $this */
/** @var frontend\models\Solicitud $model */


  ?>
<?php

?>
<?= GridView::widget([
        'dataProvider' => $dataProviderprod,
        'pjax'=>true,
        'export'=>false,
        

        'showPageSummary' => false,
        'panel' => [
            'heading'=>'<h5 class="panel-title">'.Icon::show('address-book', ['class'=>'fa', 'framework' => Icon::FA]).'Tipos de Productos </h5>',
            'type'=>'ligth',
          
           // 'after'=>Html::a(Icon::show('plus', ['class'=>'fa', 'framework' => Icon::FA])." Agregar", ['create'], ['class' => 'btn btn-success', 'id'=>'agregar']),
            'after'=>$cant,
           
        ],

       // 'filterModel' => $searchModelProductos,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            [
                'attribute'=>'producto',
                'value'=>function($model,$cant)
                {
                  return $model->tipoProducto->tipo.'-c-'.$cant;  
                },
                // 'pageSummary' => 'Total Solicitud',
                // 'pageSummaryOptions' => ['class' => 'text-right text-end'],
            ],
            [
                'attribute'=>'cant',
                'value'=>function($model)
                {
                  return $model->cant;  
                }
            ],
            // [
            //     'attribute'=>'cant',
            //     'pageSummary' => true
               
            // ],
            // [
            //     'attribute'=>'precio',
            //     'attribute'=>'Precio Unitario',
            //     'format'=>'currency',
            //     'value'=>function($model)
            //     {
            //       return $model->productos->precio;  
            //     }
            // ],
            // [
            //     'class' => 'kartik\grid\FormulaColumn',
            //     'header' => 'Precio de Total (Producto)',
            //     'value' => function ($model, $key, $index, $widget) { 
            //         $p = compact('model', 'key', 'index');
            //         return $widget->col(3, $p) * $widget->col(4, $p);
            //     },
            //     'mergeHeader' => true,
            //     'width' => '150px',
            //     'hAlign' => 'right',
            //     'format' => 'currency',
            //     'pageSummary' => true
            // ],
           
        ],
    ]); ?>
</div>
