<?php
require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php';
?>

<body>
    <div class="search-container">
        <form id="search-form">
            <input type="text" id="searchInput" name="search" class="search-box" placeholder="Search here..." value="<?php if (isset($_GET['search'])) { echo htmlspecialchars($_GET['search']);} ?>">
            <button class="search-button" type="submit" onclick="performSearch()">Search</button>
        </form>

    </div>



    <div class="details-container">
        <table class="table-container">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patient as $patient_details): ?>
                    <tr>
                        <td><?= htmlspecialchars($patient_details->PatientID) ?></td>
                        <td><?= htmlspecialchars($patient_details->patientName) ?></td>
                        <td><?= htmlspecialchars($patient_details->gender) ?></td>
                        <td><?= htmlspecialchars($patient_details->dob) ?></td>
                        <td><?= htmlspecialchars($patient_details->contact) ?></td>
                        <td><?= htmlspecialchars($patient_details->address) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>






    <script src="<?= ROOT ?>/assets/js/admin/user.js"></script>
    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>