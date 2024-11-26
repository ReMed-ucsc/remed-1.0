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

    <div class="Order-page">
      <div class="overlay">
        <div class="order-container">
          <div class="order-header">
            <h1>Order Management &nbsp; &#8250; &nbsp; View order</h1>
          </div>
          <div class="order-body">
            <div class="order-content">
              <!-- Left Section -->
              <div class="left-section">
                <div class="id">
                  <div class="input-group">
                    <label>Patient ID</label>
                    <input type="text" placeholder="Value" value="<?= htmlspecialchars($order->PatientID) ?>" disabled>
                  </div>
                  <div class="input-group">
                    <label>Order ID</label>
                    <input type="text" placeholder="Value" value="<?= htmlspecialchars($order->OrderID) ?>" disabled>
                  </div>
                </div>
                <div class="prescription">
                  <div class="details">
                    <?php foreach ($medicineList as $medicine): ?>
                      <p><?= htmlspecialchars($medicine->ProductName) ?></p>
                    <?php endforeach; ?>

                  </div>
                  <div class="image-preview">
                    <img src="<?= ROOT ?>/assets/images/prescription2.jpg" alt="Prescription Image" onclick="showImage(this)">
                  </div>
                </div>
              </div>

              <!-- Right Section -->

            </div>

            <!-- <?php show($order) ?> -->
            <!-- Table Section -->
            <div class="table-section">
              <?php if (!$viewOnly) { ?>
                <div class="search-bar">
                  <input type="text" placeholder="Search by medicine or generic name...">
                  <button>Add</button>
                </div>
              <?php } ?>

              <table class="order-table">
                <thead>
                  <tr>
                    <th style="width: 5%;">Medicine Name</th>
                    <th style="width: 5%;">Generic Name</th>
                    <th style="width: 5%;">Brand Name</th>
                    <th style="width: 1%;">Dosage</th>
                    <th style="width: 1%;">Quantity</th>
                    <th style="width: 5%;">Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($medicineList as $medicine): ?>
                    <tr>
                      <td><?= htmlspecialchars($medicine->ProductName) ?></td>
                      <td><?= htmlspecialchars($medicine->genericName) ?></td>
                      <td><?= htmlspecialchars($medicine->ManufactureName) ?> </td>
                      <td>
                        <?= htmlspecialchars($medicine->strength) ?>
                        <!-- <div class="dropdown-container">
                          <select class="custom-select" <?php echo ($viewOnly ? 'disabled' : '') ?>>
                            <option value="" disabled selected>Choose an option</option>
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                          </select>
                          <i class="dropdown-icon">▼</i>
                        </div> -->
                      </td>
                      <td><input type="number" name="quantity" class="short-input" value="<?= htmlspecialchars($medicine->quantity) ?>"></td>
                      <td>
                        <?php
                        $quantity = $_POST['quantity'][$medicine->ProductID] ?? 0;
                        $price = $quantity * $medicine->unitPrice;
                        echo number_format($price, 2);
                        ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>

                </tbody>
              </table>
              <p class="total-price">Total price</p>
            </div>

            <!-- Submit Button -->
            <div class="submit-section">
              <?php if ($viewOnly) { ?>

                <button class="edit-order">
                  <a href="<?= ROOT ?>/order/edit/<?= $order->OrderID ?>" style="text-decoration: none; color:white;">
                    Edit Order
                  </a></button>
                <button class="delete-order">Delete Order</button>
              <?php } else {  ?>
                <button class="delete-order">
                  <a href="<?= ROOT ?>/order/<?= $order->OrderID ?>" style="text-decoration: none; color:white;">
                    Cancel
                  </a>
                </button>
                <button class="edit-order">
                  <a href="<?= ROOT ?>/order/<?= $order->OrderID ?>" style="text-decoration: none; color:white;">
                    Update
                  </a></button>
              <?php } ?>

            </div>
          </div>
        </div>

        <div class="right-section">
          <div class="chat-box">
            <h3>Messages</h3>
            <!-- Sample chat messages -->
            <div class="chat-messages">
              <div class="display-area" id="displayArea">
                <p>Click an image to enlarge it here</p>
              </div>
            </div>
          </div>
        </div>


      </div>



      <script src="<?= ROOT ?>/assets/js/pharmacy/orderCreate.js"></script>
      <script src="<?= ROOT ?>/assets/js/pharmacy/orderMain.js"></script>




    </div>


</body>

</html>