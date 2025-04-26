<?php
require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';

$errors = $data['errors'] ?? [];
?>


<body>
    <?php if (!empty($errors)) { ?>
        <div class="error-messages">
            <?php foreach ($errors as $error) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
        </div>
    <?php } ?>
    <h2 class="page-title">Onboard Driver</h2>
    <div class="details-container">
        <form class="form-container" action="" method="POST"
            enctype="multipart/form-data">
            <div class="Form">
                <div>
                    <label for="driverName">Driver Name:</label>
                    <input class="Input" type="text" id="driverName" name="driverName" placeholder="Enter Driver name"
                        value='<?= htmlspecialchars($driver->driverName) ?>' required>
                </div>
                <div>
                    <label for="vehicalLicenseNo">Vehicle License Number:</label>
                    <input class="Input" type="text" id="lecenseNumber" name="vehicalLicenseNo"
                        value='<?= htmlspecialchars($driver->vehicalLicenseNo) ?>' placeholder="Enter license" readonly>
                </div>
            </div>
            <div class="Form">
                <div>
                    <label for="email">Email:</label>
                    <input class="Input" type="email" id="email" name="email" placeholder="Enter email"
                        value='<?= htmlspecialchars($driver->email) ?>' required>
                </div>
                <div>
                    <label for="telNo">Contact Number:</label>
                    <input class="Input" type="text" id="contactNumber" name="telNo" placeholder="Enter contact number"
                        value='<?= htmlspecialchars($driver->telNo) ?>' required>
                </div>
            </div>
            <div class="Form">


                <div>
                    <label for="deliveryTime">Delivery Time:</label>
                    <select class="Input" id="deliveryTime" name="deliveryTime" required>
                        <option value="" disabled <?= empty($driver->deliveryTime) ? 'selected' : '' ?>>Select
                            Delivery Time</option>
                        <option value="morning" <?= (isset($driver->deliveryTime) && $driver->deliveryTime === 'morning') ? 'selected' : '' ?>>Morning (8:00 AM - 12:00 PM)
                        </option>
                        <option value="afternoon" <?= (isset($driver->deliveryTime) && $driver->deliveryTime === 'afternoon') ? 'selected' : '' ?>>Afternoon (12:00 PM - 4:00 PM)
                        </option>
                        <option value="evening" <?= (isset($driver->deliveryTime) && $driver->deliveryTime === 'evening') ? 'selected' : '' ?>>Evening (4:00 PM - 8:00 PM)
                        </option>
                    </select>
                </div>



                <div>
                    <button type="submit" class="btn-green">Save</button>
                    <button type="button" class="btn-red" onclick="window.history.back()">Cancel</button>
                </div>
            </div>

        </form>

    </div>
    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>