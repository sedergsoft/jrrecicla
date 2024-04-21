<?php

use frontend\models\Solicitud;
use frontend\models\Transportista;
use kartik\date\DatePicker;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\icons\Icon;

/** @var yii\web\View $this */
/** @var frontend\models\Recogida $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="recogida-form">
<div class="row">
    <?php $form = ActiveForm::begin(); ?>

<div class="col-lg-12"> <?= $form->field($model, 'transportistaid')->widget(kartik\select2\Select2::className(),[
                        'data'=> yii\helpers\ArrayHelper::map(Transportista::find()->andWhere(['status'=>1])->all(), 'id', 'chofer'),
                        'pluginOptions'=>['placeholder'=>'Selecione el transportista..'],
                    ])?>   </div>

<div class="col-lg-12"> <?= $form->field($model, 'solicitudid')->widget(kartik\select2\Select2::className(),[
                        'data'=> yii\helpers\ArrayHelper::map(Solicitud::find()->andWhere(['status'=>1,'tipo_estado_solicitudid'=>2,'id'=>$idsolicitud])->all(), 'id', 'cliente.instalacion'),
                        'pluginOptions'=>['placeholder'=>'Selecione la solicitud..'],
                    ])?>  </div>

<div class="col-lg-12"> <?= $form->field($model, 'fecha_recogida')->widget(DatePicker::classname(), [
                    
                    'options' => ['placeholder' => 'Entre la fecha ...',
                        'label'=> 'Fecha de recogida Prevista',
                        ],

                        'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                        'startDate' => date('Y-m-d'),

                    ]
                ]) ?>  
                </div>

    <div class="form-group">
        <?= Html::submitButton(Icon::show('save', ['class'=>'fa', 'framework' => Icon::FA]).Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>
     </div>

    <?php ActiveForm::end(); ?>

</div>
