<?php
// session_start();
// if (!isset($_SESSION['user'])) {
//     // Redirect to login page if user is not logged in
//     header("Location: login.php");
//     exit();
// }
?>



<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ReMed Dashboard</title>
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/orderView.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/navbar.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/component/sidebar.css">
  <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <script>
    const statusOptions = <?= json_encode($statusOptions) ?>;
  </script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body data-user-id="<?php echo $_SESSION['user_id'] ?? ''; ?>">

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
    <div class="overlay">
      <div class="order-container">
        <div class="order-header">
          <h1>Order Management &nbsp; &#8250; &nbsp; View order</h1>

          <!-- <?php show(ROOT . '/uploads/prescriptions/' . $order->prescription) ?> -->

        </div>
        <div class="order-body">
          <div class="order-content">
            <!-- Left Section -->
            <div class="left-section">
              <p class="patient">Requested Medicines</p>
              <div class="prescription">
                <div class="details">
                  <?php foreach ($medicineList as $medicine): ?>
                    <div class="medicine-item"><?= htmlspecialchars($medicine->ProductName) ?></div>
                  <?php endforeach; ?>

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

          <?php if (!$viewOnly) { ?>
            <div class="search-bar">
              <form action="<?= ROOT ?>/order/addItem/<?= $order->OrderID ?>" method="post">
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

            <?php $tot = 0; ?>
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
                    <th style="<?php echo ($viewOnly ? 'display:none;' : '') ?> width: 5%; ">Action</th>
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

                      </td>
                      <td>
                        <form action="<?= ROOT ?>/order/edit/<?= $order->OrderID ?>" method="post">
                          <input type="hidden" id="medicine-id" name="productId" value="<?= htmlspecialchars($medicine->ProductID) ?>" />
                          <input type="number" name="quantity" class="short-input" value="<?= htmlspecialchars($medicine->quantity) ?>" min="1" <?php echo ($viewOnly ? 'disabled' : '') ?>>
                      </td>
                      <td>
                        <?php
                        $quantity = $medicine->quantity ?? 0; //changed unitPrice to qunatity here
                        $price = $quantity * $medicine->unitPrice;
                        $tot = $tot + $price;
                        echo number_format($price, 2);
                        ?>
                      </td>
                      <?php if (!$viewOnly): ?>
                        <td>
                          <div class="button-container">
                            <button type="submit" name="update" class="image-button" value="<?= htmlspecialchars($medicine->ProductID) ?> ">
                              <img src="<?= ROOT ?>/assets/images/edit.PNG" alt="edit">
                            </button>
                            </form>
                            <form action="<?= ROOT ?>/order/deleteItem/<?= $order->OrderID ?>" method="post">
                              <button type="submit" name="delete" class="image-button" value="<?= htmlspecialchars($medicine->ProductID) ?>">
                                <img src="<?= ROOT ?>/assets/images/delete.PNG" alt="delete">
                              </button>
                            </form>
                          </div>
                        </td>
                      <?php endif; ?>

                    </tr>
                  <?php endforeach; ?>

                </tbody>
              </table>
              <div class="price">
                <p class="total-price">Total price = </p>
                <p class="total-price"><?php echo number_format($tot, 2);
                                        ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>




    </div>
    <!-- </div> -->

    <div class="right-section">
      <div class="chat-box">
        <div class="orderStatus">

          <!-- style should change here -->

          <label for="status">Order Status:</label>
          <div class="orderStatus-input"> <?= htmlspecialchars($status) ?></div>

          <!-- <div class="selectWrapper">
            <select id="status" class="statusSelect">
              <?php foreach ($statusList as $key => $value): ?>
                <option value="<?= htmlspecialchars($key) ?>" <?= ($key == $order->status) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($value) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div> -->

        </div>

        <div class="id">
          <div class="idleft">
            <div class="input-group">
              <label>Patient ID</label>
              <input type="text" placeholder="Value" value="<?= htmlspecialchars($order->PatientID) ?>" disabled>
            </div>
            <div class="input-group">
              <label>Order ID</label>
              <input type="text" placeholder="Value" value="<?= htmlspecialchars($order->OrderID) ?>" disabled>
            </div>
          </div>
          <div class="idright">
            <div class="chaticon" id="chatIcon">
              <i class="fas fa-comment-alt"></i>

            </div>
            <span class="notification-badge">1</span>
          </div>
        </div>
        <!-- Sample chat messages -->
        <div class="chat-messages">
          <div class="display-area" id="displayArea">
            <div id="prescriptionView">
              <?php if (!empty($order->prescription)) : ?>
                <img src="<?= ROOT . '/uploads/prescriptions/' . $order->prescription ?>" alt="Prescription">
              <?php else : ?>
                <p>No prescription uploaded.</p>
              <?php endif; ?>
            </div>


            <div id="chatView" style="display: none;">
              <div class="chat-box-content" id="chatMessages">
                <!-- Chat messages will appear here -->
              </div>
              <div class="chat-input">
                <input type="text" id="chatInput" placeholder="Type your message...">
                <button id="sendBtn">Send</button>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="submit-section">
        <div class="button-container">

          <?php if (isset($data['order']) && $data['order']->status == 'W') { ?>

            <!-- style should change here -->

            <button class="edit-order">
              <a href="<?= ROOT ?>/order/updateOrderStatus/<?= $order->OrderID ?>/P" style="text-decoration: none; color:black;">
                Proceed
              </a>
            </button>

          <?php } else if (isset($data['order']) && $data['order']->status == 'P') {  ?>

            <?php if ($viewOnly) { ?>
              <button class="edit-order">
                <a href="<?= ROOT ?>/order/edit/<?= $order->OrderID ?>" style="text-decoration: none; color:black;">
                  Edit Order
                </a>
              </button>
              </form>

              <button class="edit-order">
                <a href="<?= ROOT ?>/order/updateOrderStatus/<?= $order->OrderID ?>/Q" style="text-decoration: none; color:black;">
                  Send Quotation
                </a>
              </button>
              <!-- <button class="delete-order" onclick=handleOrderConfirm()>
                Confirm Order
              </button> -->

              <form id="confirmForm" method="POST" action="<?= ROOT ?>/Order/confirmOrder/<?= $order->OrderID ?>" style="display:none;">
                <input type="hidden" name="orderId" , value="<?= $order->OrderID ?>">
              </form>



            <?php } else {  ?>
              <button class="edit-order">
                <a href="<?= ROOT ?>/order/updateOrderStatus/<?= $order->OrderID ?>/Q" style="text-decoration: none; color:black;">
                  Send Quotation
                </a>
              </button>

            <?php
            }
          } else if (isset($data['order']) && $data['order']->status == 'A' && !$order->pickup) {
            if ($order->paymentReceived) {
            ?>


              <button class="edit-order">
                <a href="<?= ROOT ?>/order/updateOrderStatus/<?= $order->OrderID ?>/WP" style="text-decoration: none; color:black;">
                  Send for delivery
                </a>
              </button>
            <?php
            } else { ?>

              <!-- style should change here -->

              <p class="paymentWaiting">Waiting for payment Completion...</p>
          <?php
            }
          }
          ?>
        </div>

      </div>
    </div>
    <!-- </div> -->


    <script>
      function handleOrderConfirm() {
        if (confirm("Are you sure you want to confirm the order")) {
          document.getElementById("confirmForm").submit();
        }
      }
    </script>
    <script>
      const pharmacyId = <?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null' ?>;
      const API_URL = "<?= API_URL ?>";
      const orderData = <?= json_encode([
                          'order' => $data['order'],
                          'medicineList' => $data['medicineList'],
                          'comments' => $data['comments'],
                          'viewOnly' => $data['viewOnly'] ?? false,
                          'authToken' => $_SESSION['auth_token'] ?? ''
                        ]) ?>;
    </script>

    <script src="<?= ROOT ?>/assets/js/pharmacy/orderCreate.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderMain.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderView.js"></script>
</body>

</html>