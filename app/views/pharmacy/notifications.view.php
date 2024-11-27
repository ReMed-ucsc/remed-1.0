<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/notifications.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/navbar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/component/sidebar.css">
    <link rel="stylesheet" href="notifications.css">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <header>

        <?php
        // $isRegisteredUser = isset($_SESSION['user']);  // Check if user is logged in

        include BASE_PATH . '/app/views/inc/pharmacy/regNavbar.php';

        ?>

    </header>


    <div class="fullpage">

        <?php include(BASE_PATH . '/app/views/inc/pharmacy/sidebar.php'); ?>


        <div class="main-content">
            <div class="notification-container">
                <div class="notification-header">
                    <h2>Notification</h2>
                    <button class="mark-all-read">Mark all as Read</button>
                </div>
                <div class="notification-list">
                    <?php
                    // Sample notifications
                    $notifications = [
                        "Paradol (Paracetamol) - Batch B456 has only 50 units left. Expiry: 01/2025. Restock soon!",
                        "Paradol (Paracetamol) - Batch B456 has only 50 units left. Expiry: 01/2025. Restock soon!",
                        "Paradol (Paracetamol) - Batch B456 has only 50 units left. Expiry: 01/2025. Restock soon!",
                        "Paradol (Paracetamol) - Batch B456 has only 50 units left. Expiry: 01/2025. Restock soon!",
                        "Paradol (Paracetamol) - Batch B456 has only 50 units left. Expiry: 01/2025. Restock soon!",
                    ];

                    foreach ($notifications as $index => $notification) {
                        echo '<div class="notification ' . ($index < 2 ? 'unread' : '') . '">
                        <div class="notification-icon">👨‍⚕️</div>
                        <p>' . $notification . '</p>
                      </div>';
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>



</body>

</html>