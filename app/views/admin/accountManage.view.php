<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
    } else {
        // Update logic: Here you'd implement the logic to update the admin account details in the database
        echo "Admin account has been updated.";
    }
}

require_once BASE_PATH.'/app/views/inc/header.view.php';
require_once BASE_PATH.'/app/views/inc/navBar.view.php';
?>

<body>
<h2 class="page-title">Admin Account Management</h2>

<div class="details-container">
    <form class="Form" action="" method="POST">
        <div>
            <label for="name">Name:</label>
            <input class="Input" type="text" id="name" name="name" placeholder="Enter name" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input class="Input" type="email" id="email" name="email" placeholder="Enter email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input class="Input" type="password" id="password" name="password" placeholder="Enter password" required>
        </div>

        <div>
            <label for="confirm_password">Confirm password:</label>
            <input class="Input" type="password" id="confirm_password" name="confirm_password" placeholder="Re-enter password" required>
        </div>

        <div>
            <button type="submit" class="btn-green">Save changes</button>
        </div>
    </form>
</div>

<?php require_once BASE_PATH.'/app/views/inc/footer.view.php'; ?>
