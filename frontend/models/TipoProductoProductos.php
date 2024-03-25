<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipo_producto_productos".
 *
 * @property int $id
 * @property int $tipo_productoid
 * @property int $productosid
 * @property int $status
 *
 * @property Productos $productos
 * @property TipoProducto $tipoProducto
 */
class TipoProductoProductos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_producto_productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_productoid', 'productosid'], 'required'],
            [['tipo_productoid', 'productosid', 'status'], 'integer'],
            [['tipo_productoid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoProducto::class, 'targetAttribute' => ['tipo_productoid' => 'id']],
            [['productosid'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['productosid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_productoid' => Yii::t('app', 'Tipo Productoid'),
            'productosid' => Yii::t('app', 'Productosid'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[Productos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasOne(Productos::class, ['id' => 'productosid']);
    }

    /**
     * Gets query for [[TipoProducto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoProducto()
    {
        return $this->hasOne(TipoProducto::class, ['id' => 'tipo_productoid']);
    }
}
