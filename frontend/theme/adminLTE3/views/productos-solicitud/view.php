<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\ProductosSolicitud $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos Solicituds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="productos-solicitud-view">

  

    <?= DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>'Cargo (' . $model->cargo .')',
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
            'id',
            'productosid',
            'solicitudid',
            'cant',
        ],
          // 'enableEditMode'=>FALSE,
    'deleteOptions'=>[ // your ajax delete parameters
   'params' => ['id' => $model->id, 'custom_param' => true],
      'url' => ['delete', 'id' => $model->id],
]
    ]) ?>

</div>
