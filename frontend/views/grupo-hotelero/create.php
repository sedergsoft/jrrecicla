<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\GrupoHotelero $model */

$this->title = 'Crear Grupo Hotelero';
$this->params['breadcrumbs'][] = ['label' => 'Grupo Hoteleros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-hotelero-create">
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
