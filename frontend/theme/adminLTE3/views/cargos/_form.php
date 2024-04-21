<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Cargos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cargos-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">

        <div class="col-lg-12">

        <?= $form->field($model, 'cargo')->textInput(['maxlength' => true]) ?>
    </div>


    <div class="form-group" style="margin-top: 15px;">
        <?= Html::submitButton(Icon::show('save', ['class'=>'fa', 'framework' => Icon::FA]).' Guardar', ['class' => 'btn btn-success']) ?>
    </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
