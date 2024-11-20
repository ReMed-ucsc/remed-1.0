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
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pharmacy/Order-create.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pharmacy/navbar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/component/sidebar.css">
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

<?php include('../../Sidebar/sidebar.php'); ?>

<div class="Order-page">
  <div class="overlay">
    <div class="order-container">
        <div class="order-header">
            <h1>Inventory Management &nbsp; &#8250; &nbsp; Edit Inventory</h1>
        </div>
        <div class="order-body">
        <div class="order-content">
            <!-- Left Section -->
            <div class="left-section">
              <div class="id">
                <div class="input-group">
                    <label>Stock ID</label>
                    <input type="text" placeholder="Value">
                </div>
                <div class="input-group">
                    <label>Supplier ID</label>
                    <input type="text" placeholder="Value">
                </div>
              </div>
              <div class="prescription">
                <div class="details">
                    <p>Special notes</p>
                    <input type="text">
                    
                </div>
                <div class="image-preview">
                  <input type="file">
                </div>
                
              </div>
            </div>

            <!-- Right Section -->
            
        </div>

        <!-- Table Section -->
        <div class="table-section">
            <div class="search-bar">
                <input type="text" placeholder="Search by medicine or generic name...">
                <button>Add</button>
            </div>
            <table class= "order-table">
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
    <td>BATCH-001</td> <!-- Batch ID -->
    <td>Paracetamol</td> <!-- Generic Name -->
    <td>Panadol</td> <!-- Medicine Name -->
    <td>ITEM-12345</td> <!-- Item Code -->
    <td>Pain Relief</td> <!-- Category -->
    <td>$10.00</td> <!-- Unit Price -->
    <td>SUP-456</td> <!-- Supplier ID -->
    <td>2025-06-15</td> <!-- Expiration Date -->
    <td>50</td> <!-- Reorder Level -->
    <td>In Stock</td> <!-- Status -->
</tr>
<tr>
    <td>BATCH-002</td> <!-- Batch ID -->
    <td>Ibuprofen</td> <!-- Generic Name -->
    <td>Advil</td> <!-- Medicine Name -->
    <td>ITEM-67890</td> <!-- Item Code -->
    <td>Pain Relief</td> <!-- Category -->
    <td>$12.50</td> <!-- Unit Price -->
    <td>SUP-789</td> <!-- Supplier ID -->
    <td>2024-12-10</td> <!-- Expiration Date -->
    <td>30</td> <!-- Reorder Level -->
    <td>Low Stock</td> <!-- Status -->
</tr>
<tr>
    <td>BATCH-003</td> <!-- Batch ID -->
    <td>Vitamin C</td> <!-- Generic Name -->
    <td>Citrohealth</td> <!-- Medicine Name -->
    <td>ITEM-54321</td> <!-- Item Code -->
    <td>Supplements</td> <!-- Category -->
    <td>$5.00</td> <!-- Unit Price -->
    <td>SUP-123</td> <!-- Supplier ID -->
    <td>2026-02-20</td> <!-- Expiration Date -->
    <td>100</td> <!-- Reorder Level -->
    <td>In Stock</td> <!-- Status -->
</tr>
<tr>
    <td>BATCH-004</td> <!-- Batch ID -->
    <td>Amoxicillin</td> <!-- Generic Name -->
    <td>Amoxil</td> <!-- Medicine Name -->
    <td>ITEM-98765</td> <!-- Item Code -->
    <td>Antibiotics</td> <!-- Category -->
    <td>$8.00</td> <!-- Unit Price -->
    <td>SUP-456</td> <!-- Supplier ID -->
    <td>2025-08-15</td> <!-- Expiration Date -->
    <td>20</td> <!-- Reorder Level -->
    <td>Out of Stock</td> <!-- Status -->
</tr>
<tr>
    <td>BATCH-005</td> <!-- Batch ID -->
    <td>Calcium</td> <!-- Generic Name -->
    <td>Caltrate</td> <!-- Medicine Name -->
    <td>ITEM-24680</td> <!-- Item Code -->
    <td>Supplements</td> <!-- Category -->
    <td>$15.00</td> <!-- Unit Price -->
    <td>SUP-789</td> <!-- Supplier ID -->
    <td>2026-07-01</td> <!-- Expiration Date -->
    <td>60</td> <!-- Reorder Level -->
    <td>In Stock</td> <!-- Status -->
</tr>

                </tbody>
            </table>
            <p class="total-price">Total price</p>
        </div>

        <!-- Submit Button -->
        <div class="submit-section">
            <button class="send-pdf">Save Stock</button>
        </div>
      </div>
    </div>

    <!-- <div class="right-section">
                <div class="chat-box">
                    <h3>Messages</h3>
                    
                    <div class="chat-messages">
                        <div class="display-area" id="displayArea">
                          <p>Click an image to enlarge it here</p>
                        </div>
                    </div>
                </div>
            </div> -->


    </div>

<div class="background">
  <div class="main-content">
    <h2>Orders</h2>
    <div class="search-container">
        <input type="text" placeholder="Search here" class="search-bar">
        <button class="search"><i class="icon ph-bold ph-magnifying-glass"></i>
        </button>
    </div>

    <div class="ongoing">Ongoing Orders</div>

    <section class="order-management">
      
    
      <table class="order-table">
        <thead>
          <tr>
            <th style="width: 7%;">Order ID</th>
            <th style="width: 7%;">Patient ID</th>
            <th style="width: 20%;">Delivery Address</th>
            <th style="width: 5%;">Date</th>
            <th style="width: 10%;">Payment</th>
            <th style="width: 5%;">Type</th>
            <th style="width: 5%;">Status</th>
            <th style="width: 5%;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#564564</td>
            <td>DEF456</td>
            <td>250 River Dr, TX</td>
            <td>31/08/2024</td>
            <td>$67.99</td>
            <td>Cash on Delivery</td>
            <td><span class="status pending">Pending</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#324562</td>
            <td>XYZ789</td>
            <td>123 Oak St, FL</td>
            <td>25/08/2024</td>
            <td>$100.99</td>
            <td>Transfer</td>
            <td><span class="status canceled">Canceled</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#564564</td>
            <td>DEF456</td>
            <td>250 River Dr, TX</td>
            <td>31/08/2024</td>
            <td>$67.99</td>
            <td>Cash on Delivery</td>
            <td><span class="status pending">Pending</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#564564</td>
            <td>DEF456</td>
            <td>250 River Dr, TX</td>
            <td>31/08/2024</td>
            <td>$67.99</td>
            <td>Cash on Delivery</td>
            <td><span class="status pending">Pending</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#324562</td>
            <td>XYZ789</td>
            <td>123 Oak St, FL</td>
            <td>25/08/2024</td>
            <td>$100.99</td>
            <td>Transfer</td>
            <td><span class="status canceled">Canceled</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
          <tr>
            <td>#342342</td>
            <td>ABC123</td>
            <td>432 Park Ave, NY</td>
            <td>01/09/2024</td>
            <td>$45.00</td>
            <td>PayPal</td>
            <td><span class="status success">Delivered</span></td>
            <td><a class="view" href="#">View</a></td>
          </tr>
        </tbody>
      </table>
      
        <button class="new-order-btn"><i class="ph-bold ph-plus"></i>
        <p class="new-order">New Order</p></button>
      
    </section>
    

  </div>
</div>

<script src="<?=ROOT?>/assets/js/pharmacy/orderCreate.js"></script>
<script src="<?=ROOT?>/assets/js/pharmacy/orderMain.js"></script>
<script src="<?=ROOT?>/assets/js/pharmacy/sidebar.js"></script>



</div>


</body>
</html>
