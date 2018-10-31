<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reception".
 *
 * @property int $id
 * @property int $time_id
 * @property string $date
 * @property int $status_id
 * @property int $operator_id
 * @property int $user_id
 */
class Reception extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reception';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time_id', 'date', 'status_id', 'operator_id', 'user_id'], 'required'],
            [['time_id', 'status_id', 'operator_id', 'user_id'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time_id' => 'Time',
            'date' => 'Date',
            'status_id' => 'Status',
            'operator_id' => 'Operator',
            'user_id' => 'User',
        ];
    }
}
