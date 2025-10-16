<?php

use frontend\models\Solicitud;
use frontend\models\TipoEstadoSolicitud;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

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
        //'caption'=>$this->title,
        'pjax'=>true,
        // 'exportConfig' => [
        //     GridView::CSV => ['label' => 'Save as CSV'],
        //     //GridView::HTML => [// html settings],
        //     GridView::PDF => [ 'label' => 'Save as PDF',
        //     // 'icon' => $isFa ? 'file-pdf-o' : 'floppy-disk',
        //     // 'iconOptions' => ['class' => 'text-danger'],
        //     // 'showHeader' => true,
        //     // 'showPageSummary' => true,
        //     // 'showFooter' => true,
        //      'showCaption' => false,
        //     'filename' =>  $this->title,
        //     // 'alertMsg' => 'The PDF export file will be generated for download.',
        //     // 'options' => ['title' => 'kvgrid', 'Portable Document Format'],
        //    // 'mime' => 'application/pdf',
        //     'config' => [
        //         // 'mode' => 'c',
        //         // 'format' => 'A4-L',
        //         // 'destination' => 'D',
        //         // 'marginTop' => 20,
        //         // 'marginBottom' => 20,
        //         // 'cssInline' => '.kv-wrap{padding:20px;}' .
        //         //     '.kv-align-center{text-align:center;}' .
        //         //     '.kv-align-left{text-align:left;}' .
        //         //     '.kv-align-right{text-align:right;}' .
        //         //     '.kv-align-top{vertical-align:top!important;}' .
        //         //     '.kv-align-bottom{vertical-align:bottom!important;}' .
        //         //     '.kv-align-middle{vertical-align:middle!important;}' .
        //         //     '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
        //         //     '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
        //         //     '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
        //         // 'methods' => [
        //         //     'SetHeader' => [
        //         //         ['odd' => '$pdfHeader', 'even' => 'Krajee Report Header']
        //         //     ],
        //         //     // 'SetFooter' => [
        //         //     //     ['odd' => $pdfFooter, 'even' => $pdfFooter]
        //         //     // ],
        //         // // ],
        //         // 'options' => [
        //         //     'title' => $this->title,
        //         //     'subject' =>  'PDF Generado por Reyciklando App',
        //         //     'keywords' => 'Reyciklando, grid, export, yii2-grid, pdf'
        //         // ],
        //         'contentBefore'=>'',
        //         'contentAfter'=>''
        //     ]
        //     ],
        //     ],

        'panel' => [
            'heading'=>'<h3 class="panel-title">'.Icon::show('address-book', ['class'=>'fa', 'framework' => Icon::FA]). $this->title.' </h3>',
            'type'=>'primary',
            'showPageSummary' => true,
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
            [
                'attribute'=>'grupo',
                'value'=>function($model)
                {
                    return $model->cliente->grupoHotelero->grupo;
                }

            ],
            'fecha_solic',
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'Monto',
                'value' => function ($model, $key, $index, $widget) { 
                   
                    return $model->getImporte();
                },
                'format' => ['currency'],

                'pageSummary' => true

            ],
           // 'fecha_aprob',
           // 'fecha_ejec',
            //'status',
            
           
            ['class' => 'kartik\grid\ActionColumn',
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
