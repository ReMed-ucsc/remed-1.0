<?php
session_start();
if (!isset($_SESSION['user'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReMed Dashboard</title>
    <link rel="stylesheet" href="Dashboard-page.css">
    <link rel="stylesheet" href="../Navbar/Navbar.css">
    <link rel="stylesheet" href="../Sidebar/Sidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    
<header>
    <?php
    $isRegisteredUser = isset($_SESSION['user']);  // Check if user is logged in

    if($isRegisteredUser){
        include '../Navbar/reg-navbar.php';
    } else {
        include '../Navbar/non-reg-navbar.php';
    }
    ?>
    


    <!-- Sidebar (initially hidden) -->
    
       
    
</header>

<div class="fullpage">

<div class="sidebar-part">

    <div class="container">
        <div class="sidebar active">
            <div class="menu-btn">
                <i class="ph-bold ph-caret-left"></i>
            </div>
            <div class="head">
                <div class="user-img">
                    <img src="../SRC/image 6.jpg" alt="" />
                </div>
            <div class="user-details">
                <p class="title">userexample123@gmail.com</p>
                <p class="name">Healthcare Pharmacy</p>
            </div>
        </div>
        <div class="nav">
          <div class="menu">
            <p class="title">Main</p>
            <ul>
              <li>
                <a href="#">
                  <i class="icon ph-bold ph-house-simple"></i>
                  <span class="text">Dashboard</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="icon ph-bold ph-user"></i>
                  <span class="text">Medicine</span>
                  <i class="arrow ph-bold ph-caret-down"></i>
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="#">
                      <span class="text">Available Medicine</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="text">Non-Available Medicine</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="active">
                <a href="#">
                  <i class="icon ph-bold ph-file-text"></i>
                  <span class="text">Orders</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="icon ph-bold ph-calendar-blank"></i>
                  <span class="text">Inventory</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="icon ph-bold ph-chart-bar"></i>
                  <span class="text">Income</span>
                  <i class="arrow ph-bold ph-caret-down"></i>
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="#">
                      <span class="text">Earnings</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="text">Funds</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="text">Declines</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="text">Payouts</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="menu">
            <p class="title">Settings</p>
            <ul>
              <li>
                <a href="#">
                  <i class="icon ph-bold ph-gear"></i>
                  <span class="text">Settings</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="menu">
          <p class="title">Account</p>
          <ul>
            <li>
              <a href="#">
                <i class="icon ph-bold ph-info"></i>
                <span class="text">Help</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="icon ph-bold ph-sign-out"></i>
                <span class="text">Logout</span>
              </a>
            </li>
          </ul>
        </div>
      </div>

      
    </div>

    <!-- Jquery -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"
      integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
      crossorigin="anonymous"
    ></script>
    <script src="../../Sidebar/sidebar.js"></script>

</div>

<div class="main-content">
    <h1>Dashboard</h1>
    <div class="search-container">
        <input type="text" placeholder="Search here" class="search-bar">
        <button class="search"><i class="icon ph-bold ph-magnifying-glass"></i>
        </button>
    </div>
    <div class="structure">
        <div class="top">
            <div class="cards">
                <div class="card black-card">
                    <img src="../SRC/image 8.jpg" class="card-icon">
                    <h4>Inventory status</h4>
                    <div class="data"><p>Check/Update</p></div>
                    <a href="#">View details</a>
                </div>
                <div class="card green-card">
                    <img src="../SRC/image 9.jpg" class="card-icon">
                    <h4>Income</h4>
                    <div class="data"><p>Rs.10,000</p></div>
                    <a href="#">View details</a>
                </div>
                <div class="card blue-card">
                    <img src="../SRC/image 10.jpg" class="card-icon">
                    <h4>Medicine Storage</h4>
                    
                    <div class="data"><p>515-15</p></div>
                    <!-- <div class="resolve"><a href="#">Resolve - 15</a></div> -->
                    <a href="#">View details</a>
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
                
                <i class="arrow ph-bold ph-caret-down"></i></h5>
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

<script src="Dashboard-page.js"></script>
<script src="../Sidebar/sidebar.js"></script>


</div>


</body>
</html>
