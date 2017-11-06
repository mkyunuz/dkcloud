<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property string $area_id
 * @property string $hor_id
 * @property string $area_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Hor $hor
 * @property Titik[] $titiks
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_id','hor_id','area_name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['area_id'], 'string', 'max' => 4],
            ['area_id','unique'],
            [['hor_id'], 'string', 'max' => 3],
            [['area_name'], 'string', 'max' => 70],
            [['hor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hor::className(), 'targetAttribute' => ['hor_id' => 'hor_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'area_id' => 'Area ID',
            'hor_id' => 'Hor Name',
            'area_name' => 'Area Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHor()
    {
        return $this->hasOne(Hor::className(), ['hor_id' => 'hor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitiks()
    {
        return $this->hasMany(Titik::className(), ['area_id' => 'area_id']);
    }
}
