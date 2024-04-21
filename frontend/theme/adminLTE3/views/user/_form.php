<?php

use frontend\models\Cliente;
use frontend\models\Rol;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\icons\Icon;
use kartik\select2\Select2;
use Mpdf\Tag\Select;

/** @var yii\web\View $this */
/** @var frontend\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
<div class="row">

<div class="col-lg-6"> <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>  </div>

<div class="col-lg-6"> <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>  </div>


<div class="col-lg-6"> <?= $form->field($model, 'password_hash')->passwordInput() ?>  </div>

<div class="col-lg-6"> <?= $form->field($model, 'password_repeat')->passwordInput()  ?>  </div>


<div class="col-lg-6"> <?= $form->field($model, 'rolid')->widget(Select2::className(),[
                        'data'=> yii\helpers\ArrayHelper::map(Rol::find()->andWhere(['status'=>1])->andWhere(['NOT',['id'=>1]])->all(), 'id', 'rol'),
                        'pluginOptions'=>['placeholder'=>'Selecione el tipo de  usuario..'],
                    ])?>  </div>

<div class="col-lg-6"> <?= $form->field($model, 'empresaid')->widget(Select2::className(),[
                        'data'=> yii\helpers\ArrayHelper::map(Cliente::find()->andWhere(['status'=>1])->all(), 'id', 'representante'),
                        'pluginOptions'=>['placeholder'=>'Selecione el cliente..'],
                    ])?>  </div>



    <div class="form-group">
        <?= Html::submitButton(Icon::show('save', ['class'=>'fa', 'framework' => Icon::FA]).Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>
     </div>

    <?php ActiveForm::end(); ?>

</div>
