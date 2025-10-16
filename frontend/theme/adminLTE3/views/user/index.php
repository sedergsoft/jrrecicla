<?php

use frontend\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

  

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax'=>true,
        'panel' => [
            'heading'=>'<h3 class="panel-title">'.Icon::show('address-book', ['class'=>'fa', 'framework' => Icon::FA]). $this->title.' </h3>',
            'type'=>'primary',
          
            'before'=>Html::a(Icon::show('user-plus', ['class'=>'fa', 'framework' => Icon::FA])." Agregar", ['create'], ['class' => 'btn btn-success', 'id'=>'agregar']),
           
        ],

        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            [
                'attribute'=>'status',
                'filterType' => GridView::FILTER_SELECT2,
              'filter' => [
                9 => 'Inactivo',
                10 => 'Activo',
             ], 
              'filterWidgetOptions' => [
                  'pluginOptions' => ['allowClear' => true],
              ],
              'filterInputOptions' => ['placeholder' => 'Estado..'],
                'format'=>'raw',
                'value'=>function($model)
                {
                    switch ($model->status) {
                        case '9':
                            return '<h5><span class="badge badge-danger"> Inactivo </span></h5>';
                            break;
                        case '10':
                            return '<h5><span class="badge badge-success"> Activo </span></h5>';
                            break;
                      
                        default:
                            # code...
                            break;
                    }
                   
                }

            ],
            [
                'attribute'=>'rolid',
                'value'=>function($model)
                {
                   return $model->rol->rol; 
                }

            ],
            [
                'attribute'=>'empresaid',
                'value'=>function($model)
                {
                    
                return    $model->empresaid==null?'Trabajador del Sistema':$model->empresa->instalacion;
                }

            ],
           
            
            //'municipio',
            //'created_at',
            //'updated_at',
            //'last_login',
            ['class' => 'kartik\grid\ActionColumn',
            'template' => '{view} {password} {Activar}',
               'buttons' => [
                   'password' => function ($url, $model){

                                                        
                                                            return Html::a('<i class="fa fa-lock"></i>', 
                                                                    ['password','id'=>$model->id],
                                                                    
                                                                    ['class' => 'btn btn-primary btn-xs',
                                                                      'title' => 'Cambiar Contraseña'  
                                                                        ]);
                                                        
                                    
            
                        },
                                'Activar' => function ($url, $model){
             
              if( $model->status ==10){
                  
                   return Html::a('<i class="fa fa-user-times"></i>', 
                                                                    ['desactivar','id'=>$model->id],
                                                                    
                                                                    ['class' => 'btn btn-danger btn-xs',
                                                                      'title' => 'Desactivar Usuario'  
                                                                        ]);
                                                        
                  
                
                          }else{
                               return Html::a('<i class="fa fa-user-check"></i>', 
                                                                    ['activar','id'=>$model->id],
                                                                    
                                                                    ['class' => 'btn btn-success btn-xs',
                                                                      'title' => 'Activar Usuario'  
                                                                        ]);
                  
              
                          }        
              
              
                        },
                                   'view' => function ($url, $model){
                                                        
                                                            return Html::a('<i class="fa fa-eye"></i>', 
                                                                    ['view','id'=>$model->id],
                                                                    
                                                                    ['class' => 'btn btn-info btn-xs',
                                                                      'title' => 'Ver',
                                                                       // 'style'=>"margin-left: 10px"
                                                                        ]);
                                                        
                                                         }, 
              ],
      ],
        
        ],
    ]); ?>


</div>
