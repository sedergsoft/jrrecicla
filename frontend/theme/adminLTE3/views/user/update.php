<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = Yii::t('app', 'Cambiar contraseña : {name}', [
    'name' => $model->username,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->username]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Cambiar contraseña');
$this->params['tittle'][]= $this->title;
?>
<div class="user-update">
   <?php if(Yii::$app->session->hasFlash("ok_error")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => "El usuario ". $_SESSION['user']. " no ha podido guardar la contraseña. Ha ocurrido un error en el proceso. "]);
        ?>
    <?php endif; ?>
   

    <?= $this->render('_pass', [
        'model' => $model,
    ]) ?>

</div>
