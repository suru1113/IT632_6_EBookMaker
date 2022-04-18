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
    $email_status = 0;
    $status = 0;

    if($cpass==$pass){
        $que1 = mysqli_query($con, "SELECT * FROM author_data WHERE author_email='$email'");
        $arr1 = mysqli_fetch_array($que1);
        if($arr1['author_email']==$email){
            echo "<script LANGUAGE='JavaScript'>
        window.alert('Email Alreaday Register... Please Use Again....');
        window.location.href='signup.html';
        </script>";
        }
        else{
        $que = mysqli_query($con,"INSERT INTO author_data(author_first_name,author_last_name,author_email,author_phone_no,author_password,author_gender,author_city,author_state,author_pincode,author_email_status) VALUES('$fname','$lname','$email','$number','$pass','$gender','$city','$state','$pcode','$email_status')");
        if($que===true){
            header("Location: ./email_check/index.php?email=$email");
        }
        else{
            echo "<script LANGUAGE='JavaScript'>
        window.alert('Registration Not Succesfully... Please Try Again....');
        window.location.href='signup.html';
        </script>";
        }
    }      
        
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
