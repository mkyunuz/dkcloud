<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "titik_assignment".
 *
 * @property string $nik
 * @property string $titik_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $nik0
 * @property Titik $titik
 */
class TitikAssignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'titik_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nik', 'titik_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['nik'], 'string', 'max' => 9],
            [['titik_id'], 'string', 'max' => 6],
            [['nik'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['nik' => 'nik']],
            [['titik_id'], 'exist', 'skipOnError' => true, 'targetClass' => Titik::className(), 'targetAttribute' => ['titik_id' => 'titik_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nik' => 'Nik',
            'titik_id' => 'Titik ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNik0()
    {
        return $this->hasOne(User::className(), ['nik' => 'nik']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitik()
    {
        return $this->hasOne(Titik::className(), ['titik_id' => 'titik_id']);
    }
}
