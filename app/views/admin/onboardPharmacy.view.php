<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - ReMed</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style.css">
    <script async src="https://maps.googleapis.com/maps/api/js?key=<?= MAPAPI ?>&libraries=places&callback=initMap">
    </script>
</head>

<?php
require_once BASE_PATH . '/app/views/inc/navBar.view.php'
    ?>

<body>
    <h2 class="page-title">Onboard Pharmacy Details</h2>
    <div class="onboard-container">



        <form action="" method="POST" enctype="multipart/form-data">
            <div class="onboard-top">
                <div class="Form">
                    <div>
                        <label for="pharmacyName">Pharmacy Name:</label>
                        <input class="Input" type="text" id="pharmacyName" name="name" placeholder="Enter pharmacy name"
                            value="<?= htmlspecialchars($pharmacy->name) ?>">
                        <?php if (!empty($data['errors']['name'])): ?>
                            <p style="color:red; margin-top:-30px; margin-bottom:20px">
                                <?= htmlspecialchars($data['errors']['name']) ?>
                            </p>
                        <?php endif; ?>

                    </div>

                    <div>
                        <label for="pharmacistName">Pharmacist's Name:</label>
                        <input class="Input" type="text" id="pharmacistName" name="pharmacistName"
                            placeholder="Enter pharmacist's name"
                            value="<?= htmlspecialchars($pharmacy->pharmacistName) ?>">
                        <?php if (!empty($data['errors']['pharmacist'])): ?>
                            <p style="color:red; margin-top:-30px; margin-bottom:20px">
                                <?= htmlspecialchars($data['errors']['pharmacist']) ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="license">License Number:</label>

                        <input class="Input" type="text" id="license" name="RegNo" placeholder="Enter license"
                            value="<?= htmlspecialchars($pharmacy->RegNo) ?>" readonly>
                        <?php if (!empty($data['errors']['RegNo'])): ?>
                            <p style="color:red; margin-top:-30px; margin-bottom:20px">
                                <?= htmlspecialchars($data['errors']['RegNo']) ?>
                            </p>
                        <?php endif; ?>

                    </div>

                </div>

                <div class="Form">
                    <div>
                        <label for="email">Email:</label>
                        <input class="Input" type="email" id="email" name="email" placeholder="Enter email"
                            value="<?= htmlspecialchars($pharmacy->email) ?>">
                        <?php if (!empty($data['errors']['email'])): ?>
                            <p style="color:red; margin-top:-30px; margin-bottom:20px">
                                <?= htmlspecialchars($data['errors']['email']) ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="contactNo">Contact Number:</label>
                        <input class="Input" type="text" id="contactNo" name="contactNo" maxlength="10" minlength="10"
                            placeholder="Enter contact number" value="<?= htmlspecialchars($pharmacy->contactNo) ?>">
                        <?php if (!empty($data['errors']['contactNo'])): ?>
                            <p style="color:red; margin-top:-30px; margin-bottom:20px">
                                <?= htmlspecialchars($data['errors']['contactNo']) ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="address">Pharmacy Address:</label>
                        <input class="Input" type="text" id="pharmacy-address" name="pharmacy-address"
                            placeholder="Enter pharmacy address" value="<?= htmlspecialchars($pharmacy->address) ?>">

                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                        <?php if (!empty($data['errors']['longitude'])): ?>
                            <p style="color:red; margin-top:-30px; margin-bottom:20px">
                                <?= htmlspecialchars($data['errors']['longitude']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="Form">

                    <div class="license-document">
                        <lable for="document">License:</lable>
                        <?php
                        $licenseFile = htmlspecialchars($pharmacy->license);
                        $licenseUrl = "http://localhost/remed-1.0/uploads/license/$licenseFile";

                        $fileExtension = strtolower(pathinfo($licenseFile, PATHINFO_EXTENSION));

                        if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                            echo "<img class='license' src='$licenseUrl' alt='License Image' style='width: 100%; max-height: 300px;' />";
                        } elseif ($fileExtension === 'pdf') {
                            echo "<embed class='license' src='$licenseUrl' type='application/pdf' width='100%' height='300px' />";
                        } else {
                            echo "License file format not supported.";
                        }

                        $downloadIcon = ROOT . "/assets/images/downloading.png"; // move PHP out of echo string
                        echo "<br><a href='$licenseUrl' download class='download'><img src='$downloadIcon' alt='download' style='height: 24px;' /></a>";
                        ?>

                    </div>
                </div>
            </div>
            <div class="onboard-bottom">
                <div>
                    <div>
                        <label for="document">NMRA Report:</label>
                        <input class="Input" type="file" id="document" name="document">
                        <?php if (!empty($data['errors']['document'])): ?>
                            <p style="color:red; margin-top:-30px; margin-bottom:20px">
                                <?= htmlspecialchars($data['errors']['document']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn-green">OnBoard</button>
                </div>
            </div>

        </form>
        <div>
            <a class="reject"
                href="<?= ROOT ?>/admin/PendingPharmacy/reject/<?= htmlspecialchars($pharmacy->PharmacyID) ?>">Reject</a>
        </div>
    </div>
    <script>
        function initMap() {
            var searchInput = document.getElementById('pharmacy-address');

            if (!searchInput) {
                console.error('Address input field not found');
                return;
            }

            var latitudeField = document.getElementById('latitude');
            var longitudeField = document.getElementById('longitude');

            try {
                // Initialize the autocomplete for Sri Lanka
                var autocomplete = new google.maps.places.Autocomplete(searchInput, {
                    types: ['address'],
                    componentRestrictions: {
                        country: 'lk'
                    } // 'lk' is the country code for Sri Lanka
                });

                // When a place is selected, populate the lat/lng fields
                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();

                    // Verify that we got a valid place with geometry
                    if (!place.geometry) {
                        console.error("Autocomplete's returned place contains no geometry");
                        return;
                    }

                    // Get the location data
                    var lat = place.geometry.location.lat();
                    var lng = place.geometry.location.lng();

                    // Set the values in the hidden fields
                    latitudeField.value = lat;
                    longitudeField.value = lng;

                    console.log("Selected location:", place.formatted_address);
                    console.log("Latitude:", lat);
                    console.log("Longitude:", lng);
                });
            } catch (error) {
                console.error('Error initializing Google Places Autocomplete:', error);
            }
        }
    </script>
    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>
</body>