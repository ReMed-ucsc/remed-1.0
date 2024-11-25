<!-- <?php
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $remedId = $_POST['remedId'] ?? '';
        //     $email = $_POST['email'] ?? '';
        //     $driverName = $_POST['driverName'] ?? '';
        //     $contactNumber = $_POST['contactNumber'] ?? '';
        //     $licenseNumber = $_POST['licenseNumber'] ?? '';
        //     $driverAddress = $_POST['driverAddress'] ?? '';
        //     $document = $_FILES['document'] ?? null;
        //     // File upload logic (if file is uploaded)
        //     if ($document && $document['error'] === 0) {
        //         $uploadDir = 'uploads/';
        //         $uploadFile = $uploadDir . basename($document['name']);
        //         move_uploaded_file($document['tmp_name'], $uploadFile);
        //         echo "File uploaded successfully!";
        //     }
        //     // Save data to database or any other logic you want to implement here
        //     echo "Driver onboarded successfully!";
        // }
        ?> -->
<?php
require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';
?>
<body>
    <?php if (!empty($errors)) { ?>
        <div class="error-messages">
            <?php foreach ($errors as $error) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
        </div>
    <?php } ?>
    <h2 class="page-title">Onboard New Driver</h2>
    <div class="details-container">
        <form class="form-container" action="" method="POST" enctype="multipart/form-data">
            <div class="Form">
                <div>
                    <label for="remedId">ReMed Driver Id:</label>
                    <input class="Input" type="text" id="remedId" name="remedId" value="124" readonly>
                </div>
                <div>
                    <label for="pharmacyName">Driver Name:</label>
                    <input class="Input" type="text" id="pharmacyName" name="pharmacyName" placeholder="Enter pharmacy name" required>
                </div>
                <div>
                    <label for="licenseNumber">Vehicle License Number:</label>
                    <input class="Input" type="text" id="licenseNumber" name="licenseNumber" placeholder="Enter license" required>
                </div>
                <div>
                    <label for="deliveryTime">Delivery Time:</label>
                    <select class="Input" id="deliveryTime" name="deliveryTime" required>
                        <option value="" disabled selected>Select Delivery Time</option>
                        <option value="morning">Morning (8:00 AM - 12:00 PM)</option>
                        <option value="afternoon">Afternoon (12:00 PM - 4:00 PM)</option>
                        <option value="evening">Evening (4:00 PM - 8:00 PM)</option>
                    </select>
                </div>
            </div>
            <div class="Form">
                <div>
                    <label for="email">Email:</label>
                    <input class="Input" type="email" id="email" name="email" placeholder="Enter email" required>
                </div>
                <div>
                    <label for="contactNumber">Contact Number:</label>
                    <input class="Input" type="text" id="contactNumber" name="contactNumber" placeholder="Enter contact number" required>
                </div>
            </div>
            <div class="Form">
                <div>
                    <label for="document">Document:</label>
                    <input class="Input" type="file" id="document" name="document">
                </div>
            </div>
        </form>
        <div>
            <button type="submit" class="btn-green">Save</button>
            <button type="button" class="btn-red" onclick="window.history.back()">Cancel</button>
        </div>
    </div>
    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>