<?php
session_start();

if(isset($_POST['sb'])){
    include "./database/connect.php";

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $que = mysqli_query($con, "SELECT * FROM author_data WHERE author_email='$email' AND author_password='$pass'");

    if($r=mysqli_fetch_array($que)){
        if($r['author_email_status']==0){
            echo "<script LANGUAGE='JavaScript'>
        window.alert('You Email Not Varifide...');
        window.location.href='login.html';
        </script>";
        }
        else{
        if($r['author_verified']==0){
            echo "<script LANGUAGE='JavaScript'>
        window.alert('You Are Not Varifide...');
        window.location.href='login.html';
        </script>";
        }
        else{
            $_SESSION['au_id'] = $r[0];
            header("Location: ./Author/index.php");
        }
    }
    }

    $que = mysqli_query($con, "SELECT * FROM admin_data WHERE admin_email='$email' AND admin_password='$pass'");

    if($r=mysqli_fetch_array($que)){
        $_SESSION['ad_id'] = $r[0];

        header("Location: ./Admin/index.php");
    }
    else{
        echo "<script LANGUAGE='JavaScript'>
        window.alert('Please Enter Valid Data...');
        window.location.href='login.html';
        </script>";
    }
}
else{
    header("Location: login.html");
}

?>