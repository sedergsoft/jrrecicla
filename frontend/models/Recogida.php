<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "recogida".
 *
 * @property int $id
 * @property int $transportistaid
 * @property int $solicitudid
 * @property string $fecha_recogida
 * @property int $status
 *
 * @property Solicitud $solicitud
 * @property Transportista $transportista
 */
class Recogida extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recogida';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transportistaid', 'solicitudid', 'fecha_recogida'], 'required'],
            [['transportistaid', 'solicitudid', 'status'], 'integer'],
            [['fecha_recogida'], 'safe'],
            [['solicitudid'], 'exist', 'skipOnError' => true, 'targetClass' => Solicitud::class, 'targetAttribute' => ['solicitudid' => 'id']],
            [['transportistaid'], 'exist', 'skipOnError' => true, 'targetClass' => Transportista::class, 'targetAttribute' => ['transportistaid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'transportistaid' => Yii::t('app', 'Transportistaid'),
            'solicitudid' => Yii::t('app', 'Solicitudid'),
            'fecha_recogida' => Yii::t('app', 'Fecha Recogida'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[Solicitud]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitud()
    {
        return $this->hasOne(Solicitud::class, ['id' => 'solicitudid']);
    }

    /**
     * Gets query for [[Transportista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransportista()
    {
        return $this->hasOne(Transportista::class, ['id' => 'transportistaid']);
    }
}
