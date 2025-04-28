<?php

$search = $_GET['search'] ?? '';
require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';
?>

<body>
    <div class="search-container">
        <form id="search-form">
            <input type="text" id="searchInput" name="search" class="search-box" placeholder="Search here..." value="<?php if (isset($_GET['search'])) {
                echo htmlspecialchars($_GET['search']);
            } ?>">
            <button type="submit" class="search-button" onclick="performSearch()">Search</button>
        </form>


    </div>
    <div class="details-container">
        <table class="table-container">
            <thead>
                <tr>
                    <th>Driver Name</th>
                    <th>Contact Number</th>
                    <th>Delivery Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($drivers as $driver_details): ?>
                    <?php if ($driver_details): ?>

                        <tr>
                            <td><?= htmlspecialchars($driver_details->driverName) ?></td>
                            <td><?= htmlspecialchars($driver_details->telNo) ?></td>
                            <td><?= htmlspecialchars($driver_details->deliveryTime) ?></td>
                            <!-- <td><?= htmlspecialchars($driver_details->email) ?></td> -->
                            <td class="status-mark">
                                <span class="status pending">
                                    <?= htmlspecialchars($driver_details->status) ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-border">
                                    <a class="onboard"
                                        href="<?= ROOT ?>/admin/PendingDriver/OnboardDrivers/<?= htmlspecialchars($driver_details->driverId) ?>">OnBoard</a>
                                </div>

                                <div class="action-border">
                                    <a class="reject-action"
                                        href="<?= ROOT ?>/admin/PendingDriver/reject/<?= htmlspecialchars($driver_details->driverId) ?>">Reject</a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
    <script>
        var ROOT = '<?= ROOT ?>';
    </script>
    <script src="<?= ROOT ?>/assets/js/admin/pendingDriver.js"></script>
    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php'; ?>