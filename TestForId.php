<?php 
// ini_set('SMTP',"server.com");
$to_email="addiskelbesa@gmail.com";
$subject="checking email";
$body="hi there am from php";
$headers="from :mikiyastekalegn@gmail.com";
mail($to_email,$subject,$body,$headers);

?>