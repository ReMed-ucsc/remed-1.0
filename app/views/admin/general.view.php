<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contactInfo = $_POST['contactInfo'] ?? '';

    // Update logic: Here you'd implement the logic to update the contact information in the database
    echo "Contact information has been updated.";
}

require_once BASE_PATH.'/app/views/inc/header.view.php';
require_once BASE_PATH.'/app/views/inc/navBar.view.php';
?>

<h2 class="page-title">General Settings</h2>

<div class="details-container">
    <form action="" method="POST">
        <div class="Form">
            <label for="contactInfo">Change contact information:</label>
            <textarea id="contactInfo" name="contactInfo" rows="4" placeholder="Enter new contact information" required></textarea>
        </div>

        <div class="Form">
            <button class="btn-green" type="submit" class="btn save">Save changes</button>
        </div>
    </form>
</div>

<?php require_once BASE_PATH.'/app/views/inc/footer.view.php'; ?>