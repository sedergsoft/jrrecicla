<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\icons\Icon;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var frontend\models\Transportista $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="transportista-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

<div class="col-lg-4"> <?= $form->field($model, 'vehiculo')->textInput(['maxlength' => true]) ?>  </div>

<div class="col-lg-8"> <?= $form->field($model, 'chofer')->textInput(['maxlength' => true]) ?>  </div>
<div class="col-lg-6">
    <?= $form->field($model, 'email' ,['addon' => [
                                                                    'prepend' => [
                                                                                 'content' => '<i class="fa fa-envelope"></i>'
                                                                                 ]
                                                    ],
            'feedbackIcon' => [
                                                            'default' => 'envelope',
                                                            'success' => 'ok',
                                                            'error' => 'exclamation-sign',
                                                            'defaultOptions' => ['class'=>'text-primary']]])->widget(MaskedInput::className(),[
                                                                'clientOptions' => ['alias' =>  'email']
                                                            ])  ?>
</div>
<div class="col-lg-6">
    <?= $form->field($model, 'telefono' ,['addon' => [
                                                                    'prepend' => [
                                                                                 'content' => '<i class="fa fa-phone"></i>'
                                                                                 ]
                                                    ],
            'feedbackIcon' => [
                                                            'default' => 'phone',
                                                            'success' => 'ok',
                                                            'error' => 'exclamation-sign',
                                                            'defaultOptions' => ['class'=>'text-primary']]])->widget(MaskedInput::className(),[
                                                                'clientOptions' => ['alias' =>  '+999-999-9999']
                                                            ]) ?>
</div>

    <div class="form-group">
        <?= Html::submitButton(Icon::show('save', ['class'=>'fa', 'framework' => Icon::FA]).Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>
</div>

    <?php ActiveForm::end(); ?>

</div>
