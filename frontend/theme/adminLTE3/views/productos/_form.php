<?php

use frontend\models\TipoProducto;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\icons\Icon;
use kartik\touchspin\TouchSpin;
use wbraganca\dynamicform\DynamicFormWidget;

/** @var yii\web\View $this */
/** @var frontend\models\Productos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="productos-form">
<div class="row">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

<div class="col-lg-12"> <?= $form->field($model, 'producto')->textInput(['maxlength' => true]) ?>  </div>

<div class="col-lg-12"> <?= $form->field($model, 'descripcion')->textarea(['row' => 3]) ?>  </div>
<div class="row">

    <div class="col-lg-6"> <?= $form->field($model, 'um')->textInput(['maxlength' => true]) ?>  </div>
    
    <div class="col-lg-6"> <?= $form->field($model, 'precio')->widget(TouchSpin::classname(), [
        'pluginOptions' => [
            'initval' => 3.00,
            'min' => 0,
            'max' => 100,
            'step' => 0.1,
            'decimals' => 2,
            'boostat' => 5,
            'maxboostedstep' => 10,
            'prefix' => '$',
            'buttonup_class' => 'btn btn-primary', 
            'buttondown_class' => 'btn btn-danger', 
            'buttonup_txt' => '<i class="fas fa-plus-circle"></i>', 
            'buttondown_txt' => '<i class="fas fa-minus-circle"></i>'
        ],
    'options' => ['placeholder' => 'Ajuste ...'],
]); ?>  </div>
</div>

<div class="card card-info">
       <div class="card-header" align = "center"><h4><i class="glyphicon glyphicon-download-alt"></i> Tipos de Producto que lo componen </h4></div>
       <div class="card-body">
            <?php DynamicFormWidget::begin([
               'widgetContainer' => 'dynamicform_wrapperTipoProd', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
               'widgetBody' => '.container-itemsTipoProd', // required: css class selector
               'widgetItem' => '.itemTipoProd', // required: css class
               'limit' => 8, // the maximum times, an element can be cloned (default 999)
               'min' => 1, // 0 or 1 (default 1)
               'insertButton' => '.add-itemTipoProd', // css class
               'deleteButton' => '.remove-itemTipoProd', // css class
               'model' => $TipoProd[0],
               'formId' => 'dynamic-form',
               'formFields' => [
                   'tipo_productoid',
                   'cant',
                   
               ],
           ]); ?>

           <div class="container-itemsTipoProd"><!-- widgetContainer -->
        
           <?php foreach ($TipoProd as $i => $modelTipoProd): ?>
         
               <div class="itemTipoProd card card-default" style="margin-top: 15px;"><!-- widgetBody -->
                   <div class="card-header">
                       <h3 class="card-title float-start">Tipo de Producto </h3>
                       <div class="float-end">
                           <button type="button" class="add-itemTipoProd btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                           <button type="button" class="remove-itemTipoProd btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                       </div>
                       <div class="clearfix"></div>
                   </div>
                   <div class="card-body">
                       <?php
                           // necessary for update action.
                         
                   
                           if (! $modelTipoProd->isNewRecord) {
                               echo Html::activeHiddenInput($modelTipoProd, "[{$i}]id");
                           }
                   
                       ?>
                       <div class="row">
                           
                               
                                                            
                           <div class="col-lg-6 col-sm-6">
                               <?= $form->field($modelTipoProd, "[{$i}]tipo_productoid")->widget(kartik\select2\Select2::className(),[
                        'data'=> yii\helpers\ArrayHelper::map(TipoProducto::find()->andWhere(['status'=>1])->all(), 'id', 'tipo'),
                        'pluginOptions'=>['placeholder'=>'Selecione el tipo de Producto..'],
                    ])?>
                      
                           </div>
                           <div class="col-lg-6 col-sm-6">
                               <?= $form->field($modelTipoProd, "[{$i}]cant")->textInput(['maxlength' => true])?>
                      
                           </div>
                       </div>
                      
                     
                   </div>
               </div>
           <?php endforeach; ?>
           
          
          
           </div>
           <?php DynamicFormWidget::end(); ?>

        </div>
</div>
    <div class="form-group" style="padding-top: 15px;">
        <?= Html::submitButton(Icon::show('save', ['class'=>'fa', 'framework' => Icon::FA]).Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
