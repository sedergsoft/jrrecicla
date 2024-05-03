<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $id
 * @property int $user_id
 * @property string $message
 * @property string $created_at
 * @property int|null $read_status
 * @property string|null $read_at
 * @property int|null $status
 */
class Notifications extends \yii\db\ActiveRecord
{
    // public function __construct($user_id, $message, $read_status = 0, $read_at = 0, $status = 1, $config = [])
    // {
    //     parent::__construct($config);
    //     $this->user_id = $user_id;
    //     $this->message = $message;
    //     $this->created_at = date();
    //     $this->read_status = $read_status;
    //     $this->read_at = $read_at;
    //     $this->status = $status;
    //     $this->save();
    // }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'message'], 'required'],
            [['user_id', 'read_status', 'status'], 'integer'],
            [['created_at', 'read_at'], 'safe'],
            [['message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'message' => Yii::t('app', 'Message'),
            'created_at' => Yii::t('app', 'Created At'),
            'read_status' => Yii::t('app', 'Read Status'),
            'read_at' => Yii::t('app', 'Read At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

}
