<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "solicitud".
 *
 * @property int $id
 * @property string $fecha_solic
 * @property string $fecha_rec
 * @property string $fecha_aprob
 * @property string $fecha_ejec
 * @property string $status
 * @property int $clienteid
 * @property int $tipo_estado_solicitudid
 *
 * @property Cliente $cliente
 * @property ProductosSolicitud[] $productosSolicituds
 * @property TipoEstadoSolicitud $tipoEstadoSolicitud
 */
class Solicitud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'solicitud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'clienteid'], 'required'],
            [['fecha_rec', 'fecha_aprob', 'fecha_ejec','fecha_solic'], 'safe'],
            [['clienteid', 'tipo_estado_solicitudid'], 'integer'],
            [['status'], 'string', 'max' => 1],
           // [['tipo_estado_solicitudid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoEstadoSolicitud::class, 'targetAttribute' => ['tipo_estado_solicitudid' => 'id']],
            [['clienteid'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::class, 'targetAttribute' => ['clienteid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha_rec' => Yii::t('app', 'Fecha de Recepción'),
            'fecha_solic' => Yii::t('app', 'Fecha de Solicitada'),
            'fecha_aprob' => Yii::t('app', 'Fecha de Aprobación'),
            'fecha_ejec' => Yii::t('app', 'Fecha de Ejececución'),
            'status' => Yii::t('app', 'Status'),
            'clienteid' => Yii::t('app', 'Cliente'),
            'tipo_estado_solicitudid' => Yii::t('app', 'Estado de Solicitud'),
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::class, ['id' => 'clienteid']);
    }

    /**
     * Gets query for [[ProductosSolicituds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductosSolicituds()
    {
        return $this->hasMany(ProductosSolicitud::class, ['solicitudid' => 'id']);
    }

    /**
     * Gets query for [[TipoEstadoSolicitud]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoEstadoSolicitud()
    {
        return $this->hasOne(TipoEstadoSolicitud::class, ['id' => 'tipo_estado_solicitudid']);
    }
   
    public function getRecogida()
    {
        if($this->tipo_estado_solicitudid==3)
        {

            $recogida = Recogida::find()->andWhere(['status'=>1,'solicitudid'=>$this->id])->one();
            return $recogida;
        }else{
            return FALSE;
        }
    }
}
