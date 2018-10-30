<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reception".
 *
 * @property int $id
 * @property int $time_id
 * @property string $date
 * @property int $status
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
            [['time_id', 'date', 'status', 'operator_id', 'user_id'], 'required'],
            [['time_id', 'status', 'operator_id', 'user_id'], 'integer'],
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
            'time_id' => 'Time ID',
            'date' => 'Date',
            'status' => 'Status',
            'operator_id' => 'Operator ID',
            'user_id' => 'User ID',
        ];
    }
}
