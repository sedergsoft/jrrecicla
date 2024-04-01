<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property string $instalacion
 * @property string $direccion
 * @property string $representante
 * @property string $email
 * @property string|null $telefono
 * @property int $status
 * @property int $cargosid
 * @property int $grupo_hoteleroid
 *
 * @property Cargos $cargos
 * @property GrupoHotelero $grupoHotelero
 * @property Solicitud[] $solicituds
 * @property User[] $users
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instalacion', 'direccion', 'representante', 'email', 'cargosid', 'grupo_hoteleroid'], 'required'],
            [['status', 'cargosid', 'grupo_hoteleroid'], 'integer'],
            [['instalacion', 'representante', 'email'], 'string', 'max' => 255],
            [['direccion'], 'string', 'max' => 1000],
            [['telefono'], 'string', 'max' => 25],
            [['grupo_hoteleroid'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoHotelero::class, 'targetAttribute' => ['grupo_hoteleroid' => 'id']],
            [['cargosid'], 'exist', 'skipOnError' => true, 'targetClass' => Cargos::class, 'targetAttribute' => ['cargosid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'instalacion' => Yii::t('app', 'Instalación'),
            'direccion' => Yii::t('app', 'Dirección'),
            'representante' => Yii::t('app', 'Representante'),
            'email' => Yii::t('app', 'Email'),
            'telefono' => Yii::t('app', 'Teléfono'),
            'status' => Yii::t('app', 'Status'),
            'cargosid' => Yii::t('app', 'Cargo'),
            'grupo_hoteleroid' => Yii::t('app', 'Grupo Hotelero'),
        ];
    }

    /**
     * Gets query for [[Cargos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargos()
    {
        return $this->hasOne(Cargos::class, ['id' => 'cargosid']);
    }

    /**
     * Gets query for [[GrupoHotelero]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoHotelero()
    {
        return $this->hasOne(GrupoHotelero::class, ['id' => 'grupo_hoteleroid']);
    }

    /**
     * Gets query for [[Solicituds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicituds()
    {
        return $this->hasMany(Solicitud::class, ['clienteid' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['empresaid' => 'id']);
    }
}
