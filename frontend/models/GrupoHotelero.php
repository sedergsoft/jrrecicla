<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "grupo_hotelero".
 *
 * @property int $id
 * @property string $grupo
 * @property int $status
 *
 * @property Cliente[] $clientes
 */
class GrupoHotelero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grupo_hotelero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['grupo'], 'required'],
            [['status'], 'integer'],
            [['grupo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'grupo' => Yii::t('app', 'Grupo'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[Clientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::class, ['grupo_hoteleroid' => 'id']);
    }
}
