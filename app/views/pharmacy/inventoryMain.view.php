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
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/Order-main.css">
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

    <?php include(BASE_PATH . '/app/views/inc/pharmacy/sidebar.php'); ?>


    <div class="main-content">
      <h2>Inventory</h2>
      <div class="search-container">
        <input type="text" placeholder="Search here" class="search-bar">
        <button class="search"><i class="icon ph-bold ph-magnifying-glass"></i>
        </button>
      </div>

      <div class="ongoing">Current Stock</div>

      <section class="order-management">


        <table class="order-table">
          <thead>
            <tr>
              <th style="width: 7%;">Batch ID</th>
              <th style="width: 20%;">Item Name</th>
              <th style="width: 7%;">Quantity</th>
              <th style="width: 5%;">Category</th>
              <th style="width: 10%;">Expiration Date</th>
              <th style="width: 5%;">Reorder Level</th>
              <th style="width: 5%;">Status</th>
              <th style="width: 5%;"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>BATCH-001</td>
              <td>Paracetamol</td>
              <td>50</td>
              <td>Medicines</td>
              <td>2024-12-15</td>
              <td>20</td>
              <td>In Stock</td>
              <td><a class="view" href="#">View</a></td>
            </tr>
            <tr>
              <td>BATCH-002</td>
              <td>Ibuprofen</td>
              <td>30</td>
              <td>Medicines</td>
              <td>2025-01-10</td>
              <td>15</td>
              <td>Low Stock</td>
              <td><a class="view" href="#">View</a></td>
            </tr>
            <tr>
              <td>BATCH-003</td>
              <td>Vitamin C</td>
              <td>100</td>
              <td>Supplements</td>
              <td>2025-05-20</td>
              <td>25</td>
              <td>In Stock</td>
              <td><a class="view" href="#">View</a></td>
            </tr>
            <tr>
              <td>BATCH-004</td>
              <td>Amoxicillin</td>
              <td>10</td>
              <td>Medicines</td>
              <td>2024-11-30</td>
              <td>10</td>
              <td>Critical</td>
              <td><a class="view" href="#">View</a></td>
            </tr>
            <tr>
              <td>BATCH-005</td>
              <td>Calcium Tablets</td>
              <td>75</td>
              <td>Supplements</td>
              <td>2026-06-12</td>
              <td>30</td>
              <td>In Stock</td>
              <td><a class="view" href="#">View</a></td>
            </tr>
            <tr>
              <td>BATCH-006</td>
              <td>Insulin</td>
              <td>20</td>
              <td>Medicines</td>
              <td>2024-12-01</td>
              <td>5</td>
              <td>Low Stock</td>
              <td><a class="view" href="#">View</a></td>
            </tr>
            <tr>
              <td>BATCH-007</td>
              <td>Aspirin</td>
              <td>40</td>
              <td>Medicines</td>
              <td>2024-12-31</td>
              <td>20</td>
              <td>In Stock</td>
              <td><a class="view" href="#">View</a></td>
            </tr>
          </tbody>
        </table>

        <button class="new-order-btn"><i class="ph-bold ph-plus"></i>
          <p class="new-order">New Stock</p>
        </button>

      </section>

    </div>

    <script src="<?= ROOT ?>/assets/js/pharmacy/Order-main.js"></script>




  </div>


</body>

</html>