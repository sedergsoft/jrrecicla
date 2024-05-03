<?php

namespace frontend\controllers;

use frontend\models\Rol;
use frontend\models\User;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii2mod\user\models\UserModel;
use yii\filters\AccessControl;
use yii\web\MethodNotAllowedHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->isGuest)
        {
           return $this->redirect(['site/login']);   
        }
        // if(\yii::$app->user->can('ver_usuarios'))
        // {
            
            $model=User::find()->where(['id'=>$id])->one();
            $model->scenario = 'Cedit';
            if ($model->load(Yii::$app->request->post()) ) {
                // if($model->rolid!=4)
                // {
                //     $model->municipio=null;
                // }
            if($model->save())
            {

                Yii::$app->session->setFlash('kv-detail-success', 'La Información ha sido guardada correctamente.');
                Yii::$app->db->createCommand("DELETE FROM `auth_assignment` WHERE `auth_assignment`.`user_id` = '".$model->id."'")->execute();
                Yii::$app->db->createCommand("INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES ('".Rol::find()->where(['id'=>$model->rolid])->one()->rol."', '".$model->id."',  ". time().");")->execute();
                // Multiple alerts can be set like below
                //Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            //Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id' => $model->id]);
            }else{

                return print_r($model->errors);
            }
        } else {
            return Yii::$app->user->identity->rolid==1? $this->render('view', [ 'model' => $model]): $this->render('viewu', [ 'model' => $model]);
           // return $this->render('view', [ 'model' => $model]);
        }
    // }else{
    //         throw new \yii\web\ForbiddenHttpException(Yii::t('app', 'No tiene los permisos necesarios para realizar esta acción.'));
    //     }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) 
            {
                $user = new UserModel();
                $user->setAttributes($model->attributes);
                $user->rolid=$model->rolid; 
                $user->empresaid=$model->empresaid;
                $user->setPassword($model->password_hash);
                $user->setLastLogin(time());
                $user->generateAuthKey();
        
                if($user->save())
                {

                return $this->redirect(['view', 'id' => $user->id]);
                }
            
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionActivar($id)
    {
        if(Yii::$app->user->isGuest)
        {
           return $this->redirect(['site/login']);   
        }
        // if(\yii::$app->user->can('activar_usuario'))
        // {

            $model = $this->findModel($id);
                
            if ($model) 
            {
            $model->updateAttributes(['status'=>10]);
            $_SESSION['user'] = $model->username;
            Yii::$app->session->setFlash("ok_activado");
            return $this->redirect(['user/index']);
            }
        // }else{
        //         throw new \yii\web\ForbiddenHttpException(Yii::t('app', 'No tiene los permisos necesarios para realizar esta acción.'));
        //     }

        return $this->redirect(['user/index']);
    }
    public function actionDesactivar($id)
    {
        if(Yii::$app->user->isGuest)
        {
           return $this->redirect(['site/login']);   
        }
        // if(\yii::$app->user->can('desactivar_usuario'))
        // {
            
            $model = $this->findModel($id);
            
        if ($model) 
        {
            if($model->id != Yii::$app->user->identity->getId())
            {
       //         return print_r($model);
        $model->updateAttributes(['status'=>9]);
        $_SESSION['user'] = $model->username;
        Yii::$app->session->setFlash("ok_desactivado");
        return $this->redirect(['user/index']);
            }
            Yii::$app->session->setFlash("usuario_propio");
            return $this->redirect(['user/index']);
            
        }

    // }else{
    //         throw new \yii\web\ForbiddenHttpException(Yii::t('app', 'No tiene los permisos necesarios para realizar esta acción.'));
    //     }
        return $this->redirect(['user/index']);
    }
    public function actionPassword($id)
    {
        if(Yii::$app->user->isGuest)
        {
           return $this->redirect(['site/login']);   
        }
       
       if(\Yii::$app->user->getId() != $id)
       {
          
        if(!UserController::permitido())
        {
         
          throw new MethodNotAllowedHttpException('Usted solo puede cambiar la contraseña de su usuario o ser Administrador del sitio.');   
        }else{
                $model = $this->findModel($id);
                $model->password_hash = NULL;
                if($model->load(Yii::$app->request->post())) 
                    {
                     $user = UserModel::findIdentity($id);  
                    $user->setPassword($model->password_hash);
                    $user->generateAuthKey();
                    if( $user->update(false))
                        {
                        $_SESSION['user'] = $user->username;
                        Yii::$app->session->setFlash("ok_contraseña"); 
                        return $this->redirect(['/site/index']);
                        }else{
                            //return print_r($model->errors);
                            $model->password_hash = "";
                            $model->password_repeat = "";
                            $_SESSION['user'] = $model->username;
                                Yii::$app->session->setFlash("ok_error"); 
                             return $this->render('update', [
                            'model' => $model,
                                        ]);        
                        }
            
                    }
                    return $this->render('update', [
                    'model' => $model,
                                        ]);
    
            }
            
       }else{
        $model = $this->findModel($id);
        $model->password_hash = NULL;
        //return print_r('ok');
        if ($model->load(Yii::$app->request->post())) 
            {
                $user = UserModel::findIdentity($id);  
                $user->setPassword($model->password_hash);
                $user->generateAuthKey();
            if( $user->update(false))
            {
            $_SESSION['user'] = $model->username;
            Yii::$app->session->setFlash("ok_contraseña"); 
            return $this->redirect(['/site/index']);
            }
            
            }

        return $this->render('update', [
            'model' => $model,
        ]);
    
        }
       }

       public static function permitido() 
       {
       $flag = true;
       $flag1 = true;
           if(\Yii::$app->user->isGuest||\Yii::$app->user->identity->rolid != 1)
           {
               $flag = false;
           }
           if(\Yii::$app->user->isGuest||\Yii::$app->user->identity->rolid != 4)
           {
               $flag1 = false;
           }
           if($flag1==$flag)
           {
           return false;
             
           }else{
               return true;
           }    
       }
}
