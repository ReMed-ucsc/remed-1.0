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
require_once BASE_PATH . '/app/views/inc/navBar.view.php';
?>

<body>
    <h2 class="page-title">Onboard New Pharmacy</h2>
    <div class="details-container">

        <form id="registration-form" class="form-container" action="" method="POST" enctype="multipart/form-data">
            <div class="Form">
                <div>
                    <label for="pharmacyName">Pharmacy Name:</label>
                    <input class="Input" type="text" id="pharmacyName" name="name" placeholder="Enter pharmacy name">
                    <?php if (!empty($data['errors']['name'])): ?>
                        <p style="color:red; margin-top:-30px; margin-bottom:20px">
                            <?= htmlspecialchars($data['errors']['name']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="pharmacistName">Pharmacist's Name:</label>
                    <input class="Input" type="text" id="pharmacistName" name="pharmacistName"
                        placeholder="Enter pharmacist's name">
                    <?php if (!empty($data['errors']['pharmacistName'])): ?>
                        <p style="color:red; margin-top:-30px; margin-bottom:20px">
                            <?= htmlspecialchars($data['errors']['pharmacistName']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="licenseNumber">License Number:</label>
                    <input class="Input" type="text" id="licenseNumber" name="RegNo" placeholder="Enter license">
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
                    <input class="Input" type="text" id="email" name="email" placeholder="Enter email">
                    <?php if (!empty($data['errors']['email'])): ?>
                        <p style="color:red; margin-top:-30px; margin-bottom:20px">
                            <?= htmlspecialchars($data['errors']['email']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="contactNo">Contact Number:</label>
                    <input class="Input" type="text" id="contactNo" name="contactNo" placeholder="Enter contact number">
                    <?php if (!empty($data['errors']['contactNo'])): ?>
                        <p style="color:red; margin-top:-30px; margin-bottom:20px">
                            <?= htmlspecialchars($data['errors']['contactNo']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="address">Pharmacy Address:</label>
                    <input class="Input" type="text" id="pharmacy-address" name="pharmacy-address"
                        placeholder="Enter pharmacy address">
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
                <div>
                    <label for="document">NMRA Report:</label>
                    <input class="Input" type="file" id="document" name="document">
                    <?php if (!empty($data['errors']['document'])): ?>
                        <p style="color:red; margin-top:-30px; margin-bottom:20px">
                            <?= htmlspecialchars($data['errors']['document']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div>
                    <button type="submit" class="btn-green">Save</button>
                    <button type="button" class="btn-red" onclick="window.history.back()">Cancel</button>
                </div>
            </div>


        </form>
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
                var autocomplete = new google.maps.places.Autocomplete(searchInput, {
                    types: ['address'],
                    componentRestrictions: {
                        country: 'lk'
                    } 
                });

                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();

                    if (!place.geometry) {
                        console.error("Autocomplete's returned place contains no geometry");
                        return;
                    }

                    var lat = place.geometry.location.lat();
                    var lng = place.geometry.location.lng();

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

    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php'; ?>
</body>