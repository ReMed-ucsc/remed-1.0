<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $remedId = $_POST['remedId'] ?? '';
    $email = $_POST['email'] ?? '';
    $pharmacyName = $_POST['pharmacyName'] ?? '';
    $contactNumber = $_POST['contactNumber'] ?? '';
    $pharmacistName = $_POST['pharmacistName'] ?? '';
    $licenseNumber = $_POST['licenseNumber'] ?? '';
    $pharmacyAddress = $_POST['pharmacyAddress'] ?? '';
    $document = $_FILES['document'] ?? null;

    // File upload logic (if file is uploaded)
    if ($document && $document['error'] === 0) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($document['name']);
        move_uploaded_file($document['tmp_name'], $uploadFile);
        echo "File uploaded successfully!";
    }

    // Save data to database or any other logic you want to implement here
    echo "Pharmacy onboarded successfully!";
}
?>

<?php require_once '/opt/lampp/htdocs/MVC/app/views/inc/header.view.php' ?>
<?php require_once '/opt/lampp/htdocs/MVC/app/views/inc/navBar.view.php' ?>


<h2 class="title">Onboard New Pharmacy</h2>
<div class="container">
    
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="left section">
            <div class="form-group">
                <label for="remedId">ReMed Pharmacy Id:</label>
                <input type="text" id="remedId" name="remedId" value="124" readonly>
            </div>

            <div class="form-group">
                <label for="pharmacyName">Pharmacy Name:</label>
                <input type="text" id="pharmacyName" name="pharmacyName" placeholder="Enter pharmacy name" required>
            </div>

            <div class="form-group">
                <label for="pharmacistName">Pharmacist's Name:</label>
                <input type="text" id="pharmacistName" name="pharmacistName" placeholder="Enter pharmacist's name" required>
            </div>

            <div class="form-group">
                <label for="licenseNumber">License Number:</label>
                <input type="text" id="licenseNumber" name="licenseNumber" placeholder="Enter license" required>
            </div>
        </div>

        <div class="middle section">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter email" required>
            </div>

            <div class="form-group">
                <label for="contactNumber">Contact Number:</label>
                <input type="text" id="contactNumber" name="contactNumber" placeholder="Enter contact number" required>
            </div>

            <div class="form-group">
                <label for="pharmacyAddress">Pharmacy Address:</label>
                <input type="text" id="pharmacyAddress" name="pharmacyAddress" placeholder="Enter address" required>
            </div>
        </div>
        
         <div class="right section">
            <div class="form-group">
                <label for="document">Document:</label>
                <input type="file" id="document" name="document">
            </div>
        </div>

    </form>
    <div class="form-actions">
        <button type="submit" class="btn save">Save</button>
        <button type="button" class="btn cancel" onclick="window.history.back()">Cancel</button>
    </div>
</div>
<?php require_once '/opt/lampp/htdocs/MVC/app/views/inc/footer.view.php' ?>