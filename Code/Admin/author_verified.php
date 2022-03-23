<?php

include '../database/connect.php';

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($con,"UPDATE author_data SET author_verified=$status WHERE author_id=$id");

echo "<script LANGUAGE='JavaScript'>
        window.alert('Verified Change Succesfully...');
        window.location.href='author.php';
        </script>";

?>