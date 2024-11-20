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
    <link rel="stylesheet" href="Order-main.css">
    <link rel="stylesheet" href="../../Navbar/Navbar.css">
    <link rel="stylesheet" href="../../Sidebar/Sidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    
<header>
    <?php
    $isRegisteredUser = isset($_SESSION['user']);  // Check if user is logged in

    if($isRegisteredUser){
        include '../../Navbar/reg-navbar.php';
    } else {
        include '../../Navbar/non-reg-navbar.php';
    }
    ?>
    


    <!-- Sidebar (initially hidden) -->
    
       
    
</header>

<div class="fullpage">

<?php include('../../Sidebar/sidebar.php'); ?>


<div class="main-content">
    <h2>Orders</h2>
    <div class="search-container">
        <input type="text" placeholder="Search here" class="search-bar">
        <button class="search"><i class="icon ph-bold ph-magnifying-glass"></i>
        </button>
    </div>

    <div class="ongoing">Ongoing Orders</div>

    <section class="order-management">
      
    
      <table class="order-table">
        <thead>
          <tr>
            <th style="width: 7%;">Order ID</th>
            <th style="width: 7%;">Patient ID</th>
            <th style="width: 20%;">Delivery Address</th>
            <th style="width: 5%;">Date</th>
            <th style="width: 10%;">Payment</th>
            <th style="width: 5%;">Type</th>
            <th style="width: 5%;">Status</th>
            <th style="width: 5%;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#564564</td>
            <td>DEF456</td>
            <td>250 River Dr, TX</td>
            <td>31/08/2024</td>
            <td>$67.99</td>
            <td>Cash on Delivery</td>
            <td><span class="status pending">Pending</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#324562</td>
            <td>XYZ789</td>
            <td>123 Oak St, FL</td>
            <td>25/08/2024</td>
            <td>$100.99</td>
            <td>Transfer</td>
            <td><span class="status canceled">Canceled</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#564564</td>
            <td>DEF456</td>
            <td>250 River Dr, TX</td>
            <td>31/08/2024</td>
            <td>$67.99</td>
            <td>Cash on Delivery</td>
            <td><span class="status pending">Pending</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#564564</td>
            <td>DEF456</td>
            <td>250 River Dr, TX</td>
            <td>31/08/2024</td>
            <td>$67.99</td>
            <td>Cash on Delivery</td>
            <td><span class="status pending">Pending</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#324562</td>
            <td>XYZ789</td>
            <td>123 Oak St, FL</td>
            <td>25/08/2024</td>
            <td>$100.99</td>
            <td>Transfer</td>
            <td><span class="status canceled">Canceled</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
        </tbody>
      </table>
      
        <button class="new-order-btn"><i class="ph-bold ph-plus"></i>
        <p class="new-order">New Order</p></button>
      
    </section>
    
</div>

<script src="Order-main.js"></script>
<script src="../../Sidebar/sidebar.js"></script>



</div>


</body>
</html>
