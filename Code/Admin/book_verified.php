<?php
session_start();
?>

<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="./style.css">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <!-- <style>
    /* body {font-family: Arial, Helvetica, sans-serif;} */

    /* The Modal (background) */
    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      /* Stay in place */
      z-index: 1;
      /* Sit on top */
      padding-top: 100px;
      /* Location of the box */
      left: 0;
      top: 0;
      width: 100%;
      /* Full width */
      height: 100%;
      /* Full height */
      overflow: auto;
      /* Enable scroll if needed */
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.4);
      /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
      position: relative;
      background-color: #fefefe;
      margin: auto;
      padding: 0;
      border: 1px solid #888;
      width: 80%;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      -webkit-animation-name: animatetop;
      -webkit-animation-duration: 0.4s;
      animation-name: animatetop;
      animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
      from {
        top: -300px;
        opacity: 0
      }

      to {
        top: 0;
        opacity: 1
      }
    }

    @keyframes animatetop {
      from {
        top: -300px;
        opacity: 0
      }

      to {
        top: 0;
        opacity: 1
      }
    }

    /* The Close Button */
    .close {
      color: white;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }

    .modal-header {
      padding: 2px 16px;
      background-color: #5cb85c;
      color: white;
    }

    .modal-body {
      padding: 2px 16px;
    }

    .modal-footer {
      padding: 2px 16px;
      background-color: #5cb85c;
      color: white;
    }
  </style> -->
</head>

<?php

include "../database/connect.php";

$id = $_SESSION['ad_id'];

$bid = $_GET['id'];
$status = $_GET['status'];

$que = mysqli_query($con, "SELECT * FROM admin_data WHERE admin_id=$id");
$arr1 = mysqli_fetch_array($que);

$que2 = mysqli_query($con, "SELECT * FROM ebook_data WHERE book_id='$bid'");
$arr2 = mysqli_fetch_array($que2);


if(isset($_POST['sb'])){

    $auid = $arr2['author_id'];
$que3 = mysqli_query($con, "SELECT * FROM author_data WHERE author_id='$auid'");
$arr3 = mysqli_fetch_array($que3);

    // require '../mailer/PHPMailerAutoload.php';
    function PHPMailerAutoload($classname)
{
    //Can't use __DIR__ as it's only in PHP 5.3+
    $filename = dirname(__FILE__).DIRECTORY_SEPARATOR.'../mailer/class.'.strtolower($classname).'.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
    //SPL autoloading was introduced in PHP 5.1.2
    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
        spl_autoload_register('PHPMailerAutoload', true, true);
    } else {
        spl_autoload_register('PHPMailerAutoload');
    }
} else {
    function spl_autoload_register($classname)
    {
        PHPMailerAutoload($classname);
    }
}	
    require '../mailer/credential.php';
define('TOEMAIL', $arr3['author_email']);


    $mail = new PHPMailer;

    // $mail->SMTPDebug = 4;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = FROMEMAIL;                 // SMTP username
    $mail->Password = PASS;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom(FROMEMAIL, 'E-Book Macker');
$mail->addAddress(TOEMAIL);     // Add a recipient

    $mail->addReplyTo(FROMEMAIL);
    // print_r($_FILES['file']); exit;
    for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) { 
        $mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]);    // Optional name
    }
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = "Hello";
    $mail->Body    = "<b>Book Title = </b>" . $_POST['bname'] . "<br><br><b> Book Review :- </b><br>" .$_POST['book-review'];
    $mail->AltBody = 'message';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
        mysqli_query($con, "UPDATE ebook_data SET book_varified=$status WHERE book_id=$bid");

        header("Location: ./book_review.php");
    }

}	


    

// $que1 = mysqli_query($con, "SELECT * FROM admin_data WHERE admin_id=$id");
// $arr1 = mysqli_fetch_array($que1);

// $que2 = mysqli_query($con, "SELECT * FROM author_data WHERE author_id=$aid");
// $arr2 = mysqli_fetch_array($que2);

?>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bx-user bx-flashing'></i>
            <span class="logo_name">Admin Pannel</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="./index.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
        <a href="./book_review.php">
          <i class='bx bx-box'></i>
          <span class="links_name">Book</span>
        </a>
      </li>
            <li>
                <a href="./author.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Author list</span>
                </a>
            </li>
            <!-- <li>
        <a href="#">
          <i class='bx bx-pie-chart-alt-2'></i>
          <span class="links_name">Analytics</span>
        </a>
      </li> -->
            <!-- <li>
        <a href="#">
          <i class='bx bx-coin-stack'></i>
          <span class="links_name">Stock</span>
        </a>
      </li> -->
            <!-- <li>
        <a href="#">
          <i class='bx bx-book-alt'></i>
          <span class="links_name">Total order</span>
        </a>
      </li> -->
            <li>
                <a href="./profile.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Profile</span>
                </a>
            </li>
            <!-- <li>
        <a href="#">
          <i class='bx bx-message'></i>
          <span class="links_name">Messages</span>
        </a>
      </li> -->
            <!-- <li>
        <a href="#">
          <i class='bx bx-heart'></i>
          <span class="links_name">Favrorites</span>
        </a>
      </li> -->
            <!-- <li>
        <a href="#">
          <i class='bx bx-cog'></i>
          <span class="links_name">Setting</span>
        </a>
      </li> -->
            <li class="log_out">
                <a href="../logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <!-- <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div> -->
            <div class="profile-details">
                <!-- <img src="images/profile.jpg" alt=""> -->
                <i class='bx bx-user'></i>
                <a href="./profile.php"><span class="admin_name"><?php echo $arr1['admin_first_name'], " ", $arr1['admin_last_name'];  ?></span></a>
            </div>
        </nav>

        <div class="home-content">
            <!-- <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Order</div>
            <div class="number">40,876</div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bx-cart-alt cart'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Sales</div>
            <div class="number">38,876</div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-cart-add cart two'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Profit</div>
            <div class="number">$12,876</div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bx-cart cart three'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Return</div>
            <div class="number">11,086</div>
            <div class="indicator">
              <i class='bx bx-down-arrow-alt down'></i>
              <span class="text">Down From Today</span>
            </div>
          </div>
          <i class='bx bxs-cart-download cart four' ></i>
        </div>
      </div> -->

            <div class="sales-boxes">
                <div class="recent-sales box">
                    <div class="title">Book Review</div>
                    <div class="sales-details">
            <form enctype="multipart/form-data" action="./book_verified.php?id=<?php echo $bid?>&status=<?php echo $status?>" method="post" autocomplete="nope">
                  <input type="hidden" name="id" value="<?php echo $arr2['book_id'];?>">
                
                  <label>Book Name</label>
                  <input class="admin-profile-form-text" autocomplete="nope" type="text" name="bname" minlength="2" value="<?php echo $arr2['book_title'];?>" placeholder="Enter your First name" required>
                
                
                 
                  
                
                  
                  <label>Book Review</label>
                  <textarea class="admin-profile-form-text" autocomplete="nope" name="book-review" minlength="2" rows="4" cols="100%" value="" placeholder="Enter Book Description" required></textarea>
                  
                  <!-- <label>Book File</label>
                  <input class="admin-profile-form-text" type="file" name="file" multiple="multiple" id="file" minlength="2" required> -->
                  <label for="name">File:</label>
                    <input name="file[]" multiple="multiple" class="form-control" type="file" id="file">
                  <!-- <label for="name">File:</label>
                    <input name="file" multiple="multiple" class="form-control" type="file" onchange="c(this.value)" id="file"> -->
                <input class="admin-profile-form-submit" type="submit" name="sb" value="Send Review">
              
            </form>
            <!-- <script>
            function c(value){
                sessionStorage.setItem('SID',value);
                
            }
            </script> -->
          </div>

                </div>

                <!-- <div class="top-sales box">
          <div class="title">Top Seling Product</div>
          <ul class="top-sales-details">
            <li>
              <a href="#">
                <img src="images/sunglasses.jpg" alt="">
                <span class="product">Vuitton Sunglasses</span>
              </a>
              <span class="price">$1107</span>
            </li>
            <li>
              <a href="#">
                <img src="images/jeans.jpg" alt="">
                <span class="product">Hourglass Jeans </span>
              </a>
              <span class="price">$1567</span>
            </li>
            <li>
              <a href="#">
                <img src="images/nike.jpg" alt="">
                <span class="product">Nike Sport Shoe</span>
              </a>
              <span class="price">$1234</span>
            </li>
            <li>
              <a href="#">
                <img src="images/scarves.jpg" alt="">
                <span class="product">Hermes Silk Scarves.</span>
              </a>
              <span class="price">$2312</span>
            </li>
            <li>
              <a href="#">
                <img src="images/blueBag.jpg" alt="">
                <span class="product">Succi Ladies Bag</span>
              </a>
              <span class="price">$1456</span>
            </li>
            <li>
              <a href="#">
                <img src="images/bag.jpg" alt="">
                <span class="product">Gucci Womens's Bags</span>
              </a>
              <span class="price">$2345</span>
            <li>
              <a href="#">
                <img src="images/addidas.jpg" alt="">
                <span class="product">Addidas Running Shoe</span>
              </a>
              <span class="price">$2345</span>
            </li>
            <li>
              <a href="#">
                <img src="images/shirt.jpg" alt="">
                <span class="product">Bilack Wear's Shirt</span>
              </a>
              <span class="price">$1245</span>
            </li>
          </ul>
        </div> -->
            </div>
        </div>
    </section>
    <!-- <div id="myModal" class="modal">

    Modal content
    <div class="modal-content">
      <div class="modal-header">
        <span class="close" onclick=closeModel()>&times;</span>
        <h2>Modal Header</h2>
      </div>
      <div class="modal-body">
        <p>Some text in the Modal Body</p>
        <p>Some other text...</p>
      </div>
      <div class="modal-footer">
        <h3>Modal Footer</h3>
      </div>
    </div>
  </div> -->

    </div>

    <!-- <script>
    function openModel(){
      var modal = document.getElementById("myModal");
      modal.style.display = "block";
      
    }
    
    function closeModel(){
      var modal = document.getElementById("myModal");
      modal.style.display = "none";
    }
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    // var btn = document.getElementsByClassName("authorView")[1];

    // Get the <span> element that closes the modal

    // When the user clicks the button, open the modal 
    // btn.onclick = function() {
    // }

    // When the user clicks on <span> (x), close the modal
    // span.onclick = function() {
    // }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script> -->

    <script src="./script.js"></script>

</body>

</html>