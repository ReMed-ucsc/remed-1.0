<?php
require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';
?>

<body>
    <h2 class="page-title">Onboard New Driver</h2>
    <div class="details-container">
        <form class="form-container" action="" method="POST" enctype="multipart/form-data">
            <div class="Form">
                <div>
                    <label for="driverName">Driver Name:</label>
                    <input class="Input" type="text" id="driverName" name="driverName" placeholder="Enter Driver name">
                    <?php if (!empty($data['errors']['driverName'])): ?>
                        <p style="color:red; margin-top:-30px; margin-bottom:20px">
                            <?= htmlspecialchars($data['errors']['driverName']) ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="vehicalLicenseNo">Vehicle License Number:</label>
                    <input class="Input" type="text" id="lecenseNumber" name="vehicalLicenseNo"
                        placeholder="Enter license" >
                    <?php if (!empty($data['errors']['vehicalLicenseNo'])): ?>
                        <p style="color:red; margin-top:-30px; margin-bottom:20px">
                            <?= htmlspecialchars($data['errors']['vehicalLicenseNo']) ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="Form">
                <div>
                    <label for="email">Email:</label>
                    <input class="Input" type="email" id="email" name="email" placeholder="Enter email" >
                    <?php if (!empty($data['errors']['email'])): ?>
                        <p style="color:red; margin-top:-30px; margin-bottom:20px">
                            <?= htmlspecialchars($data['errors']['email']) ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="telNo">Contact Number:</label>
                    <input class="Input" type="text" id="contactNumber" name="telNo" placeholder="Enter contact number">\
                    <?php if (!empty($data['errors']['telNo'])): ?>
                        <p style="color:red; margin-top:-30px; margin-bottom:20px">
                            <?= htmlspecialchars($data['errors']['telNo']) ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="Form">

                <div>
                    <label for="deliveryTime">Delivery Time:</label>
                    <select class="Input" id="deliveryTime" name="deliveryTime" >
                        <option value="" disabled selected>Select Delivery Time</option>
                        <option value="morning">Morning (8:00 AM - 12:00 PM)</option>
                        <option value="afternoon">Afternoon (12:00 PM - 4:00 PM)</option>
                        <option value="evening">Evening (4:00 PM - 8:00 PM)</option>
                    </select>
                    <?php if (!empty($data['errors']['deliveryTime'])): ?>
                        <p style="color:red; margin-top:-30px; margin-bottom:20px">
                            <?= htmlspecialchars($data['errors']['deliveryTime']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div>
                    <button type="submit" class="btn-green">Save</button>
                    <button type="button" class="btn-red" onclick="window.history.back()">Cancel</button>
                </div>
            </div>

        </form>

    </div>
    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>