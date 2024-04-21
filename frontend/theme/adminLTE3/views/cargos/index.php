<?php

use frontend\models\Cargos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;

/** @var yii\web\View $this */
/** @var frontend\models\CargosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cargos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cargos-index">

   

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax'=>true,
        // 'pjaxSettings'=>[
        //     'neverTimeout'=>true,
        //     'beforeGrid'=>'My fancy content before.',
        //     'afterGrid'=>'My fancy content after.',
        // ],
       // 'floatHeader' => true, // floats header to top
        // 'floatPageSummary' => true, // floats page summary to bottom
        // 'headerContainer' => ['class'=> 'kv-table-header', 'style'=>'top:50px'], // offset from top
        // 'pageSummaryPosition' => GridView::POS_BOTTOM,
     //'resizableColumns'=>false,
    //  'toolbar' => [
    //     [
    //         'content'=>
    //             Html::button('<i class="fa fa-plus"></i>', [
    //                 'type'=>'button', 
    //                 'title'=> 'Add Book', 
    //                 'class'=>'btn btn-success'
    //             ]) . ' '.
    //             Html::a('<i class="fa fa-redo"></i>', ['grid-demo'], [
    //                 'class' => 'btn btn-secondary btn-default', 
    //                 'title' =>'Reset Grid'
    //             ]),
    //     ],
    //     '{export}',
    //     '{toggleData}'
    // ],
    'panel' => [
            'heading'=>'<h3 class="panel-title">'.Icon::show('address-book', ['class'=>'fa', 'framework' => Icon::FA]).' Cargos </h3>',
            'type'=>'primary',
            // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
            'before'=>Html::a(Icon::show('plus', ['class'=>'fa', 'framework' => Icon::FA])." Agregar", ['create'], ['class' => 'btn btn-success', 'id'=>'agregar']),
            //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            //'footer'=>false
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID',
           // 'id',
            'cargo',
         //   'status',
            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}',
            'buttons' => [
                 
                'view' => function ($url, $data){
                                                      
                                                          return Html::a('<i class="fa fa-eye"></i>', 
                                                                  ['view','id'=>$data['id']],
                                                                  
                                                                  ['class' => 'btn btn-info btn-xs',
                                                                    'title' => 'Ver'  
                                                                      ]);
                                                      
                                                       }, 
            ],
            ],
        ],
    ]);?>
   


</div>
