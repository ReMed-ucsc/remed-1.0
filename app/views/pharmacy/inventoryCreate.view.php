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
    <div class="overlay">
      <div class="order-container">
        <div class="order-header">
          <h1>Inventory Management &nbsp; &#8250; &nbsp; Add Inventory</h1>
        </div>
        <div class="order-body">
          <div class="order-content">
            <!-- Left Section -->
            <div class="left-section">
              <div class="id">
                <!-- <div class="input-group">
                  <label>Stock ID</label>
                  <input type="text" placeholder="Value">
                </div>
                <div class="input-group">
                  <label>Supplier ID</label>
                  <input type="text" placeholder="Value">
                </div> -->
              </div>
              <div class="prescription">
                <div class="details">
                  <p>Special notes</p>
                  <input type="text">

                </div>
                <!-- <div class="image-preview">
                  <input type="file">
                </div> -->

              </div>
            </div>

            <!-- Right Section -->

          </div>

          <div class="search-bar">
            <form action="<?= ROOT ?>/order/addItem" method="post">
              <input type="hidden" id="medicine-id" name="medicineId" value="" />
              <input type="text" id="medicine-search" placeholder="Search by medicine or generic name..." />
              <input type="text" id="medicine-quantity" name="quantity" placeholder="Quantity" />
              <button id="add-medicine">Add</button>
            </form>
          </div>
          <div id="search-results" class="search-results"></div>

          <!-- Table Section -->
          <section class="table-management">

            <div class="table">
              <table>
                <thead>
                  <tr>
                    <th style="width: 5%;">Item ID</th>
                    <th style="width: 5%;">Brand Name</th>
                    <th style="width: 5%;">Generic Name</th>
                    <th style="width: 1%;">Medicine Name</th>
                    <th style="width: 1%;">Batch Number</th>
                    <th style="width: 5%;">Unit Price</th>
                    <th style="width: 5%;">Supplier ID</th>
                    <th style="width: 5%;">Expiration Date</th>
                    <th style="width: 5%;">Reorder Level</th>
                    <th style="width: 5%;">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>BATCH-001</td>
                    <td>Paracetamol</td>
                    <td>Panadol</td>
                    <td>ITEM-12345</td>
                    <td>Pain Relief</td>
                    <td>$10.00</td>
                    <td>SUP-456</td>
                    <td>2025-06-15</td>
                    <td>50</td>
                    <td>In Stock</td>
                  </tr>
                  <tr>
                    <td>BATCH-002</td>
                    <td>Ibuprofen</td>
                    <td>Advil</td>
                    <td>ITEM-67890</td>
                    <td>Pain Relief</td>
                    <td>$12.50</td>
                    <td>SUP-789</td>
                    <td>2024-12-10</td>
                    <td>30</td>
                    <td>Low Stock</td>
                  </tr>
                  <tr>
                    <td>BATCH-003</td>
                    <td>Vitamin C</td>
                    <td>Citrohealth</td>
                    <td>ITEM-54321</td>
                    <td>Supplements</td>
                    <td>$5.00</td>
                    <td>SUP-123</td>
                    <td>2026-02-20</td>
                    <td>100</td>
                    <td>In Stock</td>
                  </tr>
                  <tr>
                    <td>BATCH-004</td>
                    <td>Amoxicillin</td>
                    <td>Amoxil</td>
                    <td>ITEM-98765</td>
                    <td>Antibiotics</td>
                    <td>$8.00</td>
                    <td>SUP-456</td>
                    <td>2025-08-15</td>
                    <td>20</td>
                    <td>Out of Stock</td>
                  </tr>
                  <tr>
                    <td>BATCH-005</td>
                    <td>Calcium</td>
                    <td>Caltrate</td>
                    <td>ITEM-24680</td>
                    <td>Supplements</td>
                    <td>$15.00</td>
                    <td>SUP-789</td>
                    <td>2026-07-01</td>
                    <td>60</td>
                    <td>In Stock</td>
                  </tr>

                </tbody>
              </table>
            </div>
            <p class="total-price">Total price = Rs.0.00</p>
          </section>

          <!-- Submit Button -->

        </div>
      </div>



    </div>



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
            <img src="<?= ROOT ?>/assets/images/prescription2.jpg" alt="">
          </div>
        </div>
      </div>
      <div class="submit-section">
        <!-- <?php if ($viewOnly) { ?> -->
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

      <?php } ?>

      </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/pharmacy/orderCreate.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderMain.js"></script>




  </div>


</body>

</html>