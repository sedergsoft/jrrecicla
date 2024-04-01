<?php

/** @var yii\web\View $this */


$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['solicitud/detalles', 'id' => $solicitud->id]);
?>
Hola <?= $solicitud->cliente->instalacion ?>,

Buenas, Sr(a) <?=$solicitud->cliente->representante?>:

Como representante de la institución <?= $solicitud->cliente->instalacion ?> ante nuestros servicios 
le informamospor esta via que la solicitud (<?=$solicitud->id?>) ha cambiado al estado de (<?=$solicitud->tipoEstadoSolicitud->estado?>).
Para más detalles, consulte su solicitud en el sistema.

Gracias por elejir nuestros Servicios.


<?= $verifyLink ?>
