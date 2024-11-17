<?php require_once BASE_PATH . '/app/views/inc/header.view.php' ?>
<?php require_once BASE_PATH . '/app/views/inc/navBar.view.php' ?>

<body>
<!-- Search Box Form -->
<div class="search-container">
    <input type="text" id="searchInput" class="search-box" placeholder="Search here...">
    <img src="<?= ROOT ?>/assets/images/search.png" alt="icon">
    <!-- <button class="search-button" onclick="performSearch()">Search</button> -->
</div>


<div class="details-container">
    <table>
        <thead>
            <tr>
                <th>Pharmacy ID</th>
                <th>Pharmacy Name</th>
                <th>Pharmacist Name</th>
                <th>Contact Number</th>
                <th>License</th>
                <th>Approved Date</th>
                <th>Email</th>
                <th>Address</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Sample data array for demonstration (replace with database fetching logic)
            $pharmacies = [
                ['id' => '01', 'name' => 'Medico', 'pharmacist' => 'Mr. Saman', 'contact' => '+94 11 223 4455', 'license' => 'SL-12345-COLO', 'date' => '2024 August 03', 'email' => 'info@medicopharmacy.lk', 'address' => '45 Galle Road, Colombo 03, Colombo District', 'status' => 'Approved'],
                ['id' => '02', 'name' => 'HealthPlus', 'pharmacist' => 'Mr. Nisan', 'contact' => '+94 81 238 5523', 'license' => 'SL-67890-KAND', 'date' => '2024 August 03', 'email' => 'contact@healthplus.lk', 'address' => '12 Kandy Road, Peradeniya, Kandy District', 'status' => 'Approved'],
                ['id' => '03', 'name' => 'HealthPlus', 'pharmacist' => 'Mr. Nawab', 'contact' => '+94 81 238 5523', 'license' => 'SL-67890-KAND', 'date' => '2024 August 03', 'email' => 'contact@healthplus.lk', 'address' => '12 Kandy Road, Peradeniya, Kandy District', 'status' => 'Approved'],
                ['id' => '04', 'name' => 'HealthPlus', 'pharmacist' => 'Mr. Neman', 'contact' => '+94 81 238 5523', 'license' => 'SL-67890-KAND', 'date' => '2024 August 03', 'email' => 'contact@healthplus.lk', 'address' => '12 Kandy Road, Peradeniya, Kandy District', 'status' => 'Approved'],
                ['id' => '05', 'name' => 'HealthPlus', 'pharmacist' => 'Mr. Nuwan', 'contact' => '+94 81 238 5523', 'license' => 'SL-67890-KAND', 'date' => '2024 August 03', 'email' => 'contact@healthplus.lk', 'address' => '12 Kandy Road, Peradeniya, Kandy District', 'status' => 'Approved'],

                // Add more data here...
            ];

            foreach ($pharmacies as $pharmacy) {
                echo "<tr>";
                echo "<td>{$pharmacy['id']}</td>";
                echo "<td>{$pharmacy['name']}</td>";
                echo "<td>{$pharmacy['pharmacist']}</td>";
                echo "<td>{$pharmacy['contact']}</td>";
                echo "<td>{$pharmacy['license']}</td>";
                echo "<td>{$pharmacy['date']}</td>";
                echo "<td>{$pharmacy['email']}</td>";
                echo "<td>{$pharmacy['address']}</td>";
                echo "<td><span class='status {$pharmacy['status']}'>{$pharmacy['status']}</span></td>";
                echo "<td><a href='#?id={$pharmacy['id']}'><img class=\"action edit\" src='../../public/assets/images/pencil.png'/></a>  <a href='#?id={$pharmacy['id']}'><img class=\"action remove\" src='../../public/assets/images/bin.png'/></a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    var ROOT = '<?= ROOT ?>';
</script>

<script src="<?= ROOT ?>/assets/js/admin/pharmacyDetails.js"></script>
<?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>