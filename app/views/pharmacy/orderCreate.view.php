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

    <!-- <?php show($data) ?> -->
    <!-- <div class="Order-page"> -->
    <!-- <div class="right"> -->
    <div class="main-content">
      <h2>Order Management &nbsp; &#8250; &nbsp;</h2>
      <div class="ongoing">
        Create Order
      </div>
      <div class="order-body">
        <div class="search-bar">
          <form action="<?= ROOT ?>/orderCreate/<?= $OrderID ? "addToOrder" : "createOrder" ?>" method="post">
            <input type="hidden" id="medicine-id" name="medicineId" value="" />
            <input type="text" id="medicine-search" placeholder="Search by medicine or generic name..." />
            <input type="text" id="medicine-quantity" name="quantity" placeholder="Quantity" />
            <?php if ($OrderID) { ?>
              <input type="hidden" id="order-id" name="orderId" value="<?= $OrderID ?>" />
            <?php } ?>
            <button id="add-medicine" name="add-medicine"><?= $OrderID ? "Add" : "Create" ?></button>
          </form>
        </div>
        <div id="search-results" class="search-results"></div>

        <!-- Table Section -->
        <section class="table-management">

          <div class="table">
            <table>
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
                <?php if (!empty($data['orderItems'])): ?>
                  <?php foreach ($data['orderItems'] as $item): ?>
                    <tr>
                      <td><?= $item->ProductName ?></td>
                      <td><?= $item->genericName ?></td>
                      <td><?= $item->ManufactureName ?></td>
                      <td><?= $item->strength ?></td>
                      <td><?= $item->quantity ?></td>
                      <td>Rs.<?= number_format($item->unitPrice * $item->quantity, 2) ?></td>
                      <td>
                        <form action="<?= ROOT ?>/orderCreate/removeItem" method="post" style="display:inline;">
                          <input type="hidden" name="itemId" value="<?= $item->ProductID ?>">
                          <input type="hidden" name="orderId" value="<?= $OrderID ?>">
                          <button type="submit" class="delete-btn">Remove</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7" style="text-align: center;">No items added to order yet</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
            <!-- Price display section -->
            <div class="price">
              <p class="total-price">Total price = </p>
              <p class="total-price">Rs.<?= number_format($data['totalPrice'], 2) ?></p>
            </div>
          </div>
        </section>
      </div>
    </div>





    <!-- </div> -->

    <div class="right-section">
      <div class="chat-box">
        <div class="id">
          <div class="input-group">
            <label>Patient ID</label>
            <input type="text" placeholder="Value" value="Unregisterd User" disabled>
          </div>
          <div class="input-group">
            <label>Order ID</label>
            <input type="text" placeholder="Value" value="<?= $data['OrderID'] ?>" disabled>
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


        <?php if (isset($data['orderDetails']) && $data['orderDetails']->status == 'Q') { ?>
          Payment Method:

          <div class="button-container">
            <button class="">
              <a href="<?= ROOT ?>/orderCreate/updateOrderStatus/<?= $OrderID ?>/A/cash" style="text-decoration: none; color:black;">
                Card
              </a>
            </button>
            <button class="">
              <a href="<?= ROOT ?>/orderCreate/updateOrderStatus/<?= $OrderID ?>/A/card" style="text-decoration: none; color:black;">
                Cash
              </a>
            </button>
          <?php }   ?>

          </div>

          <?php if (isset($data['orderDetails']) && $data['orderDetails']->status == 'W') { ?>
            <button class="proceed">
              <a href="<?= ROOT ?>/orderCreate/updateOrderStatus/<?= $OrderID ?>/Q" style="text-decoration: none; color:black;">
                Proceed
              </a>
            </button>
          <?php } ?>
      </div>
    </div>
    <!-- </div> -->

    <script>
      const pharmacyId = <?= $_SESSION['user_id'] ?>;
    </script>

    <script src="<?= ROOT ?>/assets/js/pharmacy/orderView.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderCreate.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderMain.js"></script>





  </div>

</body>

</html>