<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form</title>
    <link rel="stylesheet" href="Register-page.css">
    <link rel="stylesheet" href="../Navbar/navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
</head>
<body>

    <?php include '../Navbar/non-reg-navbar.php';
            // include 'Database.php';
    ?>

    <div class="fullpage">
    <div class="container">
        <div class="form-box">
            <div class="form-left">
                <h2>Register</h2>
                <p>Follow the steps to complete your registration.</p>
            </div>
            <div class="form-right">
                <form id="registration-form" action="register.php" method="POST" enctype="multipart/form-data">
                    <!-- Step 1: Email -->
                    <div id="step1" class="step">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Enter your email">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 2: Password -->
                    <div id="step2" class="step" style="display: none;">
                        <div class="form-row passwords-row">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password"  name="password" placeholder="Create a password">
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" id="confirm-password" placeholder="Confirm your password">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 3: Address and Contact Number -->
                    <div id="step3" class="step" style="display: none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="pharmacy-address">Pharmacy Address</label>
                                <input type="text" id="pharmacy-address" name="pharmacy-address" placeholder="Enter pharmacy address">
                            </div>
                            <div class="form-group">
                                <label for="contact-number">Contact Number</label>
                                <input type="text" id="contact-number" name="contact-number" placeholder="Enter contact number">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 4: Names -->
                    <div id="step4" class="step" style="display: none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="pharmacy-name">Pharmacy Name</label>
                                <input type="text" id="pharmacy-name" name="pharmacy-name" placeholder="Enter pharmacy name">
                            </div>
                            <div class="form-group">
                                <label for="pharmacist-name">Pharmacist Name</label>
                                <input type="text" id="pharmacist-name" name="pharmacist-name" placeholder="Enter pharmacist name">
                            </div>
                        </div>
                    </div>

                    <!-- Step 5: License Photo Upload -->
                    <div id="step5" class="step" style="display: none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="license-photo">Upload License Photo</label>
                                <input type="file" id="license-photo" name="license-photo" accept="image/*">
                            </div>
                        </div>
                    </div>

                    
                    <div class="submit-buttons">
                        <button type="button" id="next-button">Next</button>
                        <button type="submit" id="submit-button" style="display: none;">Submit</button>
                        <button type="button" id="back-button" style="display: none;">Back</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src="Registration-page.js"></script>
</body>
</html>
