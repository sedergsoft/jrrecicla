<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cargos".
 *
 * @property int $id
 * @property string $cargo
 * @property int|null $status
 *
 * @property Cliente[] $clientes
 */
class Cargos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cargos';
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
            [['cargo'], 'required'],
            [['status'], 'integer'],
            [['cargo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cargo' => Yii::t('app', 'Cargo'),
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
        return $this->hasMany(Cliente::class, ['cargosid' => 'id']);
    }
}
