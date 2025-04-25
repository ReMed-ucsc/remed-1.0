<?php
require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';
?>

<body>
    <h2 class="page-title">Admin Account Management</h2>

    <div class="profile-edit-container">
        <form  action="" method="POST">
            

            <div>
                <label for="name">Name:</label>
                <input class="Input" type="text" id="name" name="username" placeholder="Enter name"
                    value="<?= isset($data['username']) ? htmlspecialchars($data['username']) : '' ?>" required>
            </div>
            
            <div>
                <label for="contactNo">ContactNo:</label>
                <input class="Input" type="tel" id="contactNo" name="contactNo" placeholder="Enter Contact No"
                    value="<?= isset($data['contactNo']) ? htmlspecialchars($data['contactNo']) : '' ?>" required>
            </div>

            <div>
                <label for="password">Password:</label>
                <input class="Input" type="password" id="password" name="password" placeholder="Enter password"
                    value="<?= isset($data['password']) ? htmlspecialchars($data['password']) : '' ?>" required>
            </div>

            <div>
                <label for="confirm_password">Confirm password:</label>
                <input class="Input" type="password" id="confirm_password" name="confirm_password"
                    placeholder="Re-enter password" required>
            </div>

            <div>
                <button type="submit" class="btn-green">Save changes</button>
            </div>
        </form>
    </div>

    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php'; ?>