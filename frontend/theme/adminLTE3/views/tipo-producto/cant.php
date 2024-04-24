<?php

use frontend\controllers\ProductosSolicitudController;
use frontend\controllers\TipoProductoController;
use frontend\models\TipoProducto;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\TipoProductoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Cantidad de Productos ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-producto-index">

  

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax'=>true,
        'showPageSummary' => true,
        'panel' => [
            'heading'=>'<h3 class="panel-title">'.Icon::show('address-book', ['class'=>'fa', 'framework' => Icon::FA]). $tabla.' </h3>',
            'type'=>'primary',
          
            'before'=>Html::a(Icon::show('clipboard', ['class'=>'fa', 'framework' => Icon::FA])." Productos Recogidos", ['tipo-producto/cant','estado_sol'=>null], ['class' => 'btn btn-info', 'id'=>'agregar']).' '
            .Html::a(Icon::show('check', ['class'=>'fa', 'framework' => Icon::FA])." Productos Recogidos", ['tipo-producto/cant','estado_sol'=>4], ['class' => 'btn btn-success', 'id'=>'agregar']).' '
            .Html::a(Icon::show('times', ['class'=>'fa', 'framework' => Icon::FA])." Productos Rechazados", ['tipo-producto/cant','estado_sol'=>5], ['class' => 'btn btn-danger', 'id'=>'agregar']).' '
            .Html::a(Icon::show('clock', ['class'=>'fa', 'framework' => Icon::FA])." Productos Pendientes", ['tipo-producto/cant','estado_sol'=>3], ['class' => 'btn btn-warning', 'id'=>'agregar']),
           
        ],

        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           [
            'attribute'=>'tipo',
            'pageSummary' => 'Total de Productos',
            'pageSummaryOptions' => ['class' => 'text-left text-start'],
           ],
            //'tipo',
            [
                'attribute'=>'Cant',
                'pageSummary'=>true,
                'value'=>function($model)
                {
                    return TipoProductoController::cantProd($model->id);
                }
            ],
           
        ],
    ]); ?>


</div>
