<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\icons\Icon;

/** @var yii\web\View $this */
/** @var frontend\models\ProductosSolicitud $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="productos-solicitud-form">
<div class="row">
    <?php $form = ActiveForm::begin(); ?>

<div class="col-lg-12"> <?= $form->field($model, 'productosid')->textInput() ?>  </div>

<div class="col-lg-12"> <?= $form->field($model, 'solicitudid')->textInput() ?>  </div>

<div class="col-lg-12"> <?= $form->field($model, 'cant')->textInput() ?>  </div>

    <div class="form-group">
        <?= Html::submitButton(Icon::show('save', ['class'=>'fa', 'framework' => Icon::FA]).Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>
     </div>

    <?php ActiveForm::end(); ?>

</div>
