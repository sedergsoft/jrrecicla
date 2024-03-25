<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Productos $model */

$this->title = Yii::t('app', 'Crear Productos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-create">
    <div class="card">
        <div class="card-header">

    <h1><?= Html::encode($this->title) ?></h1>
    </div>
  <div class="card-body">
    <h5 class="card-title"></h5>

    <?= $this->render('_form', [
        'model' => $model,
        'TipoProd'=>$TipoProd,
    ]) ?>
     </div>
</div>

</div>
