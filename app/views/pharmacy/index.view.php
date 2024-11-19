<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Navbar/navbar.css"></link>
    <link rel="stylesheet" href="colours.css"></link>
    <link rel="stylesheet" href="index.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">

</head>
<body>

    <header>
        <?php

        $isRegisteredUser=false;

        if($isRegisteredUser){
            include 'Navbar/reg-navbar.php';
        }else{
            include 'Navbar/non-reg-navbar.php';
        }
    ?>
    </header>

    <main>
        <div class="landing-container">
        <div class="content ">
            <div class = "background">
            <div class="text-section">
                <p>
                    The Remed Online Pharmacy Locator helps pharmacies connect with customers by displaying real-time inventory for easy medication searches. By joining the Remed network, pharmacies increase visibility, attract more customers, and streamline order management, enhancing overall service efficiency and satisfaction
                </p>
                <button id="registrationButton" class="primary-button">Register Now</button><br>
                <button id="loginButton" class="secondary-button">Log In</button>
            </div>
            </div>
        </div>
    </main>

    <script src="Navbar/navbar.js"></script>
    <script src="index.js"></script>
    
</body>
</html>