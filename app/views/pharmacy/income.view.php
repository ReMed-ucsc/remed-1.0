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
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/income.css">
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
      <h2>Income</h2>
      <div class="search-container">
        <input type="text" placeholder="Search here" class="search-bar">
        <button class="search"><i class="icon ph-bold ph-magnifying-glass"></i>
        </button>
      </div>

      <div class="ongoing-container">
        <div class="ongoing">Income Details</div>
        <div class="filter">
          <label for="filter-status">Filter by Status:</label>
          <select id="filter-status">
            <option value="all">All</option>
            <option value="success">Earnings</option>
            <option value="pending">Payouts</option>
            <option value="canceled">Declines</option>
          </select>
        </div>
      </div>

      <section class="table-management">
        <table class="table">
          <thead>
            <tr>
              <th style="width: 7%;">Income ID</th>
              <th style="width: 7%;">Account</th>
              <th style="width: 20%;">Description</th>
              <th style="width: 10%;">Date</th>
              <th style="width: 10%;">Amount</th>
              <th style="width: 10%;">Type</th>
              <th style="width: 10%;">Status</th>
              <th style="width: 5%;"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#123456</td>
              <td>Bank A</td>
              <td>Monthly subscription earnings</td>
              <td>01/09/2024</td>
              <td>$1,000.00</td>
              <td>Credit</td>
              <td><span class="status success">Earnings</span></td>
              <td><a class="view" href="#">Details</a></td>
            </tr>
            <tr>
              <td>#654321</td>
              <td>Bank B</td>
              <td>Transfer to payout account</td>
              <td>31/08/2024</td>
              <td>$500.00</td>
              <td>Debit</td>
              <td><span class="status pending">Payouts</span></td>
              <td><a class="view" href="#">Details</a></td>
            </tr>
            <tr>
              <td>#789123</td>
              <td>Bank C</td>
              <td>Transaction declined</td>
              <td>25/08/2024</td>
              <td>$250.00</td>
              <td>Credit</td>
              <td><span class="status canceled">Declines</span></td>
              <td><a class="view" href="#">Details</a></td>
            </tr>
            <tr>
              <td>#123456</td>
              <td>Bank A</td>
              <td>Monthly subscription earnings</td>
              <td>01/09/2024</td>
              <td>$1,000.00</td>
              <td>Credit</td>
              <td><span class="status success">Earnings</span></td>
              <td><a class="view" href="#">Details</a></td>
            </tr>
            <tr>
              <td>#789123</td>
              <td>Bank C</td>
              <td>Transaction declined</td>
              <td>25/08/2024</td>
              <td>$250.00</td>
              <td>Credit</td>
              <td><span class="status canceled">Declines</span></td>
              <td><a class="view" href="#">Details</a></td>
            </tr>
            <tr>
              <td>#654321</td>
              <td>Bank B</td>
              <td>Transfer to payout account</td>
              <td>31/08/2024</td>
              <td>$500.00</td>
              <td>Debit</td>
              <td><span class="status pending">Payouts</span></td>
              <td><a class="view" href="#">Details</a></td>
            </tr>
            <tr>
              <td>#789123</td>
              <td>Bank C</td>
              <td>Transaction declined</td>
              <td>25/08/2024</td>
              <td>$250.00</td>
              <td>Credit</td>
              <td><span class="status canceled">Declines</span></td>
              <td><a class="view" href="#">Details</a></td>
            </tr>
            <tr>
              <td>#654321</td>
              <td>Bank B</td>
              <td>Transfer to payout account</td>
              <td>31/08/2024</td>
              <td>$500.00</td>
              <td>Debit</td>
              <td><span class="status pending">Payouts</span></td>
              <td><a class="view" href="#">Details</a></td>
            </tr>
            <tr>
              <td>#654321</td>
              <td>Bank B</td>
              <td>Transfer to payout account</td>
              <td>31/08/2024</td>
              <td>$500.00</td>
              <td>Debit</td>
              <td><span class="status pending">Payouts</span></td>
              <td><a class="view" href="#">Details</a></td>
            </tr>

          </tbody>
        </table>
      </section>



      <script src="<?= ROOT ?>/assets/js/pharmacy/Order-main.js"></script>




    </div>


</body>

</html>