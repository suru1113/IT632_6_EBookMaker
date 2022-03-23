<?php

if(isset($_POST['sb'])){
    include "./database/connect.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pcode = $_POST['pcode'];
    $photo = '';
    $status = 0;

    if($cpass==$pass){
        mysqli_query($con,"INSERT INTO author_data(author_first_name,author_last_name,author_email,author_phone_no,author_password,author_gender,author_city,author_state,author_pincode) VALUES('$fname','$lname','$email','$number','$pass','$gender','$city','$state','$pcode')");
        echo "<script LANGUAGE='JavaScript'>
        window.alert('Registration Succesfully... Please LogIn....');
        window.location.href='login.html';
        </script>";
    }
    else{
        echo "<script LANGUAGE='JavaScript'>
        window.alert('Password and Conform Password Both are not Match... Please Enter Same Password...');
        window.location.href='signup.html';
        </script>";
    }
}
else{
    header("Location: signup.html");
}

?>