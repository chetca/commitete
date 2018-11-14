

<?php 
function send() {
	$sendto = $userData['email'];
	$receptionNumber = $key['id'];
	$receptionDate = $key['date'];
	$receptionTime = $time->selectTime($key['time_id']);
	$receptionOperator = $key['operator'];
	$receptionUser = $userData['last_name'].' '.$userData['first_name'].' '.$userData['middle_name'];
	$receptionUserPhone = $userData['phone'];
	
	// Формирование заголовка письма
	$subject  = "Новое сообщение";
	$headers  = "From: " . strip_tags($usermail) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($usermail) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html;charset=utf-8 \r\n";
	
	// Формирование тела письма
	$msg  = "<html><body style='font-family:Arial,sans-serif;'>";
	$msg .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>Запись в дошкольный отдел Комитета по образованию</h2>\r\n";
	$msg .= "<p>Напоминаем, что завтра, ".$receptionDate." в ".$receptionTime." у Вас назначен приём в дошкольный отдел Комитета по образованию</p>\r\n";
	$msg .= "<p><strong>Номер записи: </strong> ".$receptionNumber."</p>\r\n";
	$msg .= "<p><strong>Дата: </strong> ".$receptionNumber."</p>\r\n";
	$msg .= "<p><strong>Время: </strong> ".$receptionNumber."</p>\r\n";
	$msg .= "<p><strong>Оператор: </strong> ".$receptionOperator."</p>\r\n";
	$msg .= "<p><strong>Посетитель: </strong> ".$receptionNumber."</p>\r\n";
	$msg .= "<p><strong>Телефон: </strong> ".$receptionNumber."</p>\r\n";
	$msg .= "</body></html>";
	
	// отправка сообщения
	if($username != "" && $usercomp != "" && $usertel != "" && $usermail != "") {
		@mail($sendto, $subject, $msg, $headers);
		echo "Cообщение успешно отправленно. Пожалуйста, оставайтесь на связи";
	}
	else {
		echo "Возникла ошибка при отправке формы. Попробуйте еще раз";
	}
} 
?>