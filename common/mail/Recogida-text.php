<?php

/** @var yii\web\View $this */


$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['recogida/detalles', 'id' => $recogida->id]);
?>
Hola <?= $recogida->transportista->chofer ?>,

Buenas, Sr(a) <?=$recogida->transportista->chofer?>:

Como Transportista Del Sistema de Recogida a cargo del Vehiculo (<?=$recogida->transportista->vehiculo?>)
Se le ha asignado la recogida perteneciente  al cliente <?= $solicitud->cliente->instalacion ?>
Para recoger en la instalación cita en :(<?= $solicitud->cliente->direccion ?>)
Con fecha de Recogida pactada para :<?=$recogida->fecha_recogida?>
Para más detalles, consulte su solicitud en el sistema.
Cliente :<?=$solicitud->cliente->instalacion?>
Representante :(<?=$solicitud->cliente->representante?>)
Teléfono (<?=$solicitud->cliente->telefono?>)
Correo Electronico (<?=$solicitud->cliente->email?>) 
Para más detalles, consulte su solicitud en el sistema.

Gracias por elejir nuestros Servicios.


<?= $verifyLink ?>
