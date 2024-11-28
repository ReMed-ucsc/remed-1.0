<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReMed Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/medicine.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/navbar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/component/sidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <header>
        <?php include BASE_PATH . '/app/views/inc/pharmacy/regNavbar.php'; ?>
    </header>

    <div class="fullpage">
        <?php include BASE_PATH . '/app/views/inc/pharmacy/sidebar.php'; ?>

        <div class="main-content">
            <h2>Medicine Inventory</h2>

            <!-- Tabs for Available & Non-Available Medicines -->


            <!-- Search Bar -->
            <div class="search-container">
                <input type="text" placeholder="Search here" class="search-bar">
                <button class="search"><i class="icon ph-bold ph-magnifying-glass"></i></button>
            </div>

            <div class="tabs">
                <button class="tab-button active" data-tab="available">In-Stock Medicines</button>
                <button class="tab-button" data-tab="non-available">Out-of-Stock Medicines</button>
                <button class="tab-button" data-tab="low-stock">Low-Stock Medicines</button>
            </div>

            <!-- Available Medicines Table -->

            <section id="available" class="tab-content active">
                <div class="table-section">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Medicine Name</th>
                                <th>Unit Price</th>
                                <th>Supplier ID</th>
                                <th>Expiration Date</th>
                                <th>Reorder Level</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>BATCH-001</td>
                                <td>Paracetamol</td>
                                <td>Panadol</td>
                                <td>Pain Relief</td>
                                <td>$10.00</td>
                                <td>SUP-456</td>
                                <td>2025-06-15</td>
                                <td>50</td>
                                <td>In Stock</td>
                            </tr>
                            <tr>
                                <td>BATCH-003</td>
                                <td>Vitamin C</td>
                                <td>Citrohealth</td>
                                <td>Supplements</td>
                                <td>$5.00</td>
                                <td>SUP-123</td>
                                <td>2026-02-20</td>
                                <td>100</td>
                                <td>In Stock</td>
                            </tr>
                            <tr>
                                <td>BATCH-003</td>
                                <td>Vitamin C</td>
                                <td>Citrohealth</td>
                                <td>Supplements</td>
                                <td>$5.00</td>
                                <td>SUP-123</td>
                                <td>2026-02-20</td>
                                <td>100</td>
                                <td>In Stock</td>
                            </tr>
                            <tr>
                                <td>BATCH-003</td>
                                <td>Vitamin C</td>
                                <td>Citrohealth</td>
                                <td>Supplements</td>
                                <td>$5.00</td>
                                <td>SUP-123</td>
                                <td>2026-02-20</td>
                                <td>100</td>
                                <td>In Stock</td>
                            </tr>
                            <tr>
                                <td>BATCH-003</td>
                                <td>Vitamin C</td>
                                <td>Citrohealth</td>
                                <td>Supplements</td>
                                <td>$5.00</td>
                                <td>SUP-123</td>
                                <td>2026-02-20</td>
                                <td>100</td>
                                <td>In Stock</td>
                            </tr>
                            <tr>
                                <td>BATCH-003</td>
                                <td>Vitamin C</td>
                                <td>Citrohealth</td>
                                <td>Supplements</td>
                                <td>$5.00</td>
                                <td>SUP-123</td>
                                <td>2026-02-20</td>
                                <td>100</td>
                                <td>In Stock</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Non-Available Medicines Table -->
            <section id="non-available" class="tab-content">
                <div class="table-section">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Medicine Name</th>
                                <th>Unit Price</th>
                                <th>Supplier ID</th>
                                <th>Expiration Date</th>
                                <th>Reorder Level</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>BATCH-004</td>
                                <td>Amoxicillin</td>
                                <td>Amoxil</td>
                                <td>Antibiotics</td>
                                <td>$8.00</td>
                                <td>SUP-456</td>
                                <td>2025-08-15</td>
                                <td>20</td>
                                <td>Out of Stock</td>
                            </tr>
                            <tr>
                                <td>BATCH-002</td>
                                <td>Ibuprofen</td>
                                <td>Advil</td>
                                <td>Pain Relief</td>
                                <td>$12.50</td>
                                <td>SUP-789</td>
                                <td>2024-12-10</td>
                                <td>30</td>
                                <td>Out of Stock</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <!-- <section id="low-stock" class="tab-content">
                <p class="hero">There are no Low Stock Medicines</p>
            </section> -->
            <section id="low-stock" class="tab-content">
                <div class="table-section">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th style="width:5%;">Item ID</th>
                                <th style="width:5%;">Brand Name</th>
                                <th style="width:5%;">Generic Name</th>
                                <th style="width:5%;">Medicine Name</th>
                                <th style="width:5%;">Unit Price</th>
                                <th style="width:5%;">Supplier ID</th>
                                <th style="width:5%;">Expiration Date</th>
                                <th style="width:5%;">Reorder Level</th>
                                <th style="width:5%;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>BATCH-004</td>
                                <td>Amoxicillin</td>
                                <td>Amoxil</td>
                                <td>Antibiotics</td>
                                <td>$8.00</td>
                                <td>SUP-456</td>
                                <td>2025-08-15</td>
                                <td>20</td>
                                <td>Low Stock</td>
                            </tr>
                            <tr>
                                <td>BATCH-002</td>
                                <td>Ibuprofen</td>
                                <td>Advil</td>
                                <td>Pain Relief</td>
                                <td>$12.50</td>
                                <td>SUP-789</td>
                                <td>2024-12-10</td>
                                <td>30</td>
                                <td>Low Stock</td>
                            </tr>
                            <tr>
                                <td>BATCH-004</td>
                                <td>Amoxicillin</td>
                                <td>Amoxil</td>
                                <td>Antibiotics</td>
                                <td>$8.00</td>
                                <td>SUP-456</td>
                                <td>2025-08-15</td>
                                <td>20</td>
                                <td>Low Stock</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/pharmacy/Order-main.js"></script>


    <script>
        // JavaScript for Tab Switching
        const tabs = document.querySelectorAll(".tab-button");
        const contents = document.querySelectorAll(".tab-content");

        tabs.forEach(tab => {
            tab.addEventListener("click", () => {
                tabs.forEach(t => t.classList.remove("active"));
                contents.forEach(c => c.classList.remove("active"));

                tab.classList.add("active");
                document.getElementById(tab.dataset.tab).classList.add("active");
            });
        });
    </script>
    </div>
</body>

</html>