<?php
include_once 'libs/simple_html_dom.php';
if (isset($_POST['serial'])) {
	$serial =$_POST['serial'];
	$serial = str_replace(" ", "-", $serial);
	$serial = str_replace("*", "", $serial);
	$serial = mb_strtolower($serial);
	$url = "http://fanserials.house/".$serial."/";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$answer = curl_exec($ch);
	$dom = new simple_html_dom();
	$html = str_get_html($answer);
	if (!empty($html)) {
	$list = $html->find(".info-list li");
	}
	if (!empty($list)) {
		

	$serial = array();
	foreach ($list as $key => $value) 
	{
		$serial[$value->children(0)->plaintext] = $value->children(1)->plaintext;
	}
	$div = $html->find(".body p");
	$i = 0;
	$whyserial = array();
	$photo = $html->find(".field-poster img");
	$size = count($photo);
	foreach ($div as $key => $value) 
	{
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
    <title>Найти сериал</title>
  </head>
  <body>
  	<header class="header sticky-top w-100">
 <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark" role="navigation">
 <a class="navbar-brand" href="index.php" role="banner">Узнай сериал</a>
 
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
 <input class="form-control  mr-sm-4" type="text" placeholder="Введите название сериала на английском" aria-label="Поиск" required="1" id="serial" name="serial">
 <button class="btn btn-outline-success my-2 my-sm-0 btn-block-sm" name="done" id="done" type="submit">Отправить</button>
 </form>
 </div>
 </nav>
 </header>
 <?php if (isset($_POST['serial']) && $list) {
 ?>
	 <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
   Информация о сериале успешно отображена
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
 <div class="container ">
 	<h1 class="display-3"><?php echo "$pagetitle_text";  ?></h1>
 	<div class="row">
 		<div class="col-12 col-lg-6 col-sm-12 col-md-12">
 			
 			<p><?php foreach ($serial as $key => $value) {
				echo $key." ".$value;
				echo "<br>";} ?>
					
			</p>
		</div>
		<div class="col-12 col-lg-6 col-sm-12 col-md-12">
			<img class="d-block w-100" src="<?php echo $src;?>" alt="First slide">
		</div>
	</div>
	<h1 class="display-4"><?php echo $title_text; ?></h1>
		<?php for ($i=0; $i < count($whyserial)-1 ; $i++) { ?>
	<p> <?php echo $whyserial[$i]; ?></p><?php }  ?>
	<div class="row p-5">
	<div class="col"></div>
	<div class="col-lg-8 col-md-12 col-sm-12 col-12">
		<div class="embed-responsive embed-responsive-16by9">
			<iframe src="https://www.youtube.com/embed/iWdv04uFzzQ"  class="embed-responsive-item" allowfullscreen></iframe>
		</div>
	</div>
	<div class="col"></div>
	</div>
 </div>
<?php } else if (isset($_POST['serial'])) {
 ?>
<div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
   Упс...Что-то пошло не так
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="container">
	<h1>Возможно, вы допустили одну из ошибок</h1>
	<ul>
		<li>Ввели название сериала на русском языке</li>
		<li>Использовали символы не из английского алфавита</li>
		<li>Ошиблись в названии сериала</li>
	</ul>
	<p class="error_p">Опираясь на рекомендации из списка, попробуйте еще раз</p>
</div>
<?php } else { ?>
<div class="container-fluid p-0">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval = "4000">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active "></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="/img/admission-2974645_1920.jpg" alt="First slide">
    
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/img/movie-918655_1920.jpg" alt="Second slide">
     
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/img/cinema-4609877_960_720.jpg" alt="Third slide">
    
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
<?php }  ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
