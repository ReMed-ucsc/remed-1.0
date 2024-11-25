<?php
require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php'

?>

<body>
<h2 class="page-title">Edit Pharmacy Details</h2>
<div class="details-container">


    <form class="form-container" action="" method="POST" enctype="multipart/form-data">
        <div class="Form">
            <div>
                <label for="pharmacyName">Pharmacy Name:</label>
                <input class="Input"  type="text" id="pharmacyName" name="pharmacyName" placeholder="Enter pharmacy name" required>
            </div>

            <div>
                <label for="pharmacistName">Pharmacist's Name:</label>
                <input class="Input" type="text" id="pharmacistName" name="pharmacistName" placeholder="Enter pharmacist's name" required>
            </div>

            <div>
                <label for="license">License Number:</label>
                <input class="Input" type="text" id="license" name="license" placeholder="Enter license" required>
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
        </div>

    </form>
    <div>
        <button type="submit" class="btn-green">Save Changes</button>
        <button type="button" class="btn-red" onclick="window.history.back()">Discard Changes</button>
    </div>
</div>
<?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>