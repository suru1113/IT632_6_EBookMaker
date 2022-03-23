<?php

if(isset($_POST['sb'])){
    include "../database/connect.php";

    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['number'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pcode = $_POST['pcode'];

    if($cpass==$pass){
        mysqli_query($con,"UPDATE author_data SET author_first_name='$fname',author_last_name='$lname',author_email='$email',author_phone_no='$phone',author_password='$pass',author_gender='$gender',author_city='$city',author_state='$state',author_pincode='$pcode' WHERE author_id='$id'");
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