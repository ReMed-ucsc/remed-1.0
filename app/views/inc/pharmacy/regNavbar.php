<?php
// Assuming session has been started on the parent page
// $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : 'userexample123@gmail.com';
// $pharmacyName = isset($_SESSION['pharmacy_name']) ? $_SESSION['pharmacy_name'] : 'Healthcare Pharmacy';

$pharmacyID = $_SESSION['user_id'];

$pharmacyModel = new Pharmacy();
$pharmacy = $pharmacyModel->getPharmacyById($pharmacyID);


?>

<body class="is-registered">
    <nav class="navbar">
        <div class="navbar-right">
            <a href="<?= ROOT ?>/index" class="logo">ReMED</a>
            <div class="nav-links">
                <a href="<?= ROOT ?>/notifications"><img src="<?= ROOT ?>/assets/images/bell-icon.png" alt="Bell Icon"></a>
                <a href="<?= ROOT ?>/profilePage">

                    <div class="image">
                        <!-- <div class="user"><img src="<?= ROOT ?>/assets/images/admin.png" alt="Profile Icon">
                        </div> -->
                        <p class="name"><?= htmlspecialchars($pharmacy->name) ?></p>

                    </div>
                </a>
            </div>
        </div>
    </nav>
    <div id="notification-popup" class="notification-popup">
        <div class="popup-content">
            <p id="notification-message">New notification</p>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/pharmacy/navbar.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/notification.js"></script>
</body>