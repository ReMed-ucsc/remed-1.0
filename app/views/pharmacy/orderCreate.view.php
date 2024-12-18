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
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/navbar.css">
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
    <div class="overlay">
      <div class="order-container">
        <div class="order-header">
          <h1>Order Management &nbsp; &#8250; &nbsp; Create Order</h1>
        </div>
        <div class="order-body">
          <div class="order-content">
            <!-- Left Section -->
            <div class="left-section">

              <div class="prescription">
                <div class="details">




                  <?php
                  // show($medicineList) 
                  ?>

                </div>
                <!-- <div class="image-preview">
                  <img src="<?= ROOT ?>/assets/images/prescription2.jpg" alt="Prescription Image" onclick="showImage(this)">
                </div> -->
              </div>
            </div>

            <!-- Right Section -->

          </div>

          <!-- <?php if (!$viewOnly) { ?> -->
          <div class="search-bar">
            <form action="<?= ROOT ?>/order/addItem" method="post">
              <input type="hidden" id="medicine-id" name="medicineId" value="" />
              <input type="text" id="medicine-search" placeholder="Search by medicine or generic name..." />
              <input type="text" id="medicine-quantity" name="quantity" placeholder="Quantity" />
              <button id="add-medicine">Add</button>
            </form>
          </div>
          <div id="search-results" class="search-results"></div>
        <?php } ?>

        <!-- Table Section -->
        <div class="table-section">

          <div class="table">
            <table class="order-table">
              <thead>
                <tr>
                  <th style="width: 5%;">Medicine Name</th>
                  <th style="width: 5%;">Generic Name</th>
                  <th style="width: 5%;">Brand Name</th>
                  <th style="width: 1%;">Dosage</th>
                  <th style="width: 1%;">Quantity</th>
                  <th style="width: 5%;">Price</th>
                  <th style="width: 5%; ">Action</th>
                </tr>
              </thead>
              <tbody>



              </tbody>
            </table>
            <div class="price">
              <p class="total-price">Total price = </p>
              <p class="total-price">Rs.0.00</p>
            </div>
          </div>
        </div>
        </div>
      </div>




    </div>
    <!-- </div> -->

    <div class="right-section">
      <div class="chat-box">
        <div class="id">
          <div class="input-group">
            <label>Patient ID</label>
            <input type="text" placeholder="Value" value="" disabled>
          </div>
          <div class="input-group">
            <label>Order ID</label>
            <input type="text" placeholder="Value" value="" disabled>
          </div>
        </div>
        <!-- Sample chat messages -->
        <div class="chat-messages">
          <div class="display-area" id="displayArea">
            <!-- <p>Click an image to enlarge it here</p> -->
            <!-- <img src="<?= ROOT ?>/assets/images/prescription2.jpg" alt=""> -->
            <div class="upload">
              <label for="fileUpload" class="customUpload">Upload Prescription</label>
              <input type="file" id="fileUpload">
            </div>


          </div>
        </div>
      </div>
      <div class="submit-section">
        <!-- <?php if ($viewOnly) { ?>
        <button class="edit-order">
          <a href="<?= ROOT ?>/order/edit" style="text-decoration: none; color:white;">
            Edit Order
          </a>
        </button>
        </form>
        <button class="delete-order">Delete Order</button>
      <?php } else {  ?>
        <button class="delete-order">
          <a href="<?= ROOT ?>/order/" style="text-decoration: none; color:white;">
            Cancel
          </a>
        </button>

      <?php } ?> -->

        <button class="proceed">
          <a href="<?= ROOT ?>/order/edit" style="text-decoration: none; color:black;">
            Proceed
          </a>
        </button>

      </div>
    </div>
    <!-- </div> -->

    <script src="<?= ROOT ?>/assets/js/pharmacy/orderCreate.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderMain.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderView.js"></script>







</body>

</html>