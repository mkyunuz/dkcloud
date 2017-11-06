<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $nik
 * @property string $jabatan_id
 * @property string $nama
 * @property string $tanggal_masuk
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $level
 * @property integer $status
 * @property string $photo
 * @property integer $no_telp
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Jabatan $jabatan
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nik', 'jabatan_id', 'nama', 'tanggal_masuk', 'auth_key', 'password_hash', 'email', 'level'], 'required'],
            [['tanggal_masuk', 'created_at', 'updated_at'], 'safe'],
            [['level', 'photo'], 'string'],
            [['status', 'no_telp'], 'integer'],
            [['nik'], 'string', 'max' => 9],
            [['jabatan_id'], 'string', 'max' => 4],
            [['nama'], 'string', 'max' => 70],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['nik'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['jabatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jabatan::className(), 'targetAttribute' => ['jabatan_id' => 'jabatan_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nik' => 'Nik',
            'jabatan_id' => 'Jabatan ID',
            'nama' => 'Nama',
            'tanggal_masuk' => 'Tanggal Masuk',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'level' => 'Level',
            'status' => 'Status',
            'photo' => 'Photo',
            'no_telp' => 'No Telp',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJabatan()
    {
        return $this->hasOne(Jabatan::className(), ['jabatan_id' => 'jabatan_id']);
    }
}
