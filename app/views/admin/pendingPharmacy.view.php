<?php
// Sample data (replace with your actual database or data source)
$pharmacies = [
    ["name" => "Medico", "pharmacist" => "Mr.Saman", "contact" => "+94 11 223 4455", "license" => "SL-12345-COLO", "email" => "info@medicopharmacy.lk", "address" => "45 Galle Road, Colombo 03, Colombo District", "status" => "pending", "onboard" => "Onboard"],
    ["name" => "HealthPlus", "pharmacist" => "Mr.Nuwan", "contact" => "+94 81 238 5523", "license" => "SL-67890-KAND", "email" => "contact@healthplus.lk", "address" => "12 Kandy Road, Peradeniya, Kandy District", "status" => "pending", "onboard" => "Onboard"],
    ["name" => "WellMed", "pharmacist" => "Mr.Srimal", "contact" => "+94 21 221 3344", "license" => "SL-44556-JAFF", "email" => "support@wellmed.lk", "address" => "25 Station Road, Jaffna, Jaffna District", "status" => "pending", "onboard" => "Onboard"],
    ["name" => "LifeCare", "pharmacist" => "Miss. Nilmini", "contact" => "+94 91 224 5566", "license" => "SL-78901-GALL", "email" => "citymed@galle.lk", "address" => "34 Matara Road, Galle, Galle District", "status" => "pending", "onboard" => "Onboard"],
    ["name" => "CityMed", "pharmacist" => "Miss. Mayuri", "contact" => "+94 52 222 1188", "license" => "SL-11223-NUWA", "email" => "lifecare@pharmacy.lk", "address" => "89 Main Street, Nuwara Eliya, Nuwara Eliya District", "status" => "pending", "onboard" => "Onboard"]
];

$search = $_GET['search'] ?? '';


require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';
?>


<!-- Search Box Form -->
<div class="search-container">
    <input type="text" id="searchInput" class="search-box" placeholder="Search here...">
    <img src="<?= ROOT ?>/assets/images/search.png" alt="icon">
</div>


<!-- Table Structure -->
<div class="details-container">
    <table>
        <thead>
            <tr>
                <th>Pharmacy Name</th>
                <th>Pharmacist Name</th>
                <th>Contact Number</th>
                <th>License</th>
                <th>Email</th>
                <th>Address</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pharmacies as $pharmacy): ?>
                <?php if (stripos($pharmacy['name'], $search) !== false): ?>
                    <tr>
                        <td><?= $pharmacy['name'] ?></td>
                        <td><?= $pharmacy['pharmacist'] ?></td>
                        <td><?= $pharmacy['contact'] ?></td>
                        <td><?= $pharmacy['license'] ?></td>
                        <td><?= $pharmacy['email'] ?></td>
                        <td><?= $pharmacy['address'] ?></td>
                        <td class="status-mark">
                            <span class="status <?= $pharmacy['status'] ?>"><?= ucfirst($pharmacy['status']) ?></span>
                            <span class="onboard"><?= $pharmacy['onboard'] ?></span>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script>
    var ROOT = '<?= ROOT ?>';
</script>
<script src="<?= ROOT ?>/assets/js/admin/pendingPharmacy.js"></script>
<?php require_once BASE_PATH . '/app/views/inc/footer.view.php'; ?>