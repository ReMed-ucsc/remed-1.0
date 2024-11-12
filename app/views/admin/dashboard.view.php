<?php
// // Start the session
// session_start();

// // Check if the user is logged in, if not redirect to login page
// if (!isset($_SESSION['loggedin'])) {
//     header("Location: login.php");
//     exit;
// }

// Dummy data for the dashboard
$registeredPharmacies = 123;
$onlineUsers = 45;
$requestedPharmacies = 10;

$recentActivities = [
    ["time" => "05:38am", "activity" => "Update pharmacy details - Amarasinghe pharmacy"],
    ["time" => "06:03am", "activity" => "Verify pharmacy - Nilmini Pharmacy"],
    ["time" => "06:10am", "activity" => "Verify pharmacy - Sujatha Pharmacy"]
];

require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php' ?>





<!-- dashbordBody start -->
<div class="dashboard">
    <div class="card green">
        <img src="assets/images/statistics.png" alt="" />
        <p>Registered Pharmacy</p>
        <h2><?= $registeredPharmacies ?></h2>
    </div>
    <div class="card blue">
        <img src="assets/images/computer.png" alt="" />
        <p>Online Users</p>
        <h2><?= $onlineUsers ?></h2>
    </div>
    <div class="card red">
        <img src="assets/images/time-left.png" alt="" />
        <p>Requested Pharmacy</p>
        <h2><?= $requestedPharmacies ?></h2>
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
<!-- dashbordBody end -->


<script>
    /* click cards */
    document.querySelector('.green').addEventListener('click', function() {
        window.location.href = '../pharmacy-details/pharmacy-details.php'
    });

    document.querySelector('.blue').addEventListener('click', function() {
        window.location.href = '../users/users.php'
    });

    document.querySelector('.red').addEventListener('click', function() {
        window.location.href = '../pending/pending-pharmacy.php'
    });
</script>

<?php require_once  BASE_PATH . '/app/views/inc/footer.view.php' ?>