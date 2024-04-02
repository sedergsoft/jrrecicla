<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\icons\Icon;

/** @var yii\web\View $this */
/** @var frontend\models\Transportista $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="transportista-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

<div class="col-lg-4"> <?= $form->field($model, 'vehiculo')->textInput(['maxlength' => true]) ?>  </div>

<div class="col-lg-8"> <?= $form->field($model, 'chofer')->textInput(['maxlength' => true]) ?>  </div>


    <div class="form-group">
        <?= Html::submitButton(Icon::show('save', ['class'=>'fa', 'framework' => Icon::FA]).Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>
</div>

    <?php ActiveForm::end(); ?>

</div>
