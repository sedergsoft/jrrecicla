<?php

use frontend\models\Cargos;
use frontend\models\Cliente;
use frontend\models\GrupoHotelero;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var frontend\models\ClienteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Solicitudes por clientes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

  

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax'=>true,
        'showPageSummary' => true,
        'panel' => [
            'heading'=>'<h3 class="panel-title">'.Icon::show('address-book', ['class'=>'fa', 'framework' => Icon::FA]). $this->title.' </h3>',
            'type'=>'primary',
          
            //'before'=>Html::a(Icon::show('plus', ['class'=>'fa', 'framework' => Icon::FA])." Agregar", ['create'], ['class' => 'btn btn-success', 'id'=>'agregar']),
           
        ],

        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'instalacion',
                'pageSummary' => 'Total de Solicitudes',
                'pageSummaryOptions' => ['class' => 'text-right text-end'],
            ],
             'instalacion',
            // 'direccion',
            // 'representante',
            // 'email:email',
            // 'telefono',
           
            // [
            //     'attribute'=>'cargosid',
            //     'filterType' => GridView::FILTER_SELECT2,
            //     'filter' => ArrayHelper::map(Cargos::find()->orderBy('id')->asArray()->all(), 'id', 'cargo'),
            //     'filterWidgetOptions' => [
            //         'pluginOptions' => ['allowClear' => true],
            //     ],
            //     'filterInputOptions' => ['placeholder' => 'Seleccione...'],
     
            //     'value'=>function($model) 
            //     {
            //      return $model->cargos->cargo;
            //     }
            //    ],
            [
                'attribute'=>'grupo_hoteleroid',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(GrupoHotelero::find()->orderBy('id')->asArray()->all(), 'id', 'grupo'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Seleccione...'],
     
                'value'=>function($model) 
                {
                 return $model->grupoHotelero->grupo;
                }
               ],
               [
                'attribute'=>'sol_count',
                'pageSummary' => true,
                'label'=>'Cantidad de Solicitudes',
                'value'=>function($model)
                {
                   return $model->getSolicituds()->count(); 
                }
            ],
            
            
        ],
    ]); ?>


</div>
