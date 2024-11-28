<?php require_once BASE_PATH . '/app/views/inc/header.view.php' ?>
<?php require_once BASE_PATH . '/app/views/inc/navBar.view.php' ?>

<body>
    <!-- Search Box Form -->
    <div class="above-table">
        <div class="search-container">
            <input type="text" id="searchInput" class="search-box" placeholder="Search here...">
            <img src="<?= ROOT ?>/assets/images/search.png" alt="icon">
            <!-- <button class="search-button" onclick="performSearch()">Search</button> -->
        </div>
        <div>
            <a class="add-btn" href="<?= ROOT ?>/admin/newPharmacy/"><img src="<?= ROOT ?>/assets/images/add.png" alt="" style="width:30px; height:auto; margin-right:5px;">Add Pharmacy</a>
        </div>

    </div>




    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error_message) ?>
        </div>
    <?php endif; ?>

    <?php if (isset($success_message)): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success_message) ?>
        </div>
    <?php endif; ?>
    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>


    <div class="details-container">
        <?php if (is_array($pharmacy) || is_object($pharmacy)): ?>
            <?php if (empty($pharmacy)): ?>
                <p>No data records found.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Pharmacy ID</th>
                            <th>Pharmacy Name</th>
                            <th>Pharmacist Name</th>
                            <th>Contact Number</th>
                            <th>License</th>
                            <th>Approved Date</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pharmacy as $pharmacy_item): ?>
                            <?php if ($pharmacy_item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($pharmacy_item->PharmacyID) ?></td>
                                    <td><?= htmlspecialchars($pharmacy_item->name) ?></td>
                                    <td><?= htmlspecialchars($pharmacy_item->pharmacistName) ?></td>
                                    <td><?= htmlspecialchars($pharmacy_item->contactNo) ?></td>
                                    <td><?= htmlspecialchars($pharmacy_item->RegNo ?? '') ?></td>
                                    <td><?= htmlspecialchars($pharmacy_item->approvedDate ?? '') ?></td>
                                    <td><?= htmlspecialchars($pharmacy_item->email ?? '') ?></td>
                                    <td><?= htmlspecialchars($pharmacy_item->address) ?></td>
                                    <td class="status statusA"><?= htmlspecialchars($pharmacy_item->status) ?></td>
                                    <td>
                                        <a href="<?= ROOT ?>/admin/PharmacyDetails/edit/<?= htmlspecialchars($pharmacy_item->PharmacyID) ?>">
                                            <img class="action edit" src="../../public/assets/images/pencil.png" alt="Edit" />
                                        </a>
                                        <a href="#" onclick="confirmDelete('<?= ROOT ?>/admin/PharmacyDetails/delete/<?= $pharmacy_item->PharmacyID ?>')">
                                            <img class="action remove" src="../../public/assets/images/bin.png" alt="Delete" />
                                        </a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php else: ?>
            <p>Error loading data data. Please try again later.</p>
        <?php endif; ?>
    </div>

    <script>
        var ROOT = '<?= ROOT ?>';
    </script>

    <script src="<?= ROOT ?>/assets/js/admin/pharmacyDetails.js"></script>

    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>