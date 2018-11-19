<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'middle_name', 'last_name'], 'required'],
            [['first_name', 'middle_name', 'last_name', 'phone', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'middle_name' => 'Отчество',
            'last_name' => 'Фамилия',
            'phone' => 'Телефон',
            'email' => 'Электронная почта',
        ];
    }

    public function checkUser($arrayUser)
    {
        $find = Users::findOne([
            'first_name' => $arrayUser['first_name'],
            'middle_name' => $arrayUser['middle_name'],
            'last_name' => $arrayUser['last_name'],
            'phone' => $arrayUser['phone'],
        ]);
        if($find) {
            return $find->id;
        } else {
            return false;
        }
    }

    public function getReceptionData($id) {
        $reception = Reception::findOne($id);
        $time = Time::findOne($reception->time_id);
        $receptionData = array(
            'date' => $reception->date,
            'time' => $time->time,
        );
        return $receptionData;
    }
}
