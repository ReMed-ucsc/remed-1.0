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
            <img src="<?= ROOT ?>/assets/images/pharmacy logo.png" alt="Pharmacy Profile" class="profile-pic" />
            <h2>Remed Pharmacy</h2>
            <p>Colombo Branch</p>
            <div class="rating">★★★★☆</div>
        </div>

        <!-- Form panel -->
        <div class="form-panel">
            <form id="profile-form">
                <div>
                    <label>Pharmacist Name</label>
                    <input type="text" value="Dr. Nimal Perera" disabled />
                </div>
                <div>
                    <label>License Number</label>
                    <input type="text" value="PH123456" disabled />
                </div>
                <div>
                    <label>Issuing Authority</label>
                    <input type="text" value="SLMC" disabled />
                </div>
                <div>
                    <label>License Expiry Date</label>
                    <input type="date" value="2026-12-31" disabled />
                </div>
                <div>
                    <label>Email</label>
                    <input type="text" value="remed@pharma.com" disabled />
                </div>
                <div>
                    <label>Contact</label>
                    <input type="text" value="+94 77 123 4567" disabled />
                </div>
                <div>
                    <label>Address</label>
                    <input type="text" value="123 Galle Road, Colombo" disabled />
                </div>
                <div>
                    <label>Start Date</label>
                    <input type="date" value="2021-05-01" disabled />
                </div>

                <div class="button-container">
                    <button type="button" id="editBtn">Change Details</button>
                    <button type="button" id="changePasswordBtn">Change Password</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JS File -->
    <script src="<?= ROOT ?>/assets/js/pharmacy/profilePage.js"></script>
</body>

</html>