<?php

namespace frontend\controllers;

use Exception;
use frontend\models\Model;
use frontend\models\ProductosSolicitud;
use frontend\models\ProductosSolicitudSearch;
use frontend\models\Solicitud;
use kartik\form\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * ProductosSolicitudController implements the CRUD actions for ProductosSolicitud model.
 */
class ProductosSolicitudController extends Controller
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
     * Lists all ProductosSolicitud models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductosSolicitudSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductosSolicitud model.
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

    /**
     * Creates a new ProductosSolicitud model.
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
                                return $this->redirect(['view', 'id' => $model->id]);
                            }
                        } catch (Exception $e) {
                            $transaction->rollBack();
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'Prod'=>$Prod,
        ]);
    }

    /**
     * Updates an existing ProductosSolicitud model.
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
     * Deletes an existing ProductosSolicitud model.
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
     * Finds the ProductosSolicitud model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ProductosSolicitud the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductosSolicitud::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    // public static function contarProductos($tipo_producto)
    // {
    //     $cant = 0;
    //     $solicitudes = ProductosSolicitud::find()->andWhere(['status'=>1])->all();
    //     foreach($solicitudes as $key=>$solicitud)
    //     {
    //         $cant+=$solicitud->cantidadproductos($tipo_producto);
    //     }
    //     return $cant;

    // }

  
}
