<?php
include_once 'libs/simple_html_dom.php';
$url = "http://fanserials.dog/";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$answer = curl_exec($ch);
	$dom = new simple_html_dom();
	$html = str_get_html($answer);
	if (!empty($html)) {
	$list = $html->find(".field-poster");
	$links = array();
	$i = 0;
	foreach ($list as $key => $value) {
		$links[$i] = $value->href;
		$i++;
	}
	$titles = array();
	$opiss = array();
	$photos = array();
	$check = array();
	for ($i=0; $i < 4 ; $i++) { 
	$url = "http://fanserials.dog".$links[$i];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$answer = curl_exec($ch);
	$dom = new simple_html_dom();
	$html = str_get_html($answer);
	$title = $html->find(".page-title");
	$title = $title[0]->plaintext;
	$titles[$i] = $title;
	$checktitle = $html->find(".title");
	$check[$i] = $checktitle[2]->plaintext;
	$opis = $html->find(".body p");
	
	$tempopis = "";
	foreach ($opis as $key => $value) {
		$tempopis=$tempopis.$value->plaintext."<br><br>";
	}
	$opiss[$i] = $tempopis;
	$photo = $html->find(".field-poster img");
	$photo = $photo[count($photo)-1];
	$src = $photo->src;
	$photos[$i] = $src;
	
	}
	}
	for ($i=0; $i < 4; $i++) { 
		echo $titles[$i]."<br><br>".$check[$i]."<br><br>".$opiss[$i]."<br><br>".$photos[$i]."<br><br>";
	}
 ?>