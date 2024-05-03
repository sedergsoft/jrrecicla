<?php

use frontend\controllers\ClienteController;
use frontend\controllers\SolicitudController;
use frontend\controllers\UserController;
use frontend\models\Cliente;
use frontend\models\GrupoHotelero;
use frontend\models\Solicitud;
use yii\helpers\Url;

if (Yii::$app->user->identity->rolid != 1)
     {
        ?>
        <div class="row">
        <div class="col-12 col-sm-6 col-md-6">
        <?= \hail812\adminlte\widgets\InfoBox::widget([
                            'text' => 'Cantidad de Solicitudes',
                            'number' => Solicitud::find()->andWhere(['status'=>1,'clienteid'=>UserController::findModel(Yii::$app->user->getId())->empresa->id])->count(),
                            'icon' => 'fas fa-clipboard-list',
                        ]) ?>
        
        </div>
        <div class="col-12 col-sm-6 col-md-6">
           <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Importe de Ventas',
                'number' =>Yii::$app->formatter->asCurrency(ClienteController::clienteimporte(UserController::findModel(Yii::$app->user->getId())->empresa->id,4)),
                'icon' => 'fas fa-dollar-sign',
                'iconTheme'=>'primary'
            ]) ?>
        </div>
    </div>
    <?php
     }else{
    ?>
                <div class="row">
                   
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <?= \hail812\adminlte\widgets\SmallBox::widget([
                            'title' => Cliente::find()->andWhere(['status'=>1])->count(),
                            'text' => 'Clientes',
                            'icon' => 'fas fa-users',
                            'linkText'=>'Ver Detalles',
                            'linkUrl'=> Url::to(['/cliente/index']),
                        ])?>
                     
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <?= \hail812\adminlte\widgets\SmallBox::widget([
                                    'title' => GrupoHotelero::find()->andWhere(['status'=>1])->count(),
                                    'text' => 'Cadenas',
                                    'icon' => 'fas fa-hotel',
                                    'linkText'=>'Ver Detalles',
                                    'theme'=>'primary',
                                    'linkUrl'=> Url::to(['/grupo-hotelero/index']),
                                ])?>
                        
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        
                            <?= \hail812\adminlte\widgets\SmallBox::widget([
                                                        'title' =>Yii::$app->formatter->asCurrency(SolicitudController::importeGeneralVentas(4)),
                                                        'text' => 'Importe de Compras',
                                                        'icon' => 'fas fa-dollar-sign',
                                                        'linkText'=>'Ver Detalles',
                                                        'theme'=>'success',
                                                        'linkUrl'=> Url::to(['/grupo-hotelero/index']),
                                ])?>
                  
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                <?= \hail812\adminlte\widgets\SmallBox::widget([
                                                                    'title' =>Yii::$app->formatter->asCurrency(SolicitudController::importeGeneralVentas(3)),
                                                                    'text' => 'Importe de Compras Pendientes',
                                                                    'icon' => 'fas fa-money-check-alt',
                                                                    'linkText'=>'Ver Detalles',
                                                                    'theme'=>'danger',
                                                                    'linkUrl'=> Url::to(['/grupo-hotelero/index']),
                                ])?>
                    
                    
                    </div>
                </div>
               
          <?php  } ?>

          <div class="row">
    <div class="col-md-6 col-sm-6 col-12 col-lg-3">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                 'id' => 'message-info-box',
                'text' => 'Solicitudes Activas',
                'theme'=>'info',
                'number' => $activas,
                'icon' => 'fas fa-paste',
            ]) 
           
            ?>
        </div>
        <div class="col-md-6 col-sm-6 col-12 col-lg-3">
            <?php
           // echo Yii::$app->formatter->asPercent(floatval(-0.009343));
            $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Nuevas Solicitudes',
                'number' => $nuevas,
               //  'theme' => 'info',
                'icon' => 'fas fa-clipboard',
                'progress' => [
                    'width' => $p =  ($nuevas/$activas)*100 .'%',
                   // 'description' => Yii::$app->formatter->asPercent(0.125, 2),
                'description' =>  SolicitudController::decimal(($nuevas/$activas)*100)   .' del total de Solicitudes activas'
                ]
            ]) ?>
            <?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $infoBox->id.'-ribbon',
                'text' => 'Nuevas',
                'theme' => 'danger',
               // 'size' => 'lg',
               // 'textSize' => 'lg'
            ]) ?>
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?php
           // echo Yii::$app->formatter->asPercent(floatval(-0.009343));
            $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Pendientes Solicitudes',
                'number' => $pendientes,
                'theme' => 'warning',
                'icon' => 'fas fa-clipboard',
                'progress' => [
                    'width' => $p =  ($pendientes/$activas)*100 .'%',
                   // 'description' => Yii::$app->formatter->asPercent(0.125, 2),
                'description' =>  SolicitudController::decimal(($pendientes/$activas)*100)   .' del total de Solicitudes activas'
                ]
            ]) ?>
        
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?php
           // echo Yii::$app->formatter->asPercent(floatval(-0.009343));
            $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Solicitudes Atendidas',
                'number' => $atendidas,
                'theme' => 'success',
                'icon' => 'fas fa-clipboard-check',
                'progress' => [
                    'width' => $p =  ($atendidas/$activas)*100 .'%',
                   // 'description' => Yii::$app->formatter->asPercent(0.125, 2),
                'description' =>  SolicitudController::decimal(($atendidas/$activas)*100)   .' del total de Solicitudes',
                ]
            ]) ?>
        
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>
      
    </div>