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
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/OrderView.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/table.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/navbar.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/component/sidebar.css">
  <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
      <h2>Order Management &nbsp; &#8250; &nbsp;</h2>
      <div class="ongoing">
        Create Order
      </div>

      <div class="order-body">
        <div class="order-content">
          <!-- Left Section -->
          <div class="left-section">
            <p class="patient">Requested Medicines</p>
            <div class="prescription">
              <div class="details">





              </div>
              <!-- <div class="image-preview">
                  <img src="<?= ROOT ?>/assets/images/prescription2.jpg" alt="Prescription Image" onclick="showImage(this)">
                </div> -->
            </div>
          </div>

          <!-- Right Section -->

        </div>



        <!-- Table Section -->
        <div class="table-section">


        </div>
      </div>





    </div>
    <!-- </div> -->

    <div class="right-section">
      <div class="chat-box">
        <div class="orderStatus">
          <label for="status">Order Status:</label>
          <div class="selectWrapper">
            <select id="status" class="statusSelect">
              <option value="waiting">Waiting</option>
              <option value="processing">Processing</option>
              <option value="shipped">Shipped</option>
              <option value="delivered">Delivered</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>
        </div>

        <div class="id">
          <div class="idleft">
            <div class="input-group">
              <label>Patient ID</label>
              <input type="text" placeholder="Value" value="" disabled>
            </div>
            <div class="input-group">
              <label>Order ID</label>
              <input type="text" placeholder="Value" value="" disabled>
            </div>
          </div>
          <div class="idright">
            <div class="chaticon">
              <i class="fas fa-comment-alt"></i>

            </div>
            <span class="notification-badge">1</span>
          </div>
        </div>
        <!-- Sample chat messages -->
        <div class="chat-messages">
          <div class="display-area" id="displayArea">
            <!-- <p>Click an image to enlarge it here</p> -->
            <img src="<?= ROOT ?>/assets/images/prescription2.jpg" alt="">
          </div>
        </div>
      </div>
      <div class="submit-section">
        <?php if ($viewOnly) { ?>
          <button class="edit-order">
            <a href="<?= ROOT ?>/order/edit/" style="text-decoration: none; color:black;">
              Edit Order
            </a>
          </button>
          </form>
          <button class="delete-order">Confirm Order</button>
        <?php } else {  ?>
          <button class="delete-order">
            <a href="<?= ROOT ?>/order/<?= $order->OrderID ?>" style="text-decoration: none; color:white;">
              Cancel
            </a>
          </button>

        <?php } ?>

      </div>
    </div>
    <!-- </div> -->

    <script src="<?= ROOT ?>/assets/js/pharmacy/orderCreate.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderMain.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderView.js"></script>







</body>

</html>