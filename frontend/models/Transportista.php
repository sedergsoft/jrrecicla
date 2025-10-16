<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "transportista".
 *
 * @property int $id
 * @property string $vehiculo
 * @property string $chofer
 * @property string $email
 * @property string $telefono
 * @property int $status
 *
 * @property Recogida[] $recogidas
 */
class Transportista extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transportista';
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
            [['vehiculo', 'chofer','email'], 'required'],
            [['status'], 'integer'],
            [['vehiculo'], 'string', 'max' => 255],
            [['chofer','telefono'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'vehiculo' => Yii::t('app', 'Vehiculo'),
            'chofer' => Yii::t('app', 'Chofer'),
            'email' => Yii::t('app', 'Correo electronico'),
            'telefono' => Yii::t('app', 'Teléfono'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[Recogidas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecogidas()
    {
        return $this->hasMany(Recogida::class, ['transportistaid' => 'id']);
    }
}
