<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "productos_solicitud".
 *
 * @property int $id
 * @property int $productosid
 * @property int $solicitudid
 * @property int $cant
 *
 * @property Productos $productos
 * @property Solicitud $solicitud
 */
class ProductosSolicitud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos_solicitud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['productosid', 'cant'], 'required'],
            [['productosid', 'solicitudid', 'cant'], 'integer'],
            [['productosid'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['productosid' => 'id']],
            [['solicitudid'], 'exist', 'skipOnError' => true, 'targetClass' => Solicitud::class, 'targetAttribute' => ['solicitudid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'productosid' => Yii::t('app', 'Productosid'),
            'solicitudid' => Yii::t('app', 'Solicitudid'),
            'cant' => Yii::t('app', 'Cant'),
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
     * Gets query for [[Solicitud]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitud()
    {
        return $this->hasOne(Solicitud::class, ['id' => 'solicitudid']);
    }
}
