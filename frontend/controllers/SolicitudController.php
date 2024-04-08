<?php

namespace frontend\controllers;

use Exception;
use frontend\models\Model;
use frontend\models\ProductosSolicitud;
use frontend\models\ProductosSolicitudSearch;
use frontend\models\Recogida;
use frontend\models\Solicitud;
use frontend\models\SolicitudSearch;
use frontend\models\TipoProducto;
use kartik\form\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * SolicitudController implements the CRUD actions for Solicitud model.
 */
class SolicitudController extends Controller
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
            ]
        );
    }

    /**
     * Lists all Solicitud models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SolicitudSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if(Yii::$app->user->identity->rolid!=1)
        {
            $dataProvider->query->andWhere(['clienteid'=>UserController::findModel(Yii::$app->user->getId())->empresa->id])->all();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Solicitud model.
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
        
        $model=$this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', 'La información ha sido guardada correctamente');
            // Multiple alerts can be set like below
           // Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
           // Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', [ 'model' => $model]);
        }
    }
    public function actionDetalles($id)
    {
      if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);   
        }
        
        $model=$this->findModel($id);
        if($model)
        {
            $searchModelProductos = new ProductosSolicitudSearch();
            $dataProviderProductos = $searchModelProductos->search($this->request->queryParams);
            $dataProviderProductos->query->andWhere(['status'=>1,'solicitudid'=>$model->id])->all();
            $tipoProductos = SolicitudController::Obtenerproductos($id);
            $dataProviderTipo = new ActiveDataProvider(['query'=>TipoProducto::find()->innerJoinWith('tipoProductoProductos')->innerJoinWith('tipoProductoProductos.productos')->JoinWith(['tipoProductoProductos.productos.productosSolicituds'])->andWhere(['productos_solicitud.solicitudid'=>$id])]);
            return $this->render('detalles', [
                        'modelSolicitud' => $model,
                        'tipoProductos' => $dataProviderTipo,
                        'searchModelProductos'=>$searchModelProductos,
                        'dataProviderProductos'=>$dataProviderProductos,

                    ]);
        }
        
    }
    public function actionNuevasolicitudes()
    {
        $searchModel = new SolicitudSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['status'=>1,'tipo_estado_solicitudid'=>1])->all();
        if(Yii::$app->user->identity->rolid!=1)
        {
            $dataProvider->query->andWhere(['clienteid'=>UserController::findModel(Yii::$app->user->getId())->empresa->id])->all();
        }
        return $this->render('new', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    public function actionAprobadas()
    {
        $searchModel = new SolicitudSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['status'=>1,'tipo_estado_solicitudid'=>2])->all();
        if(Yii::$app->user->identity->rolid!=1)
        {
            $dataProvider->query->andWhere(['clienteid'=>UserController::findModel(Yii::$app->user->getId())->empresa->id])->all();
        }
        return $this->render('aprobadas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    public function actionHistorial()
    {
        $searchModel = new SolicitudSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['status'=>1,'tipo_estado_solicitudid'=>4])->all();
        if(Yii::$app->user->identity->rolid!=1)
        {
            $dataProvider->query->andWhere(['clienteid'=>UserController::findModel(Yii::$app->user->getId())->empresa->id])->all();
        }
        return $this->render('historial', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    public function actionRechazadas()
    {
        $searchModel = new SolicitudSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['status'=>1,'tipo_estado_solicitudid'=>5])->all();
        if(Yii::$app->user->identity->rolid!=1)
        {
            $dataProvider->query->andWhere(['clienteid'=>UserController::findModel(Yii::$app->user->getId())->empresa->id])->all();
        }
        return $this->render('rechazadas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    public function actionPendiente()
    {
        $searchModel = new SolicitudSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['status'=>1,'tipo_estado_solicitudid'=>3])->all();
        if(Yii::$app->user->identity->rolid!=1)
        {
            $dataProvider->query->andWhere(['clienteid'=>UserController::findModel(Yii::$app->user->getId())->empresa->id])->all();
        }
        return $this->render('pendientes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    public function actionAccion($id,$tipo)
    {
        $solicitud = $this->findmodel($id);
        if($solicitud)
        {

            switch ($tipo) {
                case '2':
                    $solicitud->updateAttributes(['tipo_estado_solicitudid'=>2,'fecha_aprob'=>date('Y-m-d')]);
                    
                    $this->Notificarestado($solicitud);
                    return $this->redirect(['detalles','id'=>$solicitud->id]);
                    break;
                case '1':
                $solicitud->updateAttributes(['tipo_estado_solicitudid'=>5]);
                    $this->Notificarestado($solicitud);
                    return $this->redirect(['detalles','id'=>$solicitud->id]);
                    break;
                case '4':
                
                    return $this->redirect(['recogida/create','idsolicitud'=>$solicitud->id]);
                    break;
                case '5':
                    $solicitud->updateAttributes(['tipo_estado_solicitudid'=>4,'fecha_ejec'=>date('Y-m-d')]);
                    $this->Notificarestado($solicitud);
                    return $this->redirect(['detalles','id'=>$solicitud->id]);
                    break;
                
                default:
                # code...
                break;
            } 
        }
    }

    /**
     * Creates a new Solicitud model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    
    public function actionCreate()
    {
        $model = new Solicitud();
        $Prod = [new ProductosSolicitud()];

        if ($this->request->isPost) {
            
                if ($model->load($this->request->post()) && $model->load(Yii::$app->request->post())) {

                    $Prod = Model::createMultiple(ProductosSolicitud::classname());
                    Model::loadMultiple($Prod, Yii::$app->request->post());
        
                    // ajax validation
                    if (Yii::$app->request->isAjax) {
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        return ArrayHelper::merge(
                            ActiveForm::validateMultiple($Prod),
                            ActiveForm::validate($model)
                        );
                    }
        
                    // validate all models
                    $valid = $model->validate();
                    $valid = Model::validateMultiple($Prod) && $valid;
                    
                    if ($valid) {
                        $transaction = \Yii::$app->db->beginTransaction();
                        try {
                            $model->tipo_estado_solicitudid = 1;
                            $model->fecha_solic = date('Y-m-d');
                            if ($flag = $model->save(false)) {
                                foreach ($Prod as $modelProducto) {
                                    $modelProducto->solicitudid = $model->id;
                                    if (! ($flag = $modelProducto->save(false))) {
                                        $transaction->rollBack();
                                        break;
                                    }
                                }
                            }
                            if ($flag) {
                                $transaction->commit();
                                return $this->redirect(['detalles', 'id' => $model->id]);
                            }
                        } catch (Exception $e) {
                            $transaction->rollBack();
                            return print_r($e);
                            return $this->render('create', [
                                'model' => $model,
                                'Prod'=>$Prod,
                            ]);
                        }
                    }else{
                        return print_r($model->errors);
                        return $this->render('create', [
                            'model' => $model,
                            'Prod'=>$Prod,
                        ]);  
                    }
                }
            
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'Prod'=>$Prod,
        ]);
    }

    /**
     * Updates an existing Solicitud model.
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
     * Deletes an existing Solicitud model.
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
     * Finds the Solicitud model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Solicitud the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Solicitud::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function Obtenerproductos($id)
    {
        $productos = TipoProducto::find()->innerJoinWith('tipoProductoProductos')->innerJoinWith('tipoProductoProductos.productos')->JoinWith(['tipoProductoProductos.productos.productosSolicituds'])->andWhere(['productos_solicitud.solicitudid'=>$id])->all();
        return $productos;
    
    }

    public static function Notificarestado($solicitud,$tipo = NULL)
    {
       if($tipo == 2)
       {
        $recogida=Recogida::find()->andWhere(['status'=>1,'solicitudid'=>$solicitud->id])->one();
        return Yii::$app
        ->mailer
        ->compose(
            ['html' => 'Solicitud_estado-trans-html', 'text' => 'Solicitud_estado-trans-text'],
            ['solicitud' => $solicitud,'recogida'=>$recogida]
        )
        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
        ->setTo($solicitud->cliente->email)
        ->setSubject('Cambio de estado de la Solicitud ' . Yii::$app->name)
        ->send();
       } 
        return Yii::$app
        ->mailer
        ->compose(
            ['html' => 'Solicitud_estado-html', 'text' => 'Solicitud_estado-text'],
            ['solicitud' => $solicitud]
        )
        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
        ->setTo($solicitud->cliente->email)
        ->setSubject('Cambio de estado de la Solicitud ' . Yii::$app->name)
        ->send();  
    }
}
