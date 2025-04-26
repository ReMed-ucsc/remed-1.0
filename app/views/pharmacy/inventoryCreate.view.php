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
    // $isRegisteredUser = isset($_SESSION['user']);  // Check if user is logged in

    include BASE_PATH . '/app/views/inc/pharmacy/regNavbar.php';

    ?>



    <!-- Sidebar (initially hidden) -->



  </header>

  <div class="fullpage">

    <?php include(BASE_PATH . '/app/views/inc/pharmacy/sidebar.php'); ?>

    <!-- <div class="Order-page"> -->
    <!-- <div class="right"> -->
    <div class="main-content">
      <h2>Inventory Management &nbsp; &#8250; &nbsp;</h2>
      <div class="ongoing">
        Add to Inventory
      </div>
      <div class="order-body">
        <form id="inventoryForm" action="<?php echo ROOT; ?>/inventoryCreate/addItem" method="POST">
          <div class="inventoryDetails size1">
            <div class="left">
              <ul>
                <li>Medicine Name</li>
                <!-- <li>Brand Name</li>
                <li>Generic Name</li>
                <li>Category</li> -->
                <li>Batch No</li>
                <li>Stock Quantity</li>
                <li>Reorder Level</li>
                <li>Storage Location</li>
                <li>Manufacturing Date</li>
                <li>Expiry Date</li>
                <li>Purchase Date</li>
                <li>Storage Conditions</li>
                <li>Purchase Price</li>
                <li>Selling Price</li>
              </ul>
            </div>

            <div class="right">
              <ul>
                <input type="hidden" id="medicine-id" name="productId" value="" />
                <li><input type="text" id="productName" name="productName" placeholder="Auto"></li>
                <div id="search-results" class="search-results"></div>
                <!-- <li><input type="text" id="manufacturer" name="manufacturer" placeholder="Auto"></li>
                <li><input type="text" id="genericName" name="genericName" placeholder="Auto"></li>
                <li>
                  <select id="category" name="category">
                    <option value="Over the Counter">Over the Counter</option>
                    <option value="Prescription">Prescription</option>
                    <option value="Supplement">Supplement</option>
                  </select>
                </li> -->
                <li><input type="text" name="batchID" placeholder="Auto"></li>
                <li><input type="number" name="stockQuantity" placeholder="Enter quantity"></li>
                <li><input type="text" name="thresholdLimit" placeholder="Suggest"></li>
                <li><input type="text" name="storageLocation" placeholder="Search and Select"></li>
                <li><input type="date" name="manufacturingDate"></li>
                <li><input type="date" name="expiryDate"></li>
                <li><input type="date" name="purchaseDate"></li>
                <li><input type="text" name="storageCondition" placeholder="Optional"></li>
                <li><input type="text" name="purchasePrice"></li>
                <li><input type="text" id="unitPrice" name="sellingPrice"></li>
              </ul>
            </div>
          </div>

          <!-- <div class="submit-section">
          <button type="submit">Add to Inventory</button>
        </div> -->





      </div>
    </div>

    <!-- </div> -->

    <div class="right-section">
      <div class="chat-box">
        <!-- <div class="id">
          <div class="input-group">
            <label>Stock ID</label>
            <input type="text" placeholder="Value" value="" disabled>
          </div>
          <div class="input-group">
            <label>Invoice ID</label>
            <input type="text" placeholder="Value" value="" disabled>
          </div>
        </div> -->
        <!-- Sample chat messages -->
        <div class="chat-messages">
          <div class="display-area" id="displayArea">
            <!-- <p>Click an image to enlarge it here</p> -->
            <!-- <img src="<?= ROOT ?>/assets/images/prescription2.jpg" alt=""> -->
            <!-- <div class="upload">
              <label for="fileUpload" class="customUpload">Upload Invoice</label>
              <input type="file" id="fileUpload">
            </div> -->


          </div>
        </div>
      </div>
      <div class="submit-section">


        <button id="addInventoryBtn" class="proceed" type="submit">
          Add to Inventory
        </button>
        </form>

      </div>
    </div>
    <!-- </div> -->

    <script>
      const pharmacyId = <?= $_SESSION['user_id'] ?>;
      console.log(pharmacyId)
    </script>
    <!-- <script src="<?= ROOT ?>/assets/js/pharmacy/orderView.js"></script> -->
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderMain.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderView.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/inventory.js"></script>





  </div>

</body>

</html>