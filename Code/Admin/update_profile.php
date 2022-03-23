<?php

if(isset($_POST['sb'])){
    include "../database/connect.php";

    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    if($cpass==$pass){
        mysqli_query($con,"UPDATE admin_data SET admin_first_name='$fname',admin_last_name='$lname',admin_email='$email',admin_password='$pass' WHERE admin_id='$id'");
        echo "<script LANGUAGE='JavaScript'>
        window.alert('Update Succesfully...');
        window.location.href='profile.php';
        </script>";
    }
    else{
        echo "<script LANGUAGE='JavaScript'>
        window.alert('Password and Conform Password Both are not Match... Please Enter Same Password...');
        window.location.href='profile.php';
        </script>";
    }
}
else{
    header("Location: profile.php");
}

?>