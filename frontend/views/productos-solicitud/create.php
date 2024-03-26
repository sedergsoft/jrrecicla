<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\ProductosSolicitud $model */

$this->title = Yii::t('app', 'Crear Productos Solicitud');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos Solicituds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-solicitud-create">
    <div class="card">
        <div class="card-header">

    <h1><?= Html::encode($this->title) ?></h1>
    </div>
  <div class="card-body">
    <h5 class="card-title"></h5>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
     </div>
</div>

</div>
