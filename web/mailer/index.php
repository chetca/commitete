<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once('Users.php');
require_once('Reception.php');
require_once('Time.php');
//require_once('mailer.php');
$users = new Users();
$reception = new Reception();
$time = new Time();
//$date = date("Y-m-d", strtotime("tomorrow"));
$date = "2018-12-20";
$data_reception = $reception->selectReceptionUser($date);
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php foreach ($data_reception as $key): ?>
    <?php 
        $userData = $users->selectUser($key['user_id']);
        if($userData['email']) {
            $sendto = $userData['email'];
            $receptionNumber = $key['id'];
            $receptionDate = date("d.m.Y", strtotime($key['date']));
            $receptionTime = $time->selectTime($key['time_id']);
            $receptionOperator = $key['operator_id'];
            //$receptionUser = $userData['last_name'].' '.$userData['first_name'].' '.$userData['middle_name'];
            $receptionUser = $userData['last_name'].' '.$userData['first_name'];
            if($userData['middle_name']) {
                $receptionUser.=' '.$userData['middle_name'];
            }
            $receptionUserPhone = $userData['phone'];
            
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
            
            // отправка сообщения
            if($sendto != "") {
                mail($sendto, $subject, $msg, $headers);
                echo "Cообщение успешно отправленно. Пожалуйста, оставайтесь на связи<br>";
            }
            else {
                echo "Возникла ошибка при отправке формы. Попробуйте еще раз<br>";
            }
            echo $sendto.'<br>';
            echo $msg.'<br>';
        }
    ?>
<?php endforeach; ?>