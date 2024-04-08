<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $rolid
 * @property int|null $empresaid
 * @property string|null $municipio
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $last_login
 *
 * @property AuditEntry[] $auditEntries
 * @property AuditTrail[] $auditTrails
 * @property AuthAssignment[] $authAssignments
 * @property Cliente $empresa
 * @property Rol $rol
 */
class User extends \yii\db\ActiveRecord
{
    public $password_repeat;
    const SCENARIO_EDIT = 'Cedit';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash','password_repeat', 'email', 'rolid'], 'required'],
            [['username', 'rolid','email','status'], 'required','on'=> self::SCENARIO_EDIT],
            [['status', 'rolid', 'empresaid', 'created_at', 'updated_at', 'last_login'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['municipio'], 'string', 'max' => 500],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['empresaid'], 'integer'],
            ['email', 'email'],
            [['password_reset_token'], 'unique'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password_hash', 'message' => 'Las contraseñas introducidas no coinciden'],
            [['rolid'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::class, 'targetAttribute' => ['rolid' => 'id']],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::class, 'targetAttribute' => ['empresaid' => 'id']],
        ];
    }
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_EDIT] = ['username', 'rolid','email','status','empresaid'];
      //  $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Usuario'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password'),
            'password_reset_token' => Yii::t('app', 'Repetir Password '),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Estado'),
            'rolid' => Yii::t('app', 'Tipo de Usuario'),
            'empresaid' => Yii::t('app', 'Cliente'),
            'municipio' => Yii::t('app', 'Municipio'),
            'created_at' => Yii::t('app', 'Creado'),
            'updated_at' => Yii::t('app', 'Actualizado'),
            'last_login' => Yii::t('app', 'Ultimo Acceso'),
        ];
    }

    /**
     * Gets query for [[AuditEntries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuditEntries()
    {
        return $this->hasMany(AuditEntry::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[AuditTrails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuditTrails()
    {
        return $this->hasMany(AuditTrail::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[AuthAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Empresa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Cliente::class, ['id' => 'empresaid']);
    }

    /**
     * Gets query for [[Rol]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::class, ['id' => 'rolid']);
    }
}
