<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\icons\Icon;

/** @var yii\web\View $this */
/** @var frontend\models\GrupoHotelero $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="grupo-hotelero-form">
<div class="row">
    <?php $form = ActiveForm::begin(); ?>

<div class="col-lg-12"> <?= $form->field($model, 'grupo')->textInput(['maxlength' => true]) ?>  </div>



    <div class="form-group">
        <?= Html::submitButton(Icon::show('save', ['class'=>'fa', 'framework' => Icon::FA]).'Guardar', ['class' => 'btn btn-success']) ?>
    </div>
     </div>

    <?php ActiveForm::end(); ?>

</div>
