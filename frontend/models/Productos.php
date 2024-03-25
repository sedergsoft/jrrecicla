<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $id
 * @property string $producto
 * @property string|null $descripcion
 * @property string $um
 * @property float $precio
 * @property int $status
 *
 * @property ProductosSolicitud[] $productosSolicituds
 * @property TipoProductoProductos[] $tipoProductoProductos
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['producto', 'um', 'precio'], 'required'],
            [['precio'], 'number'],
            [['status'], 'integer'],
            [['producto'], 'string', 'max' => 255],
            [['descripcion'], 'string', 'max' => 1000],
            [['um'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'producto' => Yii::t('app', 'Producto'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'um' => Yii::t('app', 'Um'),
            'precio' => Yii::t('app', 'Precio'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[ProductosSolicituds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductosSolicituds()
    {
        return $this->hasMany(ProductosSolicitud::class, ['productosid' => 'id']);
    }

    /**
     * Gets query for [[TipoProductoProductos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoProductoProductos()
    {
        return $this->hasMany(TipoProductoProductos::class, ['productosid' => 'id']);
    }
}
