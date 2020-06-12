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
	$src = $photo->src;
	$title = $html->find(".title");
	$title_text = $title[2]->plaintext;
	$pagetitle = $html->find(".page-title");
	$pagetitle_text = $pagetitle[0]->plaintext;


}

?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="style.css">
    <title>Hello, world!</title>
  </head>
  <body>
  	<header class="header">
 <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark" role="navigation">
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
 <input class="form-control mr-sm-4" type="text" placeholder="Введите название сериала на английском" aria-label="Поиск" required="1" id="serial" name="serial">
 <button class="btn btn-outline-success my-2 my-sm-0" name="done" id="done" type="submit">Отправить</button>
 </form>
 </div>
 </nav>
 </header>
 <?php if (isset($_POST['serial'])) {
 ?>

 <div class="container ">
 	<h2><?php echo "$pagetitle_text";  ?></h2>
 	<div class="row">
 		<div class="col-6">
 			
 			<p><?php foreach ($serial as $key => $value) {
				echo $key." ".$value;
				echo "<br>";} ?>
					
			</p>
		</div>
		<div class="col-6">
			<img class="d-block w-100" src="<?php echo $src;?>" alt="First slide">
		</div>
	</div>
		<h2><?php echo $title_text; ?></h2>
		<p><?php foreach ($whyserial as $key => $value) 
			{
				echo $value;
				echo "<br><br>";
			}  ?>
			</p>
 </div>
<?php }  ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
