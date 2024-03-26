<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\SolicitudSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="solicitud-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fecha_rec') ?>

    <?= $form->field($model, 'fecha_aprob') ?>

    <?= $form->field($model, 'fecha_ejec') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'clienteid') ?>

    <?php // echo $form->field($model, 'tipo_estado_solicitudid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
