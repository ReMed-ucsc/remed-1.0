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


        <div class="main-content">
            <h2>Non-Available Medicine</h2>
            <div class="search-container">
                <input type="text" placeholder="Search here" class="search-bar">
                <button class="search"><i class="icon ph-bold ph-magnifying-glass"></i>
                </button>
            </div>

            <!-- <div class="ongoing">Ongoing Orders</div> -->

            <section class="order-management">


                <table class="order-table">
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

                <!-- <button class="new-order-btn"><i class="ph-bold ph-plus"></i>
        <p class="new-order">New Order</p></button> -->

            </section>

        </div>

        <script src="<?= ROOT ?>/assets/js/pharmacy/Order-main.js"></script>




    </div>


</body>

</html>