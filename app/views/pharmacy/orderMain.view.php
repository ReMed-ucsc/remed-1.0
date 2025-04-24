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
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/table.css">
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
      <h2>Orders</h2>
      <div class="search-container">
        <input type="text" placeholder="Search here" class="search-bar">
        <button class="search"><i class="icon ph-bold ph-magnifying-glass"></i>
        </button>
        <div id="search-results" class="search-results"></div>
      </div>

      <div class="ongoing">Ongoing Orders</div>

      <section class="table-management">


        <table class="table">
          <thead>
            <tr>
              <th style="width: 7%;">Order ID</th>
              <th style="width: 7%;">Patient ID</th>
              <th style="width: 20%;">Delivery Address</th>
              <th style="width: 5%;">Date</th>
              <th style="width: 10%;">Payment</th>
              <!-- <th style="width: 5%;">Type</th> -->
              <th style="width: 5%;">Status</th>
              <th style="width: 5%;"></th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($orders)): ?>
              <?php foreach ($orders as $order): ?>
                <tr>
                  <td><?= htmlspecialchars($order->OrderID) ?></td>
                  <td><?= htmlspecialchars($order->PatientID) ?></td>
                  <td><?php
                      if ($order->destination != 1)
                        echo htmlspecialchars($order->destination);
                      else echo 'Pickup' ?></td>
                  <td><?= htmlspecialchars($order->date) ?></td>
                  <td><?php
                      if ($order->pickup != 'Y')
                        echo 'Cash on Delivery';
                      else echo 'Online'
                      ?></td>
                  <!-- <td><?= htmlspecialchars($order->pickup) ?></td> -->
                  <td><?php
                      $orderModel = new MedicineOrder();
                      $orderStatus = $orderModel->getStatusName($order->status);
                      echo $orderStatus;
                      ?></td>
                  <td><a class="view" href="<?= ROOT ?>/order/<?= $order->OrderID ?>">View</a></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8">No orders found.</td>
              </tr>
            <?php endif; ?>
          </tbody>


        </table>

        <button class="new-order-btn"><i class="ph-bold ph-plus"></i>
          <a href="<?= ROOT ?>/orderCreate" style="text-decoration: none; color:white;" class="new-order">New Order</a>
        </button>

      </section>

    </div>

    <script src="<?= ROOT ?>/assets/js/pharmacy/Order-main.js"></script>




  </div>


</body>

</html>