<?php

use frontend\models\Cargos;
use frontend\models\GrupoHotelero;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\icons\Icon;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var frontend\models\Cliente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cliente-form">
    <?php $form = ActiveForm::begin(); ?>
<div class="row">

<div class="col-lg-6"> <?= $form->field($model, 'instalacion')->textInput(['maxlength' => true]) ?>  </div>

<div class="col-lg-6"> <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>  </div>

<div class="col-lg-6"> <?= $form->field($model, 'representante')->textInput(['maxlength' => true]) ?>  </div>

<div class="col-lg-3"> <?= $form->field($model, 'email' ,['addon' => [
                                                                    'prepend' => [
                                                                                 'content' => '<i class="glyphicon glyphicon-envelope"></i>'
                                                                                 ]
                                                    ],
            'feedbackIcon' => [
                                                            'default' => 'envelope',
                                                            'success' => 'ok',
                                                            'error' => 'exclamation-sign',
                                                            'defaultOptions' => ['class'=>'text-primary']]])->widget(MaskedInput::className(),[
                                                                'clientOptions' => ['alias' =>  'email']
                                                            ]) ?>
                                                              </div>

<div class="col-lg-3"> <?= $form->field($model, 'telefono' ,['addon' => [
                                                                    'prepend' => [
                                                                                 'content' => '<i class="glyphicon glyphicon-phone"></i>'
                                                                                 ]
                                                    ],
            'feedbackIcon' => [
                                                            'default' => 'phone',
                                                            'success' => 'ok',
                                                            'error' => 'exclamation-sign',
                                                            'defaultOptions' => ['class'=>'text-primary']]])->widget(MaskedInput::className(),[
                                                                'clientOptions' => ['alias' =>  '+999-999-9999']
                                                            ]) ?>  </div>



<div class="col-lg-6"> <?= $form->field($model, 'cargosid',['addon' => [
                                                                    'prepend' => [
                                                                                 'content' => '<i class="fa fa-venus-mars"></i>'
                                                                                 ]
                                                    ],
            /*'feedbackIcon' => [
                                                            'default' => 'link',
                                                            'success' => 'ok',
                                                            'error' => 'exclamation-sign',
                                                            'defaultOptions' => ['class'=>'text-primary']]*/])->widget(kartik\select2\Select2::className(),[
                        'data'=> yii\helpers\ArrayHelper::map(Cargos::find()->all(), 'id', 'cargo'),
                        'pluginOptions'=>['placeholder'=>'Selecione el Cargo'],
                    ])?>  </div>

<div class="col-lg-6"> <?= $form->field($model, 'grupo_hoteleroid',['addon' => [
                                                                    'prepend' => [
                                                                                 'content' => '<i class="fa fa-venus-mars"></i>'
                                                                                 ]
                                                    ],
            /*'feedbackIcon' => [
                                                            'default' => 'link',
                                                            'success' => 'ok',
                                                            'error' => 'exclamation-sign',
                                                            'defaultOptions' => ['class'=>'text-primary']]*/])->widget(kartik\select2\Select2::className(),[
                        'data'=> yii\helpers\ArrayHelper::map(GrupoHotelero::find()->all(), 'id', 'grupo'),
                        'pluginOptions'=>['placeholder'=>'Selecione el Grupo Hotelero'],
                    ])?>  </div>

    <div class="form-group">
        <?= Html::submitButton(Icon::show('save', ['class'=>'fa', 'framework' => Icon::FA]).Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>
     </div>

    <?php ActiveForm::end(); ?>

</div>
