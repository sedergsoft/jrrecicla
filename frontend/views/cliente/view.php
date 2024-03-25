<?php

use frontend\models\Cargos;
use frontend\models\GrupoHotelero;
use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var frontend\models\Cliente $model */

$this->title = 'Cliente - ('.$model->instalacion.')';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cliente-view">

  

    <?= DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>'Cliente (' . $model->instalacion .')',
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
            //'id',
            'instalacion',
            'direccion',
            'representante',
            'email:email',
            'telefono',
           // 'status',
           [
            'attribute' =>  'cargosid',
             'label' => 'Cargo ',
             'value'=> $model->cargos->cargo,
             'type'=> DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                              'data'=> ArrayHelper::map(Cargos::find()-> all(), 'id', 'cargo'),
                             
                              ],
           ],
           [
            'attribute' =>  'grupo_hoteleroid',
             'label' => 'Grupo Hotelero ',
             'value'=> $model->grupoHotelero->grupo,
             'type'=> DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                              'data'=> ArrayHelper::map(GrupoHotelero::find()-> all(), 'id', 'grupo'),
                             
                              ],
           ],
        ],
          // 'enableEditMode'=>FALSE,
    'deleteOptions'=>[ // your ajax delete parameters
   'params' => ['id' => $model->id, 'custom_param' => true],
      'url' => ['delete', 'id' => $model->id],
]
    ]) ?>

</div>
