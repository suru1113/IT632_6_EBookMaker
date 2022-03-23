<?php

$con = mysqli_connect("localhost","root","","abc");

$name = 'hello';
$number = 10;

mysqli_query($con,"INSERT INTO def VALUES('','$number','$name')");

?>