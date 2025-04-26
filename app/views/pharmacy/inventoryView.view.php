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

<body data-user-id="<?php echo $_SESSION['user_id'] ?? ''; ?>">

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
      <div class="upper">
        <div class="upper-left">
          <h2>Inventory Management &nbsp; &#8250; &nbsp;</h2>
          <div class="ongoing">
            View Inventory
          </div>
        </div>
        <div class="upper-right">
          <div>
            <button class="add-stock"><a href="<?= ROOT ?>/inventoryRefill/<?= $inventory->InventoryId ?>">
                New Stock</a></button>
          </div>
        </div>

      </div>

      <div class="order-body">


        <form id="inventoryForm" method="POST" action="<?= ROOT ?>/inventoryView/edit/<?= $inventory->InventoryId ?>">
          <div class="inventoryDetails size1">
            <div class="left">
              <ul>
                <li>Medicine Name</li>
                <li>Brand Name</li>
                <li>Generic Name</li>
                <li>Category</li>
                <li>Last Batch No</li>
                <li>Stock Quantity</li>
                <li>Reorder Level</li>
                <li>Storage Location</li>
                <li>Manufacturing Date</li>
                <li>Expiry Date</li>
                <li>Storage Conditions</li>
                <li>Purchase Price</li>
                <li>Unit Price</li>
              </ul>
            </div>

            <div class="right">
              <ul>

                <li><input type="text" name="productName" placeholder="Auto" value="<?= htmlspecialchars($inventory->ProductName) ?>" disabled></li>
                <li><input type="text" name="manufacturer" placeholder="Auto" value="<?= htmlspecialchars($inventory->Manufacturer) ?>" disabled></li>
                <li><input type="text" name="genericName" placeholder="Auto" value="<?= htmlspecialchars($inventory->genericName) ?>" disabled></li>
                <li><input type="text" name="category" placeholder="Auto" value="<?= htmlspecialchars($inventory->category) ?>" disabled></li>
                <li><input type="text" name="batchNumber" value="<?= htmlspecialchars($inventory->batchNumber) ?>" placeholder="Auto" disabled></li>
                <li><input type="number" name="availableCount" value="<?= htmlspecialchars($inventory->availableCount) ?>" placeholder="" disabled></li>
                <li><input type="text" name="thresholdLimit" value="<?= htmlspecialchars($inventory->thresholdLimit) ?>" placeholder="20"></li>
                <li><input type="text" name="storageLocation" value="<?= htmlspecialchars($inventory->storageLocation) ?>" placeholder=""></li>
                <li><input type="date" name="manufacturingDate" value="<?= date('Y-m-d', strtotime($inventory->manufacturingDate)) ?>" disabled></li>
                <li><input type="date" name="expiryDate" value="<?= date('Y-m-d', strtotime($inventory->expiryDate)) ?>" disabled></li>
                <li><input type="text" name="storageConditions" value="<?= htmlspecialchars($inventory->storageConditions) ?>" placeholder="Optional"></li>
                <!-- <?php
                      $unitCost = (($inventory->availableCount) - ($inventory->LastStockQuantity)) > 0
                        ? $inventory->purchaseCost / ($inventory->availableCount - $inventory->LastStockQuantity)
                        : 0;
                      ?> -->
                <li><input type="number" name="purchaseCost" value="<?= htmlspecialchars($inventory->purchaseCost) ?>" disabled></li>
                <li><input type="number" name="sellingPrice" value="<?= htmlspecialchars($inventory->SellingPrice) ?>"></li>

              </ul>
            </div>
          </div>
          <!-- </form> -->
      </div>
    </div>

    <!-- </div> -->

    <div class="right-section">
      <div class="chat-box">
        <div class="id">
          <div class="input-group">
            <label>Inventory ID</label>
            <input type="text" placeholder="Value" value="<?= htmlspecialchars($inventory->InventoryId) ?>" disabled>
          </div>
        </div>
        <div class="chat-messages">
          <div class="display-area" id="displayArea">
            <h3>Stock Purchase History</h3>
            <div class="stock-history">
              <?php if (!empty($historyList)): ?>
                <?php foreach ($historyList as $row): ?>
                  <!-- <pre><?php print_r($List); ?></pre> -->


                  <p><?= htmlspecialchars($row->purchaseDate) ?></p>


                <?php endforeach; ?>
              <?php else: ?>

                No purchase history found.

              <?php endif; ?>
            </div>
          </div>
        </div>

      </div>
      <div class="submit-section">
        <button type="submit" class="proceed">
          <!-- <a href="<?= ROOT ?>/inventoryView/edit/<?= $inventory->InventoryId ?>" style="text-decoration: none; color:black;"> -->
          Update
          <!-- </a> -->
        </button>
        </form>
      </div>
    </div>
    <!-- </div> -->

    <script src="<?= ROOT ?>/assets/js/pharmacy/orderCreate.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderMain.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/orderView.js"></script>





  </div>

</body>

</html>