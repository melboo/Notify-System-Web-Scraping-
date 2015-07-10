<?php

error_reporting(E_ALL);

$crns = array('6783');

$length = count($crns);

for ($i = 0; $i < $length; $i++) {
	
	$ch = curl_init("https://url.com/value=".$crns[$i]."");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$ps = curl_exec($ch);
	
	$dom = new DOMDocument();
	
	@$dom->loadHTML($ps); //@ no error in html
	
	$xpath = new DOMXPath($dom);
	
	$titleQuery = $xpath->query("//th[@class='ddlabel']/text()");
	
	$seatsQuery = $xpath->query("//td[@class='dddefault']/text()");
	
	$title = $titleQuery->item(0)->nodeValue;
	$seats = $seatsQuery->item(9)->nodeValue;
	
	echo "<div id='title' style='width: 500px; float:left;'>", $title, "</div>";
	echo "<div id='seats'>", $seats, "</div>";
	
	$to = "mail@domain.com";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <myfriend@domain.com>' . "\r\n";
		
	$subject = "Free space in class: ".$title;
	$message = "
	<html>
	<head></head>
	<body>
	<p>Message</p>
	</body>
	";
	
	$toSms = "xxx@tmomail.net"; //depending on hoster
	$smsMessage = "Class: ".$title."Seats: ".$seats;
	
	if($seats >= 1){
		mail($to,$subject,$message,$headers);
		mail($toSms,'',$smsMessage);
	}
	//mail($to,$subject,$message,$headers);
	
 
}

?>