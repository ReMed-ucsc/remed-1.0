<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Page</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/profilePage.css" />
</head>

<body>
    <div class="container">
        <!-- Profile panel -->
        <div class="profile-panel">
            <label for="profilePicInput">
                <img src="<?= ROOT ?>/assets/images/pharmacy logo.png" alt="Pharmacy Profile" class="profile-pic" id="profilePicPreview" />
            </label>
            <input type="file" id="profilePicInput" accept="image/*" style="display: none;" />
            <h2><?= $pharmacyData->name ?></h2>
            <p><?= $pharmacyData->email ?></p>
        </div>


        <!-- Form panel -->
        <div class="form-panel">
            <form id="profile-form" method="POST" action="<?= ROOT ?>/pharmacy/updateProfilePic" enctype="multipart/form-data">
                <div>
                    <label>Pharmacy Name</label>
                    <input type="text" value=<?= $pharmacyData->name ?> disabled />
                </div>
                <div>
                    <label>Pharmacy ID</label>
                    <input type="text" value=<?= $pharmacyData->PharmacyID ?> disabled />
                </div>
                <div>
                    <label>Pharmacist Name</label>
                    <input type="text" value=<?= $pharmacyData->pharmacistName ?> disabled />
                </div>
                <div>
                    <label>License Expiry Date</label>
                    <input type="date" value="2026-12-31" disabled />
                </div>
                <div>
                    <label>Email</label>
                    <input type="text" value=<?= $pharmacyData->email ?> disabled />
                </div>
                <div>
                    <label>Contact</label>
                    <input type="text" value=<?= $pharmacyData->contactNo ?> disabled />
                </div>
                <div>
                    <label>Address</label>
                    <input type="text" value=<?= $pharmacyData->address ?> disabled />
                </div>
                <div>
                    <label>Approved Date</label>
                    <input type="date" value=<?= $pharmacyData->approvedDate ?> disabled />
                </div>

                <div class="button-container">
                    <button type="button" class="button1" id="editBtn">Change Details</button>
                    <button type="button" class="button1" id="changePasswordBtn">Change Password</button>

                </div>
                <button type="button" class="button2" id="removePharmacyBtn"> Remove Account!</button>


            </form>
        </div>
    </div>

    <!-- JS File -->
    <script src="<?= ROOT ?>/assets/js/pharmacy/profilePage.js"></script>
</body>

</html>