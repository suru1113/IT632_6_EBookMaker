<?php

if(isset($_POST['submit'])){
    $to = 'test@gmail.com';
$subject = "Contact US Mail";
$txt = $_POST['name'] . "<br>" . $_POST['message'];
$headers = "From: " . $_POST['email'];
// $headers = "From: webmaster@example.com" . "\r\n" .
// "CC: somebodyelse@example.com";

mail($to,$subject,$txt);


}



?>