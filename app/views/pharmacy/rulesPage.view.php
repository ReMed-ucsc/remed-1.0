<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rules and Regulations</title>
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
        <!-- <?php show($legalPolicy[0]->terms_and_conditions) ?> -->
        <div class="form-panel">
            <!-- <pre><?php print_r($legalPolicy); ?></pre> -->

            <p><?= htmlspecialchars($legalPolicy[0]->terms_and_conditions) ?></p>
        </div>
    </div>

    <!-- JS File -->
    <script src="<?= ROOT ?>/assets/js/pharmacy/profilePage.js"></script>
</body>

</html>