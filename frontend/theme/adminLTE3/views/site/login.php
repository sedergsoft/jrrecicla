<?php
use yii\helpers\Html;
$asset = frontend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;


?>

<div class="card card-outline card-success">
<div class="card-header text-center">

<div class="login-logo">
    <div>    
                    <img class="img-fluid" src=<?php echo$baseUrl."/images/logoReyciklando.png"?> alt="contint" style="display:inline; horizontal-align: top; max-height:250px;" />
                </div>
        
    </div>

    </div>
    <div class="card-body login-card-body">
        <p class="login-box-msg">Recicla con estilo. ¡Entra ya</p>

        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

        <?= $form->field($model,'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-8">
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => '<div class="icheck-primary">{input}{label}</div>',
                    'labelOptions' => [
                        'class' => ''
                    ],
                    'uncheck' => null
                ])->label('Recordarme') ?>
            </div>
            <div class="col-4">
                <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>

        <?php \yii\bootstrap4\ActiveForm::end(); ?>

        <!-- <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
        </div> -->
        <!-- /.social-auth-links -->

        <!-- <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
            <a href="register.html" class="text-center">Register a new membership</a>
        </p> -->
    </div>
    <div class="card card-outline">
    <div style="display: grid;justify-items: center;">    
                    <img class="img-fluid" src=<?php echo$baseUrl."/images/isde.png"?> alt="ISDE" style="horizontal-align: top;max-width: 50%;margin: 30px;" />
                </div>
        
    </div>
    <!-- /.login-card-body -->
</div>