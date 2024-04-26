<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\icons\Icon;

/** @var yii\web\View $this */
/** @var frontend\models\Notifications $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="notifications-form">
<div class="row">
    <?php $form = ActiveForm::begin(); ?>

<div class="col-lg-12"> <?= $form->field($model, 'user_id')->textInput() ?>  </div>

<div class="col-lg-12"> <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>  </div>

<div class="col-lg-12"> <?= $form->field($model, 'created_at')->textInput() ?>  </div>

<div class="col-lg-12"> <?= $form->field($model, 'read_status')->textInput() ?>  </div>

<div class="col-lg-12"> <?= $form->field($model, 'read_at')->textInput() ?>  </div>

<div class="col-lg-12"> <?= $form->field($model, 'status')->textInput() ?>  </div>

    <div class="form-group">
        <?= Html::submitButton(Icon::show('save', ['class'=>'fa', 'framework' => Icon::FA]).Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>
     </div>

    <?php ActiveForm::end(); ?>

</div>
