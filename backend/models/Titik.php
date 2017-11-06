<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "titik".
 *
 * @property string $titik_id
 * @property string $area_id
 * @property string $titik_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Area $area
 */
class Titik extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'titik';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titik_id', 'area_id'], 'required'],
            [['created_at', 'updated_at','hor_id'], 'safe'],
            [['titik_id', 'area_id'], 'string', 'max' => 4],
            [['titik_name'], 'string', 'max' => 70],
            [['titik_id'], 'unique'],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['area_id' => 'area_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'titik_id' => 'Titik ID',
            'hor_id' => 'HOR ID',
            'area_id' => 'Area ID',
            'titik_name' => 'Titik Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Area::className(), ['area_id' => 'area_id']);
    }
    public function getHor()
    {
        return $this->hasOne(Area::className(), ['hor_id' => 'hor_id']);
    }
}
