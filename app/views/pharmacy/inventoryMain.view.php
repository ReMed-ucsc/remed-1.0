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
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/Order-main.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/navbar.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/table.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/component/sidebar.css">
  <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body data-user-id="<?php echo $_SESSION['user_id'] ?? ''; ?>">

  <header>
    <?php


    include BASE_PATH . '/app/views/inc/pharmacy/regNavbar.php';

    ?>



    <!-- Sidebar (initially hidden) -->



  </header>

  <div class="fullpage">

    <?php include(BASE_PATH . '/app/views/inc/pharmacy/sidebar.php'); ?>


    <div class="main-content">
      <h2>Inventory</h2>
      <!-- <div class="search-container">
        <input type="text" placeholder="Search here" class="search-bar">
        <button class="search"><i class="icon ph-bold ph-magnifying-glass"></i>
        </button>
      </div> -->

      <!-- <?php show($data) ?> -->
      <div class="ongoing">Current Stock</div>

      <section class="table-management">


        <table class="table">
          <thead>
            <tr>
              <th style="width: 7%;">Inventory ID</th>
              <th style="width: 20%;">Item Name</th>
              <th style="width: 7%;">Quantity</th>
              <th style="width: 5%;">Category</th>
              <th style="width: 10%;">Expiry Date</th>
              <th style="width: 5%;">Reorder Level</th>
              <th style="width: 5%;">Status</th>
              <th style="width: 5%;"></th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($inventories)): ?>
              <?php foreach ($inventories as $inventory): ?>
                <tr>
                  <td><?= htmlspecialchars($inventory->InventoryId) ?></td>
                  <td><?= htmlspecialchars($inventory->ProductName) ?></td>
                  <td><?= htmlspecialchars($inventory->availableCount) ?></td>
                  <td><?= htmlspecialchars($inventory->category) ?></td>
                  <td><?= htmlspecialchars($inventory->expiryDate) ?></td>
                  <td><?= htmlspecialchars($inventory->thresholdLimit) ?></td>
                  <td><?php
                      if ($inventory->availableCount == 0)
                        echo 'Out of Stock';
                      elseif (($inventory->availableCount - $inventory->thresholdLimit) > 0)
                        echo 'In Stock';
                      else
                        echo 'Low Stock';
                      ?></td>
                  <td><a class="view" href="<?= ROOT ?>/inventoryView/<?= $inventory->InventoryId ?>">Update</a></td>

                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8">No Orders Found</td>
              </tr>
            <?php endif; ?>

          </tbody>
        </table>

        <button class="new-order-btn"><i class="ph-bold ph-plus"></i>
          <a href="<?= ROOT ?>/inventoryCreate" style="text-decoration: none; color:white;" class="new-order">New Stock</a>
        </button>

      </section>

    </div>

    <script src="<?= ROOT ?>/assets/js/pharmacy/Order-main.js"></script>




  </div>


</body>

</html>