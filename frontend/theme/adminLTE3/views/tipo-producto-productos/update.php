<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\TipoProductoProductos $model */

$this->title = Yii::t('app', 'Update Tipo Producto Productos: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Producto Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tipo-producto-productos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
