<?php

use frontend\models\Recogida;
use frontend\models\Transportista;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var frontend\models\RecogidaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Recogidas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recogida-index">

  

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax'=>true,
        'panel' => [
            'heading'=>'<h3 class="panel-title">'.Icon::show('address-book', ['class'=>'fa', 'framework' => Icon::FA]). $this->title.' </h3>',
            'type'=>'primary',
          
          //  'before'=>Html::a(Icon::show('plus', ['class'=>'fa', 'framework' => Icon::FA])." Agregar", ['create'], ['class' => 'btn btn-success', 'id'=>'agregar']),
           
        ],

        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
             'attribute'=>'transportistaid',
             'label'=>'Chofer',
             'value'=>function($model)
             {

                 return $model->transportista->chofer;
             },
             'filterType' => GridView::FILTER_SELECT2,
             'filter' => ArrayHelper::map(Transportista::find()->orderBy('id')->andWhere(['status'=>1])->asArray()->all(), 'id', 'chofer'),
             'filterWidgetOptions' => [
                 'pluginOptions' => ['allowClear' => true],
             ],
             'filterInputOptions' => ['placeholder' => 'Seleccione...'],
  
             
            ],
            [
             'label'=>'Vehiculo',
             'attribute'=>'transportistaid',
             'value'=>function($model)
             {

                 return $model->transportista->vehiculo;
             }
            ],
            [
             'attribute'=>'solicitudid',
             'label'=>'Instalación',
             'value'=>function($model)
             {

                 return $model->solicitud?$model->solicitud->cliente->instalacion:'';
             }
            ],
            [
             'attribute'=>'solicitudid',
             'label'=>'Solicitud',
             'value'=>function($model)
             {

                 return $model->solicitud?$model->solicitudid:'';
             }
            ],
            'fecha_recogida',
            [
             'attribute'=>'solicitudid',
             'label'=>'Estado',
             'value'=>function($model)
             {

                 return $model->solicitud?$model->solicitud->tipoEstadoSolicitud->estado:'';
             }
            ],
            //'transportistaid',
            //'solicitudid',
            //'status',
            // ['class' => 'kartik\grid\ActionColumn',
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
