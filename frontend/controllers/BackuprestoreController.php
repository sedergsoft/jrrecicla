<?php

namespace frontend\controllers;


use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\data\ArrayDataProvider;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\base\ErrorException;

class BackuprestoreController extends Controller {

    public $menu = [];
    public $tables = [];
    public $fp;
    public $file_name;
    public $_path = null;
    public $back_temp_file = 'reycikla_db_';
    //public $cant;


    public function actions()
    {
		//
    }

    protected function getPath() {
        if (isset($this->module->path))
            $this->_path = $this->module->path;
        else
            $this->_path = Yii::$app->basePath . '/_backup/';

        if (!file_exists($this->_path)) {
            mkdir($this->_path);
            chmod($this->_path, '777');
        }
        return $this->_path;
    }
   public function execSqlFilelimpiar($sqlFile) {
        $message = "ok";
        if (file_exists($sqlFile)) {
            $sqlArray = file_get_contents($sqlFile);

         
            $LastQuery = $sqlArray;
           // return print_r($LastQuery);
            $cmd1 = Yii::$app->db->createCommand($LastQuery);
            try {
                $cmd1->execute();
            } catch (CDbException $e) {
                $message = $e->getMessage();
            }
        }
        return $message;
    }
    public function execSqlFile($sqlFile) {
        $message = "ok";
        if (file_exists($sqlFile)) {
            $sqlArray = file_get_contents($sqlFile);

            $tables = $this->getTables();
            $query =  "";
            foreach ($tables as $tableName) {
                $query = $query."drop table if exists $tableName; ";
            }

            $LastQuery = "SET FOREIGN_KEY_CHECKS = 0; $query SET FOREIGN_KEY_CHECKS = 1;";

            $LastQuery = $LastQuery." ".$sqlArray;
            $cmd1 = Yii::$app->db->createCommand($LastQuery);
            try {
                $cmd1->execute();
            } catch (CDbException $e) {
                $message = $e->getMessage();
            }
        }
        return $message;
    }

    public function getColumns($tableName) {
        $sql = 'SHOW CREATE TABLE ' . $tableName;
        $cmd = Yii::$app->db->createCommand($sql);
        $table = $cmd->queryOne();

        $create_query = $table['Create Table'] . ';';

        $create_query = preg_replace('/^CREATE TABLE/', 'CREATE TABLE IF NOT EXISTS', $create_query);
        $create_query = preg_replace('/AUTO_INCREMENT\s*=\s*([0-9])+/', '', $create_query);
        if ($this->fp) {
            $this->writeComment('TABLE `' . addslashes($tableName) . '`');
            $final = 'DROP TABLE IF EXISTS `' . addslashes($tableName) . '`;' . PHP_EOL . $create_query . PHP_EOL . PHP_EOL;
            fwrite($this->fp, $final);
        } else {
            $this->tables[$tableName]['create'] = $create_query;
            return $create_query;
        }
    }

    public function getData($tableName) {
        $sql = 'SELECT * FROM ' . $tableName;
        $cmd = Yii::$app->db->createCommand($sql);
        $dataReader = $cmd->query();

        $data_string = '';

        foreach ($dataReader as $data) {
            $itemNames = array_keys($data);
            $itemNames = array_map("addslashes", $itemNames);
            $items = join('`,`', $itemNames);
            $itemValues = array_values($data);
            $itemValues = array_map("addslashes", $itemValues);
            $valueString = join("','", $itemValues);
            $valueString = "('" . $valueString . "'),";
            $values = "\n" . $valueString;
            if ($values != "") {
                $data_string .= "INSERT INTO `$tableName` (`$items`) VALUES" . rtrim($values, ",") . ";" . PHP_EOL;
            }
        }

        if ($data_string == '')
            return null;

        if ($this->fp) {
            $this->writeComment('TABLE DATA ' . $tableName);
            $final = $data_string . PHP_EOL . PHP_EOL . PHP_EOL;
            fwrite($this->fp, $final);
        } else {
            $this->tables[$tableName]['data'] = $data_string;
            return $data_string;
        }
    }

    public function getTables($dbName = null) {
        $sql = 'SHOW TABLES';
        $cmd = Yii::$app->db->createCommand($sql);
        $tables = $cmd->queryColumn();
        return $tables;
    }

    public function StartBackup($addcheck = true) {
        $this->file_name = $this->path . $this->back_temp_file . date('Y.m.d_H.i.s') . '.sql';

        $this->fp = fopen($this->file_name, 'w+');

        if ($this->fp == null)
            return false;
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
        if ($addcheck) {
            fwrite($this->fp, 'SET AUTOCOMMIT=0;' . PHP_EOL);
            fwrite($this->fp, 'START TRANSACTION;' . PHP_EOL);
            fwrite($this->fp, 'SET SQL_QUOTE_SHOW_CREATE = 1;' . PHP_EOL);
        }
        fwrite($this->fp, 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;' . PHP_EOL);
        fwrite($this->fp, 'SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;' . PHP_EOL);
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
        $this->writeComment('START BACKUP');
        return true;
    }

    public function EndBackup($addcheck = true) {
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
        fwrite($this->fp, 'SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;' . PHP_EOL);
        fwrite($this->fp, 'SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;' . PHP_EOL);

        if ($addcheck) {
            fwrite($this->fp, 'COMMIT;' . PHP_EOL);
        }
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
        $this->writeComment('END BACKUP');
        fclose($this->fp);
        $this->fp = null;
    }
 public function EndBackupdatos($addcheck = true) {
       // fwrite($this->fp, "INSERT INTO `elemento` (`id`,`nombre`,`especializacionid`,`grupoid`,`evaluado`,`status`,`normaid`) VALUES ('8','sin elemenyo','6','3','1','0','9');" . PHP_EOL);
        // fwrite($this->fp, "UPDATE `elemento` SET `evaluado` = '0'; " . PHP_EOL);
        // fwrite($this->fp, "UPDATE `subnorma` SET `evaluado` = '0'; " . PHP_EOL);
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
        fwrite($this->fp, 'SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;' . PHP_EOL);
        fwrite($this->fp, 'SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;' . PHP_EOL);

        if ($addcheck) {
            fwrite($this->fp, 'COMMIT;' . PHP_EOL);
        }
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
        $this->writeComment('END BACKUP');
        fclose($this->fp);
        $this->fp = null;
    }
    public function writeComment($string) {
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
        fwrite($this->fp, '-- ' . $string . PHP_EOL);
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
    }

    public function actionCreate() {
          if(Yii::$app->user->isGuest)
     {
         return $this->redirect(['site/login']);   
     }
     
      if(\yii::$app->user->can('crear_salva_bd'))
     {
        $flashError = '';
        $flashMsg = '';
        

        $tables = $this->getTables();

        if (!$this->StartBackup()) {
            //render error
            $flashError = 'error';
            $flashMsg = 'Error: File create';
            return $this->render('index');
        }

        foreach ($tables as $tableName) {
            if($tableName != 'user' || $tableName != 'rol'|| $tableName != 'notifications'  )
            {
            $this->getColumns($tableName);
            }
        }
        foreach ($tables as $tableName) {
              if($tableName != 'user' || $tableName != 'rol'|| $tableName != 'notifications')
            {
            $this->getData($tableName);
            }
        }
        $this->EndBackup();

        $flashError = 'success';
        $flashMsg = 'La copia de seguridad de su Base de Datos ha sido generada satisfactoriamente';

        \Yii::$app->getSession()->setFlash($flashError, $flashMsg);
        
        $this->redirect(array('index'));
     }
     else{
         throw new \yii\web\ForbiddenHttpException(Yii::t('app', 'No tiene los permisos necesarios para realizar esta acción.'));
     }
    }

    public function actionClean($redirect = true) 
    {
                if(Yii::$app->user->isGuest)
      {
        return $this->redirect(['site/login']);   
     }
       if (Yii::$app->user->identity->rolid==4)
     {
         
        $tables = $this->getTables();

        if (!$this->StartBackup()) {
            //render error
            Yii::$app->user->setFlash('success', "Error");
            return $this->render('index');
        }

        $message = '';
    $ignore = array('user','auth_rule','trabajador','auth_item_child','auth_item','auth_assignment', 'rol', 'tipo_pie', 'tipo_elemento','evaluacion','entidad');
       
        foreach ($tables as $tableName) {
            
            if (in_array($tableName, $ignore))
                continue;
            fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
            fwrite($this->fp, 'TRUNCATE ' . addslashes($tableName) . ';' . PHP_EOL);
            fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);

            $message .= $tableName . ',';
        }
        $this->EndBackup();
        

        // logout so there is no problme later .
        Yii::$app->user->logout();

        $this->execSqlFile($this->file_name);
        //return print_r($this->file_name);
        unlink($this->file_name);
        $message .= ' are cleaned.';
        Yii::$app->session->setFlash('success', $message);
        return $this->redirect(array('index'));
    }
    
     else{
         throw new \yii\web\ForbiddenHttpException(Yii::t('app', 'No tiene los permisos necesarios para realizar esta acción.'));
     }
    }
 public function actionLimpiar($redirect = true) 
    {
           if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }
     
      if(\yii::$app->user->can('limpiar_datos'))
     {
        $tables = $this->getTables();

        if (!$this->StartBackup()) {
            //render error
            Yii::$app->user->setFlash('success', "Error");
            return $this->render('index');
        }

        $message = '';
    $ignore = array('user','auth_rule','trabajador','auth_item_child','auth_item','auth_assignment', 'rol', 'tipo_pie', 'tipo_elemento','evaluacion','entidad');
       
        foreach ($tables as $tableName) {
            
            if (in_array($tableName, $ignore))
                continue;
            fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
            fwrite($this->fp, 'TRUNCATE ' . addslashes($tableName) . ';' . PHP_EOL);
            fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);

            $message .= $tableName . ',';
        }
        fwrite($this->fp, "INSERT INTO `norma` (`id`, `nombre`, `Componentesid`, `status`) VALUES ('9', 'sin norma', '1', '0');" . PHP_EOL);
         fwrite($this->fp, "INSERT INTO `elemento` (`id`,`nombre`,`especializacionid`,`grupoid`,`evaluado`,`status`,`normaid`) VALUES ('8','sin elemenyo','6','8','1','0','9');" . PHP_EOL);
        fwrite($this->fp, " INSERT INTO `grupo` (`id`,`tipo`,`status`) VALUES ('8','General','0');" . PHP_EOL);
        fwrite($this->fp, "INSERT INTO `subnorma` (`id`, `nombre`, `normaid`, `grupoid`, `evaluado`, `status`) VALUES ('15', 'sin subnorma', '9', '1', '8', '0');" . PHP_EOL);
          
        $this->EndBackup();
        

        // logout so there is no problme later .
       // Yii::$app->user->logout();

        $this->execSqlFilelimpiar($this->file_name);
        //return print_r($this->file_name);
        unlink($this->file_name);
        $message = ' La base de Datos fue vaciada correctamente.';
        Yii::$app->session->setFlash('danger', $message);
        return $this->redirect(array('index'));
         }
     else{
         throw new \yii\web\ForbiddenHttpException(Yii::t('app', 'No tiene los permisos necesarios para realizar esta acción.'));
     }
    }
 public function actionLimpiardatos($redirect = true) 
    {
           if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }
     
      if(\yii::$app->user->can('borrar_datos'))
     {
        $tables = $this->getTables();

        if (!$this->StartBackup()) {
            //render error
            Yii::$app->user->setFlash('success', "Error");
            return $this->render('index');
        }

        $message = '';
    $ignore = array('user','auth_rule','trabajador','auth_item_child','auth_item','auth_assignment','componentes','elemento','entidad','especializacion','grupo','norma','subnorma', 'rol', 'tipo_pie', 'tipo_elemento', 'tipo_elemento_config','evaluacion','area');
       
        foreach ($tables as $tableName) {
            
            if (in_array($tableName, $ignore))
                continue;
            fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
            fwrite($this->fp, 'TRUNCATE ' . addslashes($tableName) . ';' . PHP_EOL);
            fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);

            $message .= $tableName . ',';
        }
        $this->EndBackupdatos();
        

        // logout so there is no problme later .
       // Yii::$app->user->logout();

       // return print_r($this->file_name);
        $this->execSqlFilelimpiar($this->file_name);
        unlink($this->file_name);
        $message = ' Las Datos han sido borrados correctamente.';
        Yii::$app->session->setFlash('danger', $message);
        return $this->redirect(array('index'));
         }
     else{
         throw new \yii\web\ForbiddenHttpException(Yii::t('app', 'No tiene los permisos necesarios para realizar esta acción.'));
     }
    }

    public function actionDelete($filename = null) {
           if(Yii::$app->user->isGuest)
     {
         return $this->redirect(['site/login']);   
     }
     if(\yii::$app->user->can('eliminar_salva_bd'))
     {
             
        $flashError = '';
        $flashMsg = '';
        $cant = \Yii::$app->session['cant'];//recupero la variable $cant que contiene la cantidad de salvas de BD que exiten en la carpeta

		$file = $filename;
        if($cant > 1){	//si $cant es mayor que 1 elimino la salva si no muestro error
        $this->updateMenuItems();
        if (isset($file)) {
            $sqlFile = $this->path . basename($file);
            if (file_exists($sqlFile)) {
                unlink($sqlFile);
                $flashError = 'success';
                $flashMsg = 'Su copia de seguridad a sido eliminada satisfactoriamente ';
            } else {
                $flashError = 'error';
                $flashMsg = ' Base de datos no encontrada .';
            }
        } else {
            $flashError = 'error';
            $flashMsg = 'Archivo no encontrado.';
        }
        }else{
            $flashError = 'error';
            $flashMsg = 'Imposible eliminar .Debe tener al menos una salva de la Base de datos.';
            
            
        }
         \Yii::$app->getSession()->setFlash($flashError, $flashMsg);
        $this->redirect(array('index'));
         }
     else{
        throw new \yii\web\ForbiddenHttpException(Yii::t('app', 'No tiene los permisos necesarios para realizar esta acción.'));
   
     }
        
        
        }

    public function actionDownload($file = null) {
                if(Yii::$app->user->isGuest)
     {
        return $this->redirect(['site/login']);   
     }
        $this->updateMenuItems();
        if (isset($file)) {
            $sqlFile = $this->path . basename($file);
            if (file_exists($sqlFile)) {
                $request = Yii::$app->getRequest();
                $request->sendFile(basename($sqlFile), file_get_contents($sqlFile));
            }
        }
        throw new CHttpException(404, Yii::t('app', 'File not found'));
    }

    public function actionIndex() {
           if(Yii::$app->user->isGuest)
     {
         return $this->redirect(['site/login']);   
     }
   if(\yii::$app->user->can('ver_bd'))
     {
	$cant = 0;//variable que almacena la cantidad de salvas 	
        $this->updateMenuItems();
        $path = $this->path;
        $dataArray = array();

        $list_files = glob($path . '*.sql');
        
        if ($list_files) {
            $list = array_map('basename', $list_files);
            sort($list);
           
            foreach ($list as $id => $filename) {
                $columns = array();
                $columns['id'] = $id;
                $columns['name'] = basename($filename);
                $columns['size'] = filesize($path . $filename);

                $columns['create_time'] = date('Y-m-d H:i:s', filectime($path . $filename));
                $columns['modified_time'] = date('Y-m-d H:i:s', filemtime($path . $filename));
                $cant ++; //cuenta la cantidad de salvas que existen en la ubicacion donde se almacenan
                $dataArray[] = $columns;
            }
        }
       
        \Yii::$app->session['cant'] = $cant;//guarda la cantidad de salvas en una variable de sesion para luego recuperarlas.
       
        
        $dataProvider = new ArrayDataProvider(['allModels' => $dataArray]);
        return $this->render('index', array(
                    'dataProvider' => $dataProvider,
        ));
     }else
      {
          throw new \yii\web\ForbiddenHttpException('No tiene permisos para acceder a esta parte del sitio.');
      }
    }

    public function actionSyncdown() {
        $tables = $this->getTables();

        if (!$this->StartBackup()) {
            //render error
            return $this->render('index');
        }

        foreach ($tables as $tableName) {
            $this->getColumns($tableName);
        }
        foreach ($tables as $tableName) {
            $this->getData($tableName);
        }
        $this->EndBackup();
        return $this->actionDownload(basename($this->file_name));
    }

    public function actionRestore($filename=NULL) 
      {
                if(Yii::$app->user->isGuest)
     {
         return $this->redirect(['site/login']);   
     }
     if(\yii::$app->user->can('restaurar_bd'))
     {
         
        $flashError = '';
        $flashMsg = '';
		
		$file = $filename;
		
        $this->updateMenuItems();
        $sqlFile = $this->path . basename($file);

	
        if (isset($file)) {
            $sqlFile = $this->path . basename($file);

            $flashError = 'success';
            $flashMsg = 'Exito: La Base de Datos ha sido restaurada exitosamente!';
        } else {
            $flashError = 'error';
            $flashMsg = 'Error: Nombre Incorrecto !';
        }
        $this->execSqlFile($sqlFile);

        \Yii::$app->getSession()->setFlash($flashError, $flashMsg);
        $this->redirect(array('index'));
    
        }
     else{
          throw new \yii\web\ForbiddenHttpException('No tiene permisos para acceder a esta parte del sitio.');
    
     }
        
        }

    public function actionUpload() {
                if(Yii::$app->user->isGuest)
     {
         return $this->redirect(['site/login']);   
     }

        $model = new UploadForm();
        if (isset($_POST['UploadForm'])) {
            $model->attributes = $_POST['UploadForm'];
            //oe change cUploaded for this
            $model->upload_file = UploadedFile::getInstance($model, 'upload_file');
            if ($model->upload_file->saveAs($this->path . $model->upload_file)) {
                // redirect to success page
                return $this->redirect(array('index'));
            }
        }

        return $this->render('upload', array('model' => $model));
    }

    protected function updateMenuItems($model = null) {
        // create static model if model is null
        if ($model == null)
            $model = new UploadForm();

        switch ($this->action->id) {
            case 'restore': {
                    $this->menu[] = array('label' => Yii::t('app', 'View Site'), 'url' => Yii::$app->HomeUrl);
                }
            case 'create': {
                    $this->menu[] = array('label' => Yii::t('app', 'List Backup'), 'url' => array('index'));
                }
                break;
            case 'upload': {
                    $this->menu[] = array('label' => Yii::t('app', 'Create Backup'), 'url' => array('create'));
                }
                break;
            default: {
                    $this->menu[] = array('label' => Yii::t('app', 'List Backup'), 'url' => array('index'));
                    $this->menu[] = array('label' => Yii::t('app', 'Create Backup'), 'url' => array('create'));
                    $this->menu[] = array('label' => Yii::t('app', 'Upload Backup'), 'url' => array('upload'));
                    $this->menu[] = array('label' => Yii::t('app', 'Restore Backup'), 'url' => array('restore'));
                    $this->menu[] = array('label' => Yii::t('app', 'Clean Database'), 'url' => array('clean'));
                    $this->menu[] = array('label' => Yii::t('app', 'View Site'), 'url' => Yii::$app->HomeUrl);
                }
                break;
        }
    }

}
