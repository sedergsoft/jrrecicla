<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Transportista $model */

$this->title = 'Vehiculo('.$model->vehiculo.')';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transportistas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transportista-view">

  

    <?= DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>'Vehiculo (' . $model->vehiculo .')',
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
           // 'id',
            'vehiculo',
            'chofer',
           // 'status',
        ],
          // 'enableEditMode'=>FALSE,
    'deleteOptions'=>[ // your ajax delete parameters
   'params' => ['id' => $model->id, 'custom_param' => true],
      'url' => ['delete', 'id' => $model->id],
]
    ]) ?>

</div>
