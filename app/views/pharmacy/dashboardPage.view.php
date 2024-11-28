<?php
// session_start();
// if (!isset($_SESSION['user'])) {
//     // Redirect to login page if user is not logged in
//     header("Location: login.php");
//     exit();
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ReMed Dashboard</title>
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/Dashboard-page.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/navbar.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/component/sidebar.css">
  <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  <header>
    <?php


    include BASE_PATH . '/app/views/inc/pharmacy/regNavbar.php';

    ?>



    <!-- Sidebar (initially hidden) -->



  </header>

  <div class="fullpage">
    <?php
    include BASE_PATH . '/app/views/inc/pharmacy/sidebar.php';
    ?>

  </div>

  <div class="main-content">
    <h2>Dashboard</h2>
    <div class="search-container">
      <input type="text" placeholder="Search here" class="search-bar">
      <button class="search"><i class="icon ph-bold ph-magnifying-glass"></i>
      </button>
    </div>
    <div class="structure">
      <div class="top">
        <div class="cards">
          <div class="card black-card">
            <img src="<?= ROOT ?>/assets/images/inventory.jpg" class="card-icon">
            <h4>Inventory status</h4>
            <div class="data">
              <p>Check/Update</p>
            </div>
            <a href="<?= ROOT ?>/inventoryMain">View details</a>
          </div>
          <div class="card green-card">
            <img src="<?= ROOT ?>/assets/images/revenue.jpg" class="card-icon">
            <h4>Income</h4>
            <div class="data">
              <p>Rs.10,000</p>
            </div>
            <a href="<?= ROOT ?>/income">View details</a>
          </div>
          <div class="card blue-card">
            <img src="<?= ROOT ?>/assets/images/storage.jpg" class="card-icon">
            <h4>Medicine Storage</h4>

            <div class="data">
              <p>515-15</p>
            </div>
            <!-- <div class="resolve"><a href="#">Resolve - 15</a></div> -->
            <a href="<?= ROOT ?>/medicine">View details</a>
          </div>
        </div>
      </div>
      <div class="middle">
        <div class="total-sales">
          Total Sales
          <canvas id="myBarChart"></canvas>
        </div>
        <div class="inventory">
          <div class="weekly">
            Inventory
            <h5>Weekly
              <ul class="sub-menu">

                <!-- <li>
                    <a href="#">
                      <span class="text">Daily</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="text">Weekly</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="text">Yearly</span>
                    </a>
                  </li> -->
              </ul>

              <i class="arrow ph-bold ph-caret-down"></i>
            </h5>
          </div>
          <canvas id="myPieChart"></canvas>
        </div>
      </div>
      <div class="bottom">
        <div class="recent-payment">
          <p>Recent payments</p>
          <table>
            <thead>
              <tr>
                <th>ORDER ID</th>
                <th>CUSTOMER NAME</th>
                <th>DATE</th>
                <th>PAYMENT METHOD</th>
                <th>PRICE</th>
                <th>INVOICE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>YY-953581</td>
                <td>Mr. Jones</td>
                <td>14-08-2022</td>
                <td>Card</td>
                <td>Rs. 5,000.00</td>
                <td>Completed</td>
              </tr>
              <tr>
                <td>YY-953582</td>
                <td>Mr. Smith</td>
                <td>15-08-2022</td>
                <td>Cash</td>
                <td>Rs. 2,500.00</td>
                <td>Pending</td>
              </tr>
              <tr>
                <td>YY-953582</td>
                <td>Mr. Smith</td>
                <td>15-08-2022</td>
                <td>Cash</td>
                <td>Rs. 2,500.00</td>
                <td>Pending</td>
              </tr>
              <tr>
                <td>YY-953582</td>
                <td>Mr. Smith</td>
                <td>15-08-2022</td>
                <td>Cash</td>
                <td>Rs. 2,500.00</td>
                <td>Pending</td>
              </tr>
              <tr>
                <td>YY-953582</td>
                <td>Mr. Smith</td>
                <td>15-08-2022</td>
                <td>Cash</td>
                <td>Rs. 2,500.00</td>
                <td>Pending</td>
              </tr>
              <tr>
                <td>YY-953582</td>
                <td>Mr. Smith</td>
                <td>15-08-2022</td>
                <td>Cash</td>
                <td>Rs. 2,500.00</td>
                <td>Pending</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= ROOT ?>/assets/js/pharmacy/dashboardPage.js"></script>



  </div>


</body>

</html>