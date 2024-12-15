<?php
// Sample data for demonstration (replace with your own data source or database)
$drivers = [
    ["name" => "Ruwan kumara", "contact" => "+94 11 223 4455", "delivery" => "5pm - 8pm", "email" => "info@medicodrivers.lk", "address" => "45 Galle Road, Colombo 03, Colombo District", "status" => "online"],
    ["name" => "Sachintha Pranandu", "contact" => "+94 81 238 5523", "delivery" => "Full time", "email" => "contact@healthplus.lk", "address" => "12 Kandy Road, Peradeniya, Kandy District", "status" => "online"],
    ["name" => "Alex david",  "contact" => "+94 21 221 3344", "delivery" => "5pm - 8pm", "email" => "support@wellmed.lk", "address" => "25 Station Road, Jaffna, Jaffna District", "status" => "online"],
    ["name" => "Achindu Hewage", "contact" => "+94 91 224 5566", "delivery" => "5pm - 8pm", "email" => "citymed@galle.lk", "address" => "34 Matara Road, Galle, Galle District", "status" => "online"],
    ["name" => "Upali", "contact" => "+94 52 222 1188", "delivery" => "delivery", "email" => "lifecare@drivers.lk", "address" => "89 Main Street, Nuwara Eliya, Nuwara Eliya District", "status" => "online"]
];
$search = $_GET['search'] ?? '';

require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';
?>

<body>
    <!-- Search Box Form -->
    <div class="above-table">
        <div class="search-container">
            <input type="text" id="searchInput" class="search-box" placeholder="Search here...">
            <img src="<?= ROOT ?>/assets/images/search.png" alt="icon">
            <!-- <button class="search-button" onclick="performSearch()">Search</button> -->
        </div>
        <div>
            <a class="add-btn" href="<?= ROOT ?>/admin/newDriver/"><img src="<?= ROOT ?>/assets/images/add.png" alt="" style="width:30px; height:auto; margin-right:5px;">Add newDriver</a>
        </div>

    </div>


    <!-- Table Structure -->
    <div class="details-container">
        <table>
            <thead>
                <tr>
                    <th>Driver Name</th>
                    <th>Contact Number</th>
                    <th>Delivery Time</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($drivers as $driver): ?>
                    <?php if (stripos($driver['name'], $search) !== false): ?>
                        <tr>
                            <td><?= $driver['name'] ?></td>
                            <td><?= $driver['contact'] ?></td>
                            <td><?= $driver['delivery'] ?></td>
                            <td><?= $driver['email'] ?></td>
                            <td><?= $driver['address'] ?></td>
                            <td><span class="status-user"><?= $driver['status'] ?></span></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>






    <script src="<?= ROOT ?>/assets/js/admin/user.js"></script>
    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>