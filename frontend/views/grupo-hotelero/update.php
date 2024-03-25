<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\GrupoHotelero $model */

$this->title = 'Update Grupo Hotelero: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Grupo Hoteleros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grupo-hotelero-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
