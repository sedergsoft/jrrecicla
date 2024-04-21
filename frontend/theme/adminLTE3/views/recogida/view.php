<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Recogida $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Recogidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="recogida-view">

  

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
            'transportistaid',
            'solicitudid',
            'fecha_recogida',
            'status',
        ],
          // 'enableEditMode'=>FALSE,
    'deleteOptions'=>[ // your ajax delete parameters
   'params' => ['id' => $model->id, 'custom_param' => true],
      'url' => ['delete', 'id' => $model->id],
]
    ]) ?>

</div>
