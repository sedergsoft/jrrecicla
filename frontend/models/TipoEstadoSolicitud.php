<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipo_estado_solicitud".
 *
 * @property int $id
 * @property string $estado
 * @property int $status
 *
 * @property Solicitud[] $solicituds
 */
class TipoEstadoSolicitud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_estado_solicitud';
    }
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'required'],
            [['status'], 'integer'],
            [['estado'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'estado' => Yii::t('app', 'Estado de Solicitud'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[Solicituds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicituds()
    {
        return $this->hasMany(Solicitud::class, ['tipo_estado_solicitudid' => 'id']);
    }
}
