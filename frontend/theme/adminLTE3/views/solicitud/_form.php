<?php

use frontend\controllers\UserController;
use frontend\models\Cliente;
use frontend\models\Productos;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\icons\Icon;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var frontend\models\Solicitud $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="solicitud-form">
<div >
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>





<div class="col-lg-12"> <?= $form->field($model, 'clienteid')->widget(Select2::className(),[
                        'data'=> Yii::$app->user->identity->rolid==1?ArrayHelper::map(Cliente::find()->andWhere(['status'=>1])->all(), 'id', 'instalacion'):ArrayHelper::map(Cliente::find()->andWhere(['status'=>1])->andWhere(['id'=>UserController::findModel(Yii::$app->user->getId())->empresa->id])->all(), 'id', 'instalacion'),
                        'pluginOptions'=>['placeholder'=>'Selecione el cliente..'],
                    ])?>  </div>

<div class="card card-info">
       <div class="card-header" align = "center"><h4><i class="glyphicon glyphicon-download-alt"></i> Productos a Recoger </h4></div>
       <div class="card-body">
            <?php DynamicFormWidget::begin([
               'widgetContainer' => 'dynamicform_wrapperProd', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
               'widgetBody' => '.container-itemsProd', // required: css class selector
               'widgetItem' => '.itemProd', // required: css class
               'limit' => 8, // the maximum times, an element can be cloned (default 999)
               'min' => 1, // 0 or 1 (default 1)
               'insertButton' => '.add-itemProd', // css class
               'deleteButton' => '.remove-itemProd', // css class
               'model' => $Prod[0],
               'formId' => 'dynamic-form',
               'formFields' => [
                   'tipo_productoid',
                   
               ],
           ]); ?>

           <div class="container-itemsProd"><!-- widgetContainer -->
        
           <?php foreach ($Prod as $i => $modelProd): ?>
         
               <div class="itemProd card card-default" style="margin-top: 15px;"><!-- widgetBody -->
                   <div class="card-header">
                       <h3 class="card-title float-start"> Producto </h3>
                       <div class="row justify-content-end">
                           <button type="button" class="add-itemProd btn btn-success btn-xs" style="margin-right:5px;"><i class="fa fa-plus"></i></button>
                           <button type="button" class="remove-itemProd btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                       </div>
                       <div class="clearfix"></div>
                   </div>
                   <div class="card-body">
                       <?php
                           // necessary for update action.
                         
                   
                           if (! $modelProd->isNewRecord) {
                               echo Html::activeHiddenInput($modelProd, "[{$i}]id");
                           }
                   
                       ?>
                       <div class="row">
                           
                               
                                                            
                           <div class="col-lg-8 ">
                               <?= $form->field($modelProd, "[{$i}]productosid")->widget(kartik\select2\Select2::className(),[
                        'data'=> yii\helpers\ArrayHelper::map(Productos::find()->andWhere(['status'=>1])->all(), 'id', 'producto'),
                        'pluginOptions'=>['placeholder'=>'Selecione el Producto..'],
                    ])?>
                      
                           </div>

                                                
                        <div class="col-lg-4 "> <?= $form->field($modelProd, "[{$i}]cant")->textInput() ?>  </div>

                        </div>
                      
                     
                   </div>
               </div>
           <?php endforeach; ?>
           
          
          
           </div>
           <?php DynamicFormWidget::end(); ?>

        </div>
</div>

    <div class="form-group" style="margin-top: 15px;">
        <?= Html::submitButton(Icon::show('save', ['class'=>'fa', 'framework' => Icon::FA]).Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>
     </div>

    <?php ActiveForm::end(); ?>

</div>
