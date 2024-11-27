<?php
require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';
?>

<body>
    <h2 class="page-title">Onboard New Pharmacy</h2>
    <div class="details-container">
        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <?php foreach ($errors as $error): ?>
                    <p class="error"><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form class="form-container" action="<?= ROOT ?>/admin/PharmacyDetails/create" method="POST" enctype="multipart/form-data">
            <div class="Form">
                <div>
                    <label for="pharmacyName">Pharmacy Name:</label>
                    <input class="Input" type="text" id="pharmacyName" name="pharmacyName" placeholder="Enter pharmacy name" required>
                </div>

                <div>
                    <label for="pharmacistName">Pharmacist's Name:</label>
                    <input class="Input" type="text" id="pharmacistName" name="pharmacistName" placeholder="Enter pharmacist's name" required>
                </div>

                <div>
                    <label for="licenseNumber">License Number:</label>
                    <input class="Input" type="text" id="licenseNumber" name="license" placeholder="Enter license" required>
                </div>
            </div>

            <div class="Form">
                <div>
                    <label for="email">Email:</label>
                    <input class="Input" type="email" id="email" name="email" placeholder="Enter email" required>
                </div>

                <div>
                    <label for="contactNo">Contact Number:</label>
                    <input class="Input" type="text" id="contactNo" name="contactNo" placeholder="Enter contact number" required>
                </div>

                <div>
                    <label for="address">Pharmacy Address:</label>
                    <input class="Input" type="text" id="address" name="address" placeholder="Enter address" required>
                </div>
            </div>

            <div class="Form">
                <div>
                    <label for="document">Document:</label>
                    <input class="Input" type="file" id="document" name="document">
                </div>

                <div class="buttons">
                    <button type="submit" class="btn-green">Save</button>
                    <button type="button" class="btn-red" onclick="window.history.back()">Cancel</button>
                </div>
            </div>


        </form>
    </div>

    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php'; ?>
</body>