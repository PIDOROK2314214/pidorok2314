<?php
$msg_box = ""; // в этой переменной будем хранить сообщения формы
$errors = array(); // контейнер для ошибок
// проверяем корректность полей
if($_POST['form_email'] == "")   $errors[] = "Поле <span style='color: #666;'>Ваш номер</span> не заполнено";
if($_POST['form_name'] == "")    $errors[] = "Поле <span style='color: #666;'>Ваше имя</span> не заполнено";
if($_POST['form_message'] == "") $errors[] = "Поле <span style='color: #666;'>Текст сообщения</span> не заполнено";
if($_POST['form_date'] == "") $errors[] = "Поле <span style='color: #666;'>Дата</span> не заполнено";

// если форма без ошибок
if(empty($errors)){
// собираем данные из формы
$message .= "Имя клиента: " . $_POST['form_name'] . "<br/>";
$message .= "Номер телефона: " . $_POST['form_email'] . "<br/>";
$message .= "Дата мероприятия: " . $_POST['form_date'] . "<br/><br/>";
$message .= "Сообщение: " . $_POST['form_message'];
send_mail($message); // отправим письмо
// выведем сообщение об успехе
$msg_box = "<span style='color: green;font-size: 1.4em;'>Спасибо за обращение, сообщение успешно отправлено! <br/> В течении 2 часов я Вам отвечу!<br/></span><br/>";
}else{
// если были ошибки, то выводим их
$msg_box = "";
foreach($errors as $one_error){
$msg_box .= "<style>.messages{margin-bottom: 20px;}</style><span style='color: red;font-size: 1.2em;'>$one_error</span><br/>";
}
}

// делаем ответ на клиентскую часть в формате JSON
echo json_encode(array(
'result' => $msg_box
));


// функция отправки письма
function send_mail($message){
// почта, на которую придет письмо
$mail_to = "pavlo8chorniy@gmail.com";
// тема письма
$subject = "Заявка с сайта";

// заголовок письма
$headers= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
$headers .= "From: riabtsev.top <administration@riabtsev.top>\r\n"; // от кого письмо
    
    // отправляем письмо
    mail($mail_to, $subject, $message, $headers);
    }
    
    ?>