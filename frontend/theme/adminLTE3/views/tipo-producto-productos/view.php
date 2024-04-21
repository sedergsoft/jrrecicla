<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\TipoProductoProductos $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Producto Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tipo-producto-productos-view">

  

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
            'tipo_productoid',
            'productosid',
            'status',
        ],
          // 'enableEditMode'=>FALSE,
    'deleteOptions'=>[ // your ajax delete parameters
   'params' => ['id' => $model->id, 'custom_param' => true],
      'url' => ['delete', 'id' => $model->id],
]
    ]) ?>

</div>
