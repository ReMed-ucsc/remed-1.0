<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReMed Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/medicine.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/table.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/navbar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/component/sidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body data-user-id="<?php echo $_SESSION['user_id'] ?? ''; ?>">
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
                <section class="table-management">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Medicine Name</th>
                                <th>Unit Price</th>
                                <th>Expiration Date</th>
                                <th>Stock Quantity</th>
                                <th>Reorder Level</th>
                                <!-- <th>Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($medicine as $item): ?>
                                <?php if ($item->availableCount > $item->thresholdLimit): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item->ProductID) ?></td>
                                        <td><?= htmlspecialchars($item->Manufacturer) ?></td>
                                        <td><?= htmlspecialchars($item->genericName) ?></td>
                                        <td><?= htmlspecialchars($item->ProductName) ?></td>
                                        <td><?= htmlspecialchars($item->SellingPrice) ?></td>
                                        <td><?= htmlspecialchars($item->expiryDate) ?></td>
                                        <td><?= htmlspecialchars($item->availableCount) ?></td>

                                        <td><?= htmlspecialchars($item->thresholdLimit) ?></td>







                                        <!-- <td>In Stock</td> -->
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </section>
            </section>

            <!-- Non-Available Medicines Table -->
            <section id="non-available" class="tab-content">
                <section class="table-management">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Medicine Name</th>
                                <th>Unit Price</th>
                                <th>Expiration Date</th>
                                <th>Stock Quantity</th>

                                <th>Reorder Level</th>
                                <!-- <th>Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($medicine as $item): ?>

                                <?php if ($item->availableCount > 0 && $item->availableCount <= $item->thresholdLimit): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item->ProductID) ?></td>
                                        <td><?= htmlspecialchars($item->Manufacturer) ?></td>
                                        <td><?= htmlspecialchars($item->genericName) ?></td>
                                        <td><?= htmlspecialchars($item->ProductName) ?></td>
                                        <td><?= htmlspecialchars($item->SellingPrice) ?></td>
                                        <td><?= htmlspecialchars($item->expiryDate) ?></td>
                                        <td><?= htmlspecialchars($item->availableCount) ?></td>

                                        <td><?= htmlspecialchars($item->thresholdLimit) ?></td>







                                        <!-- <td>In Stock</td> -->
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
            </section>
            <!-- <section id="low-stock" class="tab-content">
                <p class="hero">There are no Low Stock Medicines</p>
            </section> -->
            <section id="low-stock" class="tab-content">
                <section class="table-management">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:5%;">Item ID</th>
                                <th style="width:5%;">Brand Name</th>
                                <th style="width:5%;">Generic Name</th>
                                <th style="width:5%;">Medicine Name</th>
                                <th style="width:5%;">Unit Price</th>
                                <th style="width:5%;">Expiration Date</th>
                                <th>Stock Quantity</th>

                                <th style="width:5%;">Reorder Level</th>
                                <!-- <th style="width:5%;">Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($medicine as $item): ?>

                                <?php if ($item->availableCount == 0): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item->ProductID) ?></td>
                                        <td><?= htmlspecialchars($item->Manufacturer) ?></td>
                                        <td><?= htmlspecialchars($item->genericName) ?></td>
                                        <td><?= htmlspecialchars($item->ProductName) ?></td>
                                        <td><?= htmlspecialchars($item->SellingPrice) ?></td>
                                        <td><?= htmlspecialchars($item->expiryDate) ?></td>
                                        <td><?= htmlspecialchars($item->availableCount) ?></td>

                                        <td><?= htmlspecialchars($item->thresholdLimit) ?></td>

                                        <!-- <td>In Stock</td> -->
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
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