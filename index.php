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
	foreach ($div as $key => $value) {
	$whyserial[$i] = $value->plaintext;
	$i++;

	}
	$photo = $photo[$size-1];

}

?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
   	<link rel="stylesheet" type="text/css" href="/bootstrap.min.css">

    <title>Hello, world!</title>
  </head>
  <body>
  	<header class="header">
 <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" role="navigation">
 <a class="navbar-brand" href="#" role="banner">Узнай сериал</a>
 
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDefault" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Переключить навигацию">
 <span class="navbar-toggler-icon"></span>
 </button>
 
 <div class="collapse navbar-collapse" id="navbarsDefault">
 <ul class="navbar-nav mr-auto">
 <li class="nav-item active">
 <a class="nav-link" href="#">Главная <span class="sr-only">(current)</span></a>
 </li>
 <li class="nav-item">
 <a class="nav-link" href="#">О сайте</a>
 </li>
 </ul>
 
 <form method="POST" class="form-inline my-2 my-lg-0" role="search" name="findserial">
 <input class="form-control mr-sm-2" type="text" placeholder="Введите название сериала на английском" aria-label="Поиск" required="1" id="serial" name="serial">
 <button class="btn btn-outline-success my-2 my-sm-0" name="done" id="done" type="submit">Отправить</button>
 </form>
 </div>
 </nav>
 </header>
 <div class="container" style="margin-top: 70px;">
 	<p><?php foreach ($serial as $key => $value) {
	echo $key." ".$value;
	echo "<br>";
	} ?></p>
	<p><?php foreach ($whyserial as $key => $value) 
	{
	echo $value;
	echo "<br><br>";
	}  ?>
	</p>
	<pre><?php echo "$photo"; ?></pre>
 </div>
 <script type="text/javascript" src="js/bootstrap.min.js"></script>
  </body>
</html>
