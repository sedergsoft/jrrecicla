<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Recogida $model */

$this->title = Yii::t('app', 'Crear Recogida');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Recogidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recogida-create">
    <div class="card">
        <div class="card-header">

    <h1><?= Html::encode($this->title) ?></h1>
    </div>
  <div class="card-body">
    <h5 class="card-title"></h5>

    <?= $this->render('_form', [
          'model' => $model,
          'idsolicitud'=>$idsolicitud,
    ]) ?>
     </div>
</div>

</div>
