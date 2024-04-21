<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Cargos $model */

$this->title = 'Crear Cargos';
$this->params['breadcrumbs'][] = ['label' => 'Cargos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cargos-create">


<div class="card">
  <div class="card-header">
  <?= Html::encode($this->title) ?>
  </div>
  <div class="card-body">
    <h5 class="card-title"></h5>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
  </div>
</div>

</div>
