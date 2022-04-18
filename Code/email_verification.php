<?php

include './database/connect.php';

$email = $_GET['email'];
$que1 = mysqli_query($con,"SELECT * FROM author_data WHERE author_email='$email'");
$arr = mysqli_fetch_array($que1);

if($arr['author_email'] == $email){
    $que2 = mysqli_query($con,"UPDATE author_data SET author_email_status=1 WHERE author_email='$email'");

    if($que2===true){
        echo "<script LANGUAGE='JavaScript'>
        window.alert('You Email is Varifide...');
        window.location.href='login.html';
        </script>";
    }
}
else{
    echo "<script LANGUAGE='JavaScript'>
        window.alert('Sorry... You Email is Not Varifide...');
        window.location.href='signup.html';
        </script>";
}

?>