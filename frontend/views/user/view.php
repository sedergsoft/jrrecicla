<?php

use frontend\models\Cliente;
use frontend\models\Rol;
use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var frontend\models\User $model */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

  

    <?= DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>'Usuario (' . $model->username .')',
        'type'=>DetailView::TYPE_PRIMARY,
    ],
    'attributes'=>[
          //  'id',
            'username',
           // 'auth_key',
            //'password_hash',
           // 'password_reset_token',
            'email:email',
            [
                'attribute'=>'status',
                'format'=>'raw',
                'value'=> $model->status==10?'<span class="badge text-bg-success"> Activo </span>':'<span class="badge text-bg-danger"> Inactivo </span>',
                'type'=> DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                                'data'=>[10 => 'Activo',9=>'Inactivo'],

                                ],
 
            ],
            [
                'attribute'=>'rolid',
                'value'=> $model->rol->rol,
                'type'=> DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                                'data'=> ArrayHelper::map(Rol::find()->andWhere(['status'=>1])->andWhere(['NOT',['id'=>1]])-> all(), 'id', 'rol'),

                                ],
            ],
            [
                'attribute'=>'empresaid',
                'value'=> $model->empresaid==NULL?'Trabajador del Sistema':$model->empresa->instalacion,
                'type'=> DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                                'data'=> ArrayHelper::map(Cliente::find()->andWhere(['status'=>1])->all(), 'id', 'instalacion'),
                                'options' => ['placeholder' => 'Seleciona la entidad ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                                ],
            ],
          
          //  'empresa.instalacion',
          //  'municipio',
        [
            'attribute'=>'created_at',
            'format'=>'date',
            'displayOnly'=>true,
            
        ],
        [
            'attribute'=>'updated_at',
            'format'=>'date',
            'displayOnly'=>true,
            
        ],
        [
            'attribute'=>'last_login',
            'format'=>'date',
            'displayOnly'=>true,
            
        ],
       
        ],
          // 'enableEditMode'=>FALSE,
    'deleteOptions'=>[ // your ajax delete parameters
   'params' => ['id' => $model->id, 'custom_param' => true],
      'url' => ['delete', 'id' => $model->id],
]
    ]) ?>

</div>
