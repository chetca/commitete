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
            'time_id' => 'Время',
            'date' => 'Дата',
            'status_id' => 'Статус',
            'operator_id' => 'Оператор',
            'user_last_name' => 'Фамилия',
            'user_first_name' => 'Имя',
            'user_middle_name' => 'Очество',
        ];
    }

    public function getOperator() {
        return $this->hasOne(Operators::className(), ['id' => 'operator_id']);
    }

    public function getStatus() {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    public function getTime() {
        return $this->hasOne(Time::className(), ['id' => 'time_id']);
    }

    public function getUser() {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}