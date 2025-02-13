<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/contactUs.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
</head>

<body>

    <?php
    include BASE_PATH . '/app/views/inc/pharmacy/nonRegNavbar.php';
    // include 'Database.php';
    ?>
    <div class="fullpage">
        <div class="container">
            <form method="POST" action="">
                <div class="box">
                    <div class="left">
                        <h2>Contact with Remed</h2>
                        <p>Feel free to reach out to us for any questions, feedback, or assistance. We’re here to help you with your needs and ensure a seamless experience. Connect with us today!</p>
                    </div>
                    <div class="right">
                        <div class="form-group">
                            <label for="contact_no">Contact No:</label>
                            <input type="text" id="contact_no" name="contact_no" placeholder="Enter Pharmacy ID" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" placeholder="Enter Pharmacy Name" required>
                        </div>
                        <div class="form-group">
                            <label for="job_title">Job Title:</label>
                            <input type="text" id="job_title" name="job_title" placeholder="Value">
                        </div>
                        <div class="form-group">
                            <label for="message">What can we help you with?</label>
                            <textarea id="message" name="message" rows="4" placeholder="Enter your message"></textarea>
                        </div>
                        <button type="submit">Submit</button>
                        <div class="footer">
                            <div>
                                <p><strong>Call Us:</strong></p>
                                <p>+947123456721</p>
                                <p>+94783426781</p>
                                <p><strong>Business hours:</strong></p>
                                <p>Monday to Friday: 08 AM - 10 PM</p>
                                <p>Saturdays: 08 AM - 10 PM</p>
                                <p>Sundays: 08 AM - 08 PM</p>
                            </div>
                            <div>
                                <p><strong>Email Us:</strong></p>
                                <p>www.remed123@gmail.com</p>
                                <p><strong>Address:</strong></p>
                                <p>1233/45-A, Araliya Rd.</p>
                                <p>Kingsroad, Kurunegala.</p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>

</body>

</html>