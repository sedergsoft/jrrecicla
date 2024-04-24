<?php

namespace frontend\controllers;

use frontend\models\ProductosSolicitud;
use frontend\models\Solicitud;
use frontend\models\TipoProducto;
use frontend\models\TipoProductoProductos;
use frontend\models\TipoProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\filters\AccessControl;

/**
 * TipoProductoController implements the CRUD actions for TipoProducto model.
 */
class TipoProductoController extends Controller
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
     * Lists all TipoProducto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TipoProductoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoProducto model.
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
     * Creates a new TipoProducto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TipoProducto();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TipoProducto model.
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
     * Deletes an existing TipoProducto model.
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
     * Finds the TipoProducto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TipoProducto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TipoProducto::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionCant($estado_sol=null)
    {
        $searchModel = new TipoProductoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        switch ($estado_sol) {
            case 'null':
                $tabla = 'Todas los Solicitudes';
                break;
                
                case 4:
                    $tabla = 'Productos Recogidos';
                    break;
                case 3:
                    $tabla = 'Productos pendientes por Recoger';
                    break;
                case 5:
                    $tabla = 'Solicitudes Canceladas';
                    break;
            default:
                $tabla = 'Todas los Solicitudes';
                break;
        }
        $_SESSION['estado'] = $estado_sol;
        return $this->render('cant', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tabla'=>$tabla,
        ]);
    }

    // public static function cantProd($tipo_prod)
    // {
    //     $estado = $_SESSION['estado'];
    //    // return print_r($tipo_prod.'-'.$estado);
    //     $cant_prod=0;
    //     if(Yii::$app->user->identity->rolid!=1)
    //     {

    //         $estado==null?$solicitudes = Solicitud::find()->andWhere(['status'=>1,'clienteid'=>UserController::findModel(Yii::$app->user->getId())->empresa->id])->all():$solicitudes = Solicitud::find()->where(['status'=>1,'tipo_estado_solicitudid'=>$estado,'clienteid'=>UserController::findModel(Yii::$app->user->getId())->empresa->id])->all();
    //     }else{

    //         $estado==null?$solicitudes = Solicitud::find()->where(['status'=>1])->all():$solicitudes = Solicitud::find()->where(['status'=>1,'tipo_estado_solicitudid'=>$estado])->all();
    //     }
    //     // if($estado==null)
    //     // {
    //     //     $solicitudes = Solicitud::find()->where(['status'=>1])->all();
            
    //     // }else{
    //     //     $solicitudes = Solicitud::find()->where(['status'=>1,'tipo_estado_solicitudid'=>$estado])->all();
    //     //     }
    //    // $solicitudes = Solicitud::find()->where(['status'=>1])->all();
    //     if($solicitudes)
    //     {
    //         foreach ($solicitudes as $key => $solicitud) 
    //         {
    //             $productos=ProductosSolicitud::find()->andWhere(['status'=>1,'solicitudid'=>$solicitud->id])->all();
    //             if($productos)
    //             {
    //                 foreach ($productos as $key => $producto)
    //                 {
    //                     $tipo_producto = TipoProductoProductos::find()->andWhere(['status'=>1,'productosid'=>$producto->productosid,'tipo_productoid'=>$tipo_prod])->all();
    //                     if($tipo_producto)
    //                     {
    //                     	foreach ($tipo_producto as $key => $tproducto) 
    //                         {
    //                             $cant_prod +=$tproducto->cant*$producto->cant;
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     return $cant_prod;
    // }

  /**
 * Calcula la cantidad total de un tipo específico de producto en base a ciertas condiciones.
 *
 * @param int $tipo_prod El ID del tipo de producto a calcular.
 * @return int La cantidad total del tipo de producto especificado.
 */
public static function cantProd($tipo_prod)
{
    // Obtener el estado de la sesión
    $estado = $_SESSION['estado'];
    // Inicializar la variable para almacenar la cantidad total de productos
    $cant_prod = 0;
    
    // Crear la consulta base de solicitudes
    $query = Solicitud::find()->where(['status' => 1]);
    
    // Verificar el rol del usuario para filtrar las solicitudes
    if (Yii::$app->user->identity->rolid != 1) {
        $query->andWhere(['clienteid' => UserController::findModel(Yii::$app->user->getId())->empresa->id]);
    }
    
    // Filtrar las solicitudes por estado si se proporciona
    if ($estado !== null) {
        $query->andWhere(['tipo_estado_solicitudid' => $estado]);
    }
    
    // Ejecutar la consulta de solicitudes
    $solicitudes = $query->all();
    
    // Iterar sobre las solicitudes encontradas
    foreach ($solicitudes as $solicitud) {
        // Obtener los productos asociados a la solicitud
        $productos = ProductosSolicitud::find()->where(['status' => 1, 'solicitudid' => $solicitud->id])->all();
        
        // Iterar sobre los productos encontrados
        foreach ($productos as $producto) {
            // Buscar los tipos de producto específicos
            $tipo_producto = TipoProductoProductos::find()
                ->where(['status' => 1, 'productosid' => $producto->productosid, 'tipo_productoid' => $tipo_prod])
                ->all();
            
            // Calcular la cantidad total de productos del tipo especificado
            foreach ($tipo_producto as $tproducto) {
                $cant_prod += $tproducto->cant * $producto->cant;
            }
        }
    }
    
    // Retornar la cantidad total de productos del tipo especificado
    return $cant_prod;
}

}
