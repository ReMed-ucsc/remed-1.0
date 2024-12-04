<?php
include BASE_PATH . '/app/views/inc/pharmacy/header.php';
include BASE_PATH . '/app/views/inc/pharmacy/nonRegNavbar.php';
?>


<body>
    <main>

        <div class="content ">
            <div class="background">
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

    <script src="<?= ROOT ?>/assets/js/pharmacy/navbar.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/index.js"></script>

</body>

</html>