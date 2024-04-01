<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipo_producto".
 *
 * @property int $id
 * @property string $tipo
 * @property int|null $status
 *
 * @property TipoProductoProductos[] $tipoProductoProductos
 */
class TipoProducto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['status'], 'integer'],
            [['tipo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo' => Yii::t('app', 'Tipo de Producto'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[TipoProductoProductos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoProductoProductos()
    {
        return $this->hasMany(TipoProductoProductos::class, ['tipo_productoid' => 'id']);
    }
}
