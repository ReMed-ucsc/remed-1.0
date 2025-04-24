<?php
// Sample data for demonstration (replace with your own data source or database)
require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';
?>

<body>
    <!-- Search Box Form -->
    <div class="above-table">
        <div class="search-container">
            <form id="search-form">
                <input type="text" name="search" id="searchInput" class="search-box" placeholder="Search here..." value="<?php if (isset($_GET['search'])) {echo htmlspecialchars($_GET['search']);} ?>">
                <button type="submit" class="search-button" onclick="performSearch()">Search</button>
            </form>

        </div>
        <div>
            <a class="add-btn" href="<?= ROOT ?>/admin/newDriver/"><img src="<?= ROOT ?>/assets/images/add.png" alt="" style="width:30px; height:auto; margin-right:5px;">Add newDriver</a>
        </div>

    </div>


    <!-- Table Structure -->
    <div class="details-container">
        <table class="table-container">
            <thead>
                <tr>
                    <th>Driver ID</th>
                    <th>Driver Name</th>
                    <th>Contact Number</th>
                    <th>Delivery Time</th>
                    <!-- <th>Email</th> -->
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($driver as $drivers): ?>
                    <?php if ($drivers): ?>
                        <tr>
                            <td><?= htmlspecialchars($drivers->driverId) ?></td>
                            <td><?= htmlspecialchars($drivers->driverName) ?></td>
                            <td><?= htmlspecialchars($drivers->telNo) ?></td>
                            <td><?= htmlspecialchars($drivers->deliveryTime) ?></td>
                            <!-- <td><?= htmlspecialchars($drivers->email) ?></td> -->
                            <td><span class="status-user"><?= htmlspecialchars($drivers->status) ?></span></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>






    <script src="<?= ROOT ?>/assets/js/admin/user.js"></script>
    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>