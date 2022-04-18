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
    <style>

    </style>
</head>

<?php

include "../database/connect.php";

$id = $_SESSION['au_id'];

$que1 = mysqli_query($con, "SELECT * FROM author_data WHERE author_id=$id");
$arr1 = mysqli_fetch_array($que1);

$que2 = mysqli_query($con, "SELECT * FROM ebook_data WHERE author_id='$id'");

?>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bx-user bx-flashing'></i>
            <span class="logo_name">Author Pannel</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="./index.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./new_book.php">
                    <i class='bx bx-box'></i>
                    <span class="links_name">New Book</span>
                </a>
            </li>
            <li>
                <a href="./book.php" class="active">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Book list</span>
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
                <a href="./profile.php"><span class="admin_name"><?php echo $arr1['author_first_name'], " ", $arr1['author_last_name'];  ?></span></a>
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
                    <div class="title">Books List</div>
                    <div class="sales-details">
                        <table>
                            <tr>
                                <th style="text-align: center;">Id</th>
                                <th style="text-align: center;">Title</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Verified</th>
                                <th style="text-align: center;">Operation</th>
                            </tr>
                            <?php
                            $count = 0;
                                while ($arr2 = mysqli_fetch_array($que2)) {
                                    $count++;
                                    ?>
                                    <tr>
                                        <td><?php echo $arr2['book_id']; ?></td>
                                        <td><?php echo $arr2['book_title']; ?></td>
    
                                        <?php
                                        if ($arr2['book_status'] == 0) {
                                        ?>
                                            <td><a href="./edit_mode_change.php?status=1&id=<?php echo $arr2['book_id']; ?>"><button class="author-verified-button">Editing</button></a></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td><a href="./edit_mode_change.php?status=0&id=<?php echo $arr2['book_id']; ?>"><button class="author-unverified-button">Under Review</button></a></td>
                                        <?php
                                        }
                                        ?>
    
                                        <?php
                                        if ($arr2['book_varified'] == 0) {
                                        ?>
                                            <td><button class="author-unverified-button">UnVerified</button></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td><button class="author-verified-button">Verified</button></td>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if ($arr2['book_status'] == 0) {
                                        ?>    
                                        <td><a href="./edit_book.php?id=<?php echo $arr2['book_id']; ?>"><button class="author-verified-button">Edit Book</button></a></td>
                                        <?php
                                        } else {
                                        ?>
                                        <td><a href="../Admin/book_view.php?id=<?php echo $arr2['book_id']; ?>"><button class="author-unverified-button">Book View</button></a></td>
                                        <?php
                                        }
                                        ?>
                                      </tr>
                                <?php
                                }
                                if(!$count){
                                ?>
                                <tr>
                                    <td colspan="5">No Book Found...</td>
                                </tr>
                                <?php
                                }
                            ?>
                        </table>
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

    <script src="./script.js"></script>

</body>

</html>