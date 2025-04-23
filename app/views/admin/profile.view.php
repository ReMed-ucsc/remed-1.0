<?php
require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';

?>

<body class="profile-body">
    <div class="profile-container-out">
        <div class="profile-container">
            <div class="profile-left">
                <img src="<?= ROOT ?>/assets/images/admin.png" alt="" />
                <div class="details">
                    <h2>ADMINISTRATOR</h2>
                    <?php if (!empty($admin)): ?>
                        <p><?= htmlspecialchars($admin->username)?></p>
                        <p><?= htmlspecialchars($admin->email )?></p>
                    <?php else: ?>
                        <p>No admin data available</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="profile-right">
                <a class="btn-green" href="<?= ROOT ?>/admin/profile/edit/<?=htmlspecialchars($admin->id)?>">Edit Profile</a>
                <a class="btn-green" href="<?= ROOT ?>/admin/legal">Laws and Regulation</a>
                <a class="btn-red" href="<?= ROOT ?>/admin/login">Log Out</a>
            </div>
        </div>
    </div>
    </div>
</body>