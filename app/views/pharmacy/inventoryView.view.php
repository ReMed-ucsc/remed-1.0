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
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/OrderCreate.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/inventory.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/navbar.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/table.css">
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
  </header>

  <div class="fullpage">

    <?php include(BASE_PATH . '/app/views/inc/pharmacy/sidebar.php'); ?>

    <!-- <div class="Order-page"> -->
    <!-- <div class="right"> -->
    <div class="main-content">
      <h2>Inventory Management &nbsp; &#8250; &nbsp;</h2>
      <div class="ongoing">
        View Inventory
      </div>
      <div class="order-body">



        <div class="inventoryDetails size1">
          <div class="left">
            <ul>
              <li>Medicine Name</li>
              <li>Brand Name</li>
              <li>Generic Name</li>
              <li>Category</li>
              <li>Batch No</li>
              <li>Stock Quantity</li>
              <li>Reorder Level</li>
              <li>Storage Location</li>
              <li>Manufacturing Date</li>
              <li>Expiry Date</li>
              <li>Storage Conditions</li>
              <li>Purchase Price</li>
              <li>Selling Price</li>
            </ul>
          </div>

          <div class="right">
            <ul>

              <li><input type="text" placeholder="Auto" value="<?= htmlspecialchars($inventory->ProductName) ?>" disabled></li>
              <li><input type="text" placeholder="Auto" value="<?= htmlspecialchars($inventory->Manufacturer) ?>" disabled></li>
              <li><input type="text" placeholder="Auto" value="<?= htmlspecialchars($inventory->genericName) ?>" disabled></li>
              <li><input type="text" placeholder="Auto" value="<?= htmlspecialchars($inventory->category) ?>" disabled></li>
              <li><input type="text" value="<?= htmlspecialchars($inventory->batchNumber) ?>" placeholder=" Auto" disabled></li>
              <li><input type="number" value="<?= htmlspecialchars($inventory->availableCount) ?>" placeholder=" Enter quantity"></li>
              <li><input type="text" value="<?= htmlspecialchars($inventory->thresholdLimit) ?>" placeholder="Suggest"></li>
              <li><input type="text" value="<?= htmlspecialchars($inventory->storageLocation) ?>" placeholder="Search and Select"></li>
              <li><input type="date" value="<?= date('Y-m-d', strtotime($inventory->manufacturingDate)) ?>"></li>
              <li><input type="date" value="<?= date('Y-m-d', strtotime($inventory->expiryDate)) ?>"></li>
              <li><input type="text" value="<?= htmlspecialchars($inventory->storageConditions) ?>" placeholder="Optional" disabled></li>
              <li><input type="number" value="<?= htmlspecialchars($inventory->purchaseCost) ?>" disabled></li>
              <li><input type="number" value="<?= htmlspecialchars($inventory->SellingPrice) ?>"></li>

            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- </div> -->

    <div class="right-section">
      <div class="chat-box">
        <div class="id">
          <div class="input-group">
            <label>Batch ID</label>
            <input type="text" placeholder="Value" value="<?= htmlspecialchars($inventory->batchNumber) ?>" disabled>
          </div>

        </div>
        <div class="chat-messages">
          <div class="display-area" id="displayArea">
            <!-- <img src="<?= ROOT ?>/assets/images/prescription2.jpg" alt=""> -->
            <div class="upload">
              <label for="fileUpload" class="customUpload">Upload Invoice</label>
              <input type="file" id="fileUpload">
            </div>


          </div>
        </div>
      </div>
      <div class="submit-section">


        <button class="proceed">
          <a href="<?= ROOT ?>/order/edit" style="text-decoration: none; color:black;">
            Edit
          </a>
        </button>


      </div>
    </div>
    <!-- </div> -->

    <script src="<?= ROOT ?>/assets/js/pharmacy/orderCreate.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderMain.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderView.js"></script>





  </div>

</body>

</html>