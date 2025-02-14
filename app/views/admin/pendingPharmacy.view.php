<?php
// Sample data (replace with your actual database or data source)


$search = $_GET['search'] ?? '';


require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';
?>

<body>
    <!-- Search Box Form -->
    <div class="search-container">
        <input type="text" id="searchInput" class="search-box" placeholder="Search here...">
        <img src="<?= ROOT ?>/assets/images/search.png" alt="icon">
    </div>



    <!-- Table Structure -->
    <div class="details-container">
        <table>
            <thead>
                <tr>
                    <th>Pharmacy ID</th>
                    <th>Pharmacy Name</th>
                    <th>Pharmacist Name</th>
                    <th>Contact Number</th>
                    <th>License</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pharmacy as $pharmacy_items): ?>
                    <?php if ($pharmacy_items): ?>
                        <tr>
                            <td><?= htmlspecialchars($pharmacy_items->PharmacyID) ?></td>
                            <td><?= htmlspecialchars($pharmacy_items->name) ?></td>
                            <td><?= htmlspecialchars($pharmacy_items->pharmacistName) ?></td>
                            <td><?= htmlspecialchars($pharmacy_items->contactNo) ?></td>
                            <td><?= htmlspecialchars($pharmacy_items->RegNo ?? '') ?></td>
                            <td><?= htmlspecialchars($pharmacy_items->email ?? '') ?></td>
                            <td><?= htmlspecialchars($pharmacy_items->address) ?></td>
                            <td class="status-mark">
                                <span class="status pending"><?= htmlspecialchars($pharmacy_items->status)?></span>
                            </td>
                            <td>
                                <a class="onboard" href="<?=ROOT?>/admin/PendingPharmacy/onbordPharmacy/<?= htmlspecialchars($pharmacy_items->PharmacyID) ?>">onboard</a>
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
    <script src="<?= ROOT ?>/assets/js/admin/pendingPharmacy.js"></script>
    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php'; ?>