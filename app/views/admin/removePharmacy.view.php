<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pharmacyName = $_POST['pharmacyName'] ?? '';
    $pharmacistName = $_POST['pharmacistName'] ?? '';
    $licenseNumber = $_POST['licenseNumber'] ?? '';
    $reason = $_POST['reason'] ?? '';

    // Delete logic: Here, you'd implement the logic to delete the pharmacy from the system
    echo "Pharmacy {$pharmacyName} removed for the reason: {$reason}";
}

require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';
?>


<body>
<h2 class="page-title">Remove Pharmacy on system</h2>

<div class="details-container">
    <form  action="" method="POST">
        <div class="Form">
            <div>
                <label for="pharmacyName">Pharmacy Name:</label>
                <input class="Input" type="text" id="pharmacyName" name="pharmacyName" value="Medico" readonly>
            </div>

            <div>
                <label for="pharmacistName">Pharmacist's Name:</label>
                <input class="Input" type="text" id="pharmacistName" name="pharmacistName" value="Mr. Saman" readonly>
            </div>

            <div>
                <label for="licenseNumber">License Number:</label>
                <input class="Input" type="text" id="licenseNumber" name="licenseNumber" value="SL-12345-COLO" readonly>
            </div>
        </div>
        

        <div class="Form">
            <label for="reason">Reason for delete pharmacy in system:</label>
            <select  id="reason" name="reason" required>
                <option value="">Choose the reason</option>
                <option value="Bad feedback from 10 users">Bad feedback from 10 users</option>
                <option value="Pharmacist’s request">Pharmacist’s request</option>
                <option value="Already pharmacy deleted their account">Already pharmacy deleted their account</option>
            </select>
        </div>


    </form>
    <div>
        <button class="btn-red" type="submit" class="btn delete">Delete</button>
        <button class="btn-green" type="button" class="btn cancel" onclick="window.history.back()">Cancel Delete</button>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/inc/footer.view.php'; ?>
