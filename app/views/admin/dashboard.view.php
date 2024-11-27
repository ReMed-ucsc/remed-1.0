<?php

// Dummy data for the dashboard
$registeredPharmacies = 123;
$onlineUsers = 45;
$requestedPharmacies = 10;
$drivers = 50;
$requestedDrivers = 5;

$recentActivities = [
    ["time" => "05:38am", "activity" => "Update pharmacy details - Amarasinghe pharmacy"],
    ["time" => "06:03am", "activity" => "Verify pharmacy - Nilmini Pharmacy"],
    ["time" => "06:10am", "activity" => "Verify pharmacy - Sujatha Pharmacy"]
];

require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php' ?>



<body>

    <!-- dashboardBody start -->
    <div class="dashboard">
        <div class="card greenA">
            <img src="<?= ROOT ?>/assets/images/statistics.png" alt="" />
            <p>Registered Pharmacy</p>
            <h2 id="count"><?= $registeredPharmacies ?></h2>
        </div>
        <div class="card blue">
            <img src="<?= ROOT ?>/assets/images/computer.png" alt="" />
            <p>Online Users</p>
            <h2 id="count"><?= $onlineUsers ?></h2>
        </div>
        <div class="card red">
            <img src="<?= ROOT ?>/assets/images/time-left.png" alt="" />
            <p>Requested Pharmacy</p>
            <h2 id="count"><?= $requestedPharmacies ?></h2>
        </div>
        <div class="card yellow">
            <img src="<?= ROOT ?>/assets/images/driver.png" alt="" />
            <p>Total Drivers</p>
            <h2 id="count"><?= $drivers ?></h2>
        </div>
        <div class="card black">
            <img src="<?= ROOT ?>/assets/images/time-left.png" alt="" />
            <p>Requested Drivers</p>
            <h2 id="count"><?= $requestedDrivers ?></h2>
        </div>
    </div>
    <div class="recent-activity">
        <h3>Recent Activity</h3>
        <?php foreach ($recentActivities as $activity): ?>
            <div class="activity-item">
                <span class="time"><?= $activity['time'] ?></span>
                <span class="details"><?= $activity['activity'] ?></span>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- dashboardBody end -->

    <script>
        var ROOT = '<?= ROOT ?>';
    </script>
    <script src="<?= ROOT ?>/assets/js/admin/dashboard.js"></script>

    <?php require_once  BASE_PATH . '/app/views/inc/footer.view.php' ?>