<?php
// Sample data for demonstration (replace with your own data source or database)
$users = [
    ["id" => "01", "name" => "Anura Perera", "age" => 35, "contact" => "+94 11 223 4455", "email" => "anura.perera@gmail.com", "address" => "45 Galle Road, Colombo 03,Colombo District", "status" => "Online"],
    ["id" => "02", "name" => "Nimalika Silva", "age" => 29, "contact" => "+94 81 238 5523", "email" => "nimalika.silva@yahoo.com", "address" => "12 Kandy Road, Peradeniya, Kandy District", "status" => "Online"],
    ["id" => "03", "name" => "Roshan Jayawardena", "age" => 42, "contact" => "+94 21 221 3344", "email" => "roshan.jaya@outlook.com", "address" => "25 Station Road, Jaffna,Jaffna District", "status" => "Online"],
    ["id" => "04", "name" => "Thilina Fernando", "age" => 28, "contact" => "+94 91 224 5566", "email" => "thilina.fernando@gmail.com", "address" => "34 Matara Road, Galle, Galle District", "status" => "Online"],
    ["id" => "05", "name" => "Kamani Rajapaksha", "age" => 31, "contact" => "+94 52 222 1188", "email" => "kamani.rajapaksha@hotmail.com", "address" => "89 Main Street, Nuwara Eliya, Nuwara Eliya District", "status" => "Online"],
    ["id" => "06", "name" => "Shani Wijesinghe", "age" => 34, "contact" => "+94 11 223 4455", "email" => "shani.wije@gmail.com", "address" => "45 Galle Road, Colombo 03,Colombo District", "status" => "Online"],
    ["id" => "07", "name" => "Asela Rathnayake", "age" => 40, "contact" => "+94 81 238 5523", "email" => "asela.rathnayake@yahoo.com", "address" => "12 Kandy Road, Peradeniya, Kandy District", "status" => "Online"],
    ["id" => "08", "name" => "Pavithra Gunasekara", "age" => 40, "contact" => "+94 91 224 5566", "email" => "pavithra.gunasekara@hotmail.com", "address" => "34 Matara Road, Galle, Galle District", "status" => "Online"]
];

require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';
?>


<!-- Search Box Form -->
<div class="search-container">
    <input type="text" id="searchInput" class="search-box" placeholder="Search here...">
    <img src="<?= ROOT ?>/assets/images/search.png" alt="icon">
    <!-- <button class="search-button" onclick="performSearch()">Search</button> -->
</div>



<!-- Table Structure -->
<div class="details-container">
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['age'] ?></td>
                    <td><?= $user['contact'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['address'] ?></td>
                    <td><span class="status-user"><?= $user['status'] ?></span></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>






<script src="<?= ROOT ?>/assets/js/admin/user.js"></script>
<?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>