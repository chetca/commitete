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
 * @property int $operatorPlan
 * @property string $record
 */
class Reception extends \yii\db\ActiveRecord
{
    public $reception_id;
    public $datePlan;
    public $operatorPlan;
    public $userNameReal;

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
            [['reception_id', 'time_id', 'status_id', 'operator_id', 'user_id', 'operatorPlan'], 'integer'],
            [['date', 'record', 'userNameReal', 'created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reception_id' => 'Номер записи',
            'time_id' => 'Время',
            'date' => 'Дата',
            'status_id' => 'Статус',
            'operator_id' => 'Оператор',
            'user_id' => 'Посетитель',
            'record' => 'Дата записи',
            'datePlan' => 'Планируемая дата',
            'operatorPlan' => 'Количество операторов',
            'timeReal' => 'Время',
            'userNameReal' => 'ФИО',
            'userPhone' => 'Телефон',
            'userEmail' => 'Электронная почта',
            'created' => 'Дата создания записи',
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

    public function getStatusName() {
        $status = $this->status;
        return $status ? $status->status : '';
    }

    public function getOperatorName() {
        $operator = $this->operator;
        return $operator ? $operator->operator : '';
    }

    public function getFullName() {
        return $this->user->last_name .' '. $this->user->first_name .' '. $this->user->middle_name;
    }

    public function getBusyDate() {
        $busyDate = (new \yii\db\Query())
            ->select('date')
            ->from('reception')
            ->distinct()
            ->all();
        return $busyDate;
    }

    public function saveTime($operatorPlan, $dataPlan, $countTime)
    {
        $currentDate = date('Y-m-d');
        $busyDate = Reception::getBusyDate();
        foreach ($busyDate as $key) {
            if($key['date'] == $dataPlan) {
                return false;
            }
        }
        if($dataPlan <= $currentDate) {
            return false;
        }
        $now = strtotime(date("d.m.Y H:i:s", time()));
        $data = array();
        for($i = 1; $i <= $operatorPlan; $i++) {
            for($j = 1; $j <= $countTime; $j++) {
                array_push($data, [$j, $dataPlan, 1, $i, 0, $now]);
            }
        }
        Yii::$app->db
        ->createCommand()
        ->batchInsert('reception', ['time_id', 'date', 'status_id', 'operator_id', 'user_id', 'created'], $data)
        ->execute();
        return true;
    }

    public function removeTime($operatorPlan, $datePlan) 
    {
        if($operatorPlan >= 1) {
            Reception::deleteAll(['date' => $datePlan, 'operator_id' => $operatorPlan]);
        } else {
            Reception::deleteAll(['date' => $datePlan]);
        }        
        return true;
    }

    public function addUser($receptionId, $userId) 
    {
        $now = strtotime(date("d.m.Y H:i:s", time()));
        $nowReception = Reception::findOne($receptionId);
        if($nowReception->status_id == 2) {
            return false;
        }
        Reception::updateAll([
            'status_id' => 2, 
            'user_id' => $userId, 
            'record' => $now
        ],['id' => $receptionId]);
        return true;
    }

    public function deleteUser($receptionId) 
    {
        $userIdDel = Reception::findOne($receptionId);
        $userWhoWillDie = Users::findOne($userIdDel->user_id);
        Reception::updateAll([
            'status_id' => 1, 
            'user_id' => '', 
            'record' => null
        ],['id' => $receptionId]);
        $isReception = Reception::findOne(['user_id' => $userWhoWillDie->id]);
        if(!$isReception) {
            $userWhoWillDie->delete(); //bye
        }        
        return true;
    }

    public function sendMail($receptionId, $arrayUser) {
        $receptionData = Reception::findOne($receptionId);
        $sendto = $arrayUser['email'];

        $receptionNumber = $receptionId;
        $receptionDate = date("d.m.Y", strtotime($receptionData['date']));
        $receptionTime = Time::findOne($receptionData['time'])['time'];
        $receptionOperator = $receptionData['operator_id'];
        $receptionUser = $arrayUser['last_name'].' '.$arrayUser['first_name'];
        if($arrayUser['middle_name']) {
            $receptionUser.=' '.$arrayUser['middle_name'];
        }
        $receptionUserPhone = $arrayUser['phone'];
        
        $subject  = "Запись в дошкольный отдел Комитета по образованию";
        $headers  = "From: " . strip_tags('sendmail@ulan-ude-eg.ru') . "\r\n";
        $headers .= "Reply-To: ". strip_tags($sendto) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
        
        $msg  = "<html><body style='font-family:Arial,sans-serif;'>";
        $msg .= "<p style='border-bottom:1px dotted #ccc;'>ЗАПИСЬ В ДОШКОЛЬНЫЙ ОТДЕЛ КОМИТЕТА ПО ОБРАЗОВАНИЮ</p>\r\n";
        $msg .= "<p>Уважаемый ".$receptionUser.", ".$receptionDate." в ".$receptionTime." Вы записаны на приём в дошкольный отдел Комитета по образованию:</p>\r\n";
        $msg .= "<p>Номер записи: ".$receptionNumber."</p>\r\n";
        $msg .= "<p>Дата: ".$receptionDate."</p>\r\n";
        $msg .= "<p>Время: ".$receptionTime."</p>\r\n";
        $msg .= "<p>На приём при себе иметь следующие документы:</p>\r\n";
		$msg .= "<p>- свидетельство о рождении;</p>\r\n";
		$msg .= "<p>- паспорт родителя (законного представителя) ребёнка;</p>\r\n";
		$msg .= "<p>- свидетельство о регистрации ребёнка по месту жительства в г. Улан-Удэ;</p>\r\n";
		$msg .= "<p>- документ, подтверждающий льготную категорию (при наличии).</p><br>\r\n";
        $msg .= "<p>Данное письмо сгенерировано автоматически, отвечать на него не нужно.</p>\r\n";
        $msg .= "</body></html>";
        
        mail($sendto, $subject, $msg, $headers);
    }

    public function getNextDate() {
        $currentDate = date('Y-m-d');
        $busyDate = Reception::getBusyDate();
        foreach ($busyDate as $day) {
            if($day['date'] > $currentDate) {
                return $day['date'];
            }
        }
        return $currentDate;
    }
}
