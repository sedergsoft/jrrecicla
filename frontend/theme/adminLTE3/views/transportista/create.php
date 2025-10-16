<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Transportista $model */

$this->title = Yii::t('app', 'Crear Transportista');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transportistas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transportista-create">
    <div class="card">
        <div class="card-header">

    <h3><?= Html::encode($this->title) ?></h3>
    </div>
  <div class="card-body">
    <h5 class="card-title"></h5>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
     </div>
</div>

</div>
