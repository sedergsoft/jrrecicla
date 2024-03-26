<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Solicitud $model */

$this->title = 'Solicitud - No.'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Solicitudes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="solicitud-view">

  

    <?= DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>$this->title,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
           // 'id',
            'fecha_solic',
            'fecha_rec',
            'fecha_aprob',
            'fecha_ejec',
            //'status',
            [
                'attribute' =>  'clienteid',
                // 'label' => 'sexo ',
                 'value'=> $model->cliente->instalacion,
                // 'type'=> DetailView::INPUT_TEXTAREA, 
               ],
            [
                'attribute' =>  'tipo_estado_solicitudid',
                // 'label' => 'sexo ',
                 'value'=> $model->tipoEstadoSolicitud->estado,
                // 'type'=> DetailView::INPUT_TEXTAREA, 
               ],
           // 'clienteid',
         //   'tipo_estado_solicitudid',
        ],
           'enableEditMode'=>FALSE,
           'hideIfEmpty'=> TRUE,
    'deleteOptions'=>[ // your ajax delete parameters
   'params' => ['id' => $model->id, 'custom_param' => true],
      'url' => ['delete', 'id' => $model->id],
]
    ]) ?>

</div>
