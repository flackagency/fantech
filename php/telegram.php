<?php 
$post = $_POST;
$type = $post['type'];


// Общие поля в формах
$name = $post['user-name'];
$phone = $post['user-phone'];

$point = "• ";

if($type == 'backCall'){
	$type = '<b>Обратный звонок</b>';

	$arr = array(
	  'Имя клиента: ' => $name,
	  'Телефон: ' => $phone,
	);

}elseif ($type == 'order') {
	$type = '<b>Заказ</b>';
	$price = $post['price'];

	$products = json_decode($post['products']);



	$arr = [];

	foreach($products as $key => $value) {
		$arr[$value[0]] = " Цвет - ".$value[1].", Количество - ".$value[2]."%0A";
	};

	
	$arr['Имя клиента: '] =  $name;
	$arr['Телефон: '] =  $phone;
	$arr['К оплате: '] =  $price;
}



//в переменную $token нужно вставить токен, который нам прислал @botFather
$token = "1311367436:AAH2jv932dUoAP80DAZKfPrRiEIe2XZSDtg";

//нужна вставить chat_id (Как получить chad id, читайте ниже)
$chat_id = "-1001257414459";

//Далее создаем переменную, в которую помещаем PHP массив


//При помощи цикла перебираем массив и помещаем переменную $txt текст из массива $arr
foreach($arr as $key => $value) {
  $txt .= $point."<b>".$key."</b> ".$value."%0A";
};

$txt = "<b>".$type."</b> %0A %0A".$txt; 


//Осуществляется отправка данных в переменной $sendToTelegram
$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
// $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

if ($sendToTelegram) {
  echo json_encode('success', JSON_UNESCAPED_UNICODE);
}else{
  echo "Error";
} 
?>