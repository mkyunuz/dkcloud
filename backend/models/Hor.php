<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hor".
 *
 * @property string $hor_id
 * @property string $hor_name
 *
 * @property Area[] $areas
 */
class Hor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hor_id', 'hor_name'], 'required'],
            [['hor_id'], 'string', 'max' => 3],
            [['hor_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hor_id' => 'Hor ID',
            'hor_name' => 'Hor Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreas()
    {
        return $this->hasMany(Area::className(), ['hor_id' => 'hor_id']);
    }
}
