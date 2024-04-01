<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['solicitud/detalles', 'id' => $solicitud->id]);
?>
<div class="verify-email">
    <p>Hola <?= $solicitud->cliente->instalacion ?> :</p>
    
    <p>Buenas, Sr(a) <?=$solicitud->cliente->representante?></p>

    <p>Como representante de la institución <?= $solicitud->cliente->instalacion ?> ante nuestros servicios</p>

    <p>le informamos por esta via que la solicitud (<?=$solicitud->id?>) ha cambiado al estado de (<?=$solicitud->tipoEstadoSolicitud->estado?>).</p>

    <p>Para más detalles, consulte su solicitud en el sistema.</p>
    
    <p>Gracias por elejir nuestros Servicios.</p>

    <?= $verifyLink ?>
</div>






