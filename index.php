
<!DOCTYPE html>
<html>
<head>
	<title>Узнать информацию о сериале</title>
</head>
<body>
<form method="POST" name="findserial">
	<label>Узнать информацию о сериале:</label><br><br>
	<input type="text" placeholder="Введите название сериала на английском" id="serial" name="serial" required="1"><br><br>
	<input type="submit" name="done" id="done" value="Отправить">
</form>
</body>
</html>
<?php
include_once 'libs/simple_html_dom.php';
if (isset($_POST['serial'])) {
	$serial =$_POST['serial'];
	$serial = str_replace(" ", "-", $serial);
	$serial = mb_strtolower($serial);
	$url = "http://fanserials.house/".$serial."/";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$answer = curl_exec($ch);
	$dom = new simple_html_dom();
	$html = str_get_html($answer);
	$list = $html->find(".info-list li");
	$i = 0;
	$serial = array();
	$div = $html->find(".body p");
	$whyserial = array();
	$photo = $html->find(".field-poster img");
	$size = count($photo);
	foreach ($list as $key => $value) {
	$serial[$value->children(0)->plaintext] = $value->children(1)->plaintext;
	}
	foreach ($serial as $key => $value) {
	echo $key." ".$value;
	echo "<br>";
	}
	echo "<br><br><br><br><br>";
	foreach ($div as $key => $value) {
	$whyserial[$i] = $value->plaintext;
	$i++;

	}
	foreach ($whyserial as $key => $value) 
	{
	echo $value;
	echo "<br><br>";
	}
	$photo = $photo[$size-1];
	echo $photo;
}

?>