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
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/dashboardPage.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/table.css">

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
          <div class="profilecard">
            <div class="profilecard-left">
              <img src="<?= ROOT ?>/assets/images/admin.png" class="card-icon">
              <h4>Profile</h4>
              <div class="data">
                <p>HealthGuard Pharmacy</p>
              </div>
              <a href="<?= ROOT ?>/profilePage">View details</a>
            </div>
            <div class="profilecard-right">
              <div class="stat">
                <h4>Total Patients</h4>
                <p><?= $patientCount[0]->patientCount ?? 0 ?></p>
              </div>
              <div class="stat">
                <h4>Total Orders</h4>
                <p><?= $orderCount[0]->orderCount ?? 0 ?></p>
              </div>
              <div class="stat">
                <h4>Current Balance</h4>
                <p><?= $monthlyIncome[0]->currentBalance ?? 0 ?></p>
              </div>
            </div>
          </div>
          <div class="sidecards">
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
              <h4>Orders</h4>

              <div class="data">
                <p>515-<span class="style">15</span></p>
              </div>
              <!-- <div class="resolve"><a href="#">Resolve - 15</a></div> -->
              <a href="<?= ROOT ?>/medicine">View details</a>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="middle">
        <div class="middleline">
          <div class="total-sales">
            Total Sales
            <canvas id="myBarChart"></canvas>
          </div>
          <div class="inventory">
            <div class="weekly">
              Inventory
              <h5>Weekly
                <ul class="sub-menu">

                </ul>

                <i class="arrow ph-bold ph-caret-down"></i>
              </h5>
            </div>
            <canvas id="myPieChart"></canvas>
          </div>
        </div>
        <div class="middleline">
          <div class="total-sales">
            Patient Visit
            <canvas id="myPatientChart" width="500" height="200"></canvas>
          </div>
          <div class="total-sales">
            Patient Visit
            <canvas id="myPatientChart" width="200" height="200"></canvas>
          </div>
          <div class="total-sales">
            Patient Visit
            <canvas id="myPatientChart" width="300" height="200"></canvas>
          </div>
        </div>

      </div> -->

      <div class="middle">
        <div class="middleline">
          <div class="total-sales">
            Total Sales
            <canvas id="myBarChart"></canvas>
          </div>
          <div class="inventory">
            <div class="weekly">
              Inventory
              <h5>Weekly
                <ul class="sub-menu"></ul>
                <i class="arrow ph-bold ph-caret-down"></i>
              </h5>
            </div>
            <canvas id="myPieChart"></canvas>
          </div>
        </div>

        <div class="middleline">
          <div class="total-sales">
            Patient Visit
            <canvas id="myPatientChart" width="500" height="200"></canvas>
          </div>
          <div class="total-sales">
            Revenue Trend
            <canvas id="myLineChart" width="300" height="200"></canvas>
          </div>
          <div class="total-sales">
            Sales by Category
            <canvas id="myDoughnutChart" width="300" height="200"></canvas>
          </div>
        </div>


        <!-- <div class="middleline">
          <div class="total-sales">
            Revenue Trend
            <canvas id="myLineChart" width="400" height="200"></canvas>
          </div>
          <div class="total-sales">
            Sales by Category
            <canvas id="myDoughnutChart" width="400" height="200"></canvas>
          </div>
        </div> -->
      </div>


    </div>


    <!-- <div class="bottom"> -->
    <section class="table-management">
      <div class="table">
        <p>Recent payments</p>

        <?php show($stockLevels) ?>
        <table>
          <thead>
            <tr>
              <th style="width: 12%;">ORDER ID</th>
              <th style="width: 40%;">CUSTOMER NAME</th>
              <th style="width: 10%;">DATE</th>
              <th style="width: 20%;">PAYMENT METHOD</th>
              <th style="width: 15%;">PAYMENT</th>
              <th style="width: 13%;">INVOICE</th>
            </tr>
          </thead>
          <tbody>

            <?php if (!empty($data['payments'])): ?>
              <?php foreach ($data['payments'] as $payments): ?>
                <tr>

                  <td><?= htmlspecialchars($payments->OrderID) ?></td>
                  <td><?= htmlspecialchars($payments->patientName) ?></td>
                  <td><?= htmlspecialchars($payments->date) ?></td>
                  <td><?= htmlspecialchars($payments->paymentMethod) ?></td>
                  <td><?= htmlspecialchars($payments->totalBill) ?></td>
                  <td><?php
                      $orderModel = new MedicineOrder();
                      $status = $orderModel->getStatusName($payments->status);
                      echo $status;
                      ?></td>


                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" style="text-align: center;">No Payments Received</td>
              </tr>
            <?php endif; ?>


          </tbody>
        </table>
      </div>


    </section>

    <script>
      const stockLevel = <?= json_encode([$stockLevels]) ?>;
      console.log(stockLevel);
    </script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/dashboardPage.js"></script>






</body>

</html>