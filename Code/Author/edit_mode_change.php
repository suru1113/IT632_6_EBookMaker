<?php

include '../database/connect.php';

$id = $_GET['id'];
$status = $_GET['status'];


mysqli_query($con,"UPDATE ebook_data SET book_status=$status, book_varified=0 WHERE book_id=$id");


echo "<script LANGUAGE='JavaScript'>
        window.alert('Status Change Succesfully...');
        window.location.href='./book.php';
        </script>";

?>