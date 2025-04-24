<?php

require_once BASE_PATH . '/app/views/inc/header.view.php';
require_once BASE_PATH . '/app/views/inc/navBar.view.php' ?>



<body>

    <!-- dashboardBody start -->
    <div class="dashboard">
        <div class="line">
            <div class="card greenA">
                <img src="<?= ROOT ?>/assets/images/statistics.png" alt="" />
                <p>Registered Pharmacy</p>
                <h2 id="count"><?= htmlspecialchars((string) $approved_pharmacy) ?></h2>
            </div>
            <div class="card blue">
                <img src="<?= ROOT ?>/assets/images/computer.png" alt="" />
                <p>Patient</p>
                <h2 id="count"><?= htmlspecialchars((string) $patientCount) ?></h2>
            </div>
            <div class="card red">
                <img src="<?= ROOT ?>/assets/images/time-left.png" alt="" />
                <p>Requested Pharmacy</p>
                <h2 id="count"><?= htmlspecialchars((string) $pending_pharmacy) ?></h2>
            </div>
        </div>

        <div class="line">
            <div class="card yellow">
                <img src="<?= ROOT ?>/assets/images/driver.png" alt="" />
                <p>Total Drivers</p>
                <h2 id="count"><?= htmlspecialchars((string) $approved_drivers) ?></h2>
            </div>
            <div class="card black">
                <img src="<?= ROOT ?>/assets/images/time-left.png" alt="" />
                <p>Requested Drivers</p>
                <h2 id="count"><?= htmlspecialchars((string) $pending_drivers) ?></h2>
            </div>
        </div>

    </div>

    <script>
        var ROOT = '<?= ROOT ?>';

        //Animation for card number counting
        document.addEventListener("DOMContentLoaded", function () {
            const cards = document.querySelectorAll('.card h2');

            cards.forEach((card) => {
                const countTo = parseInt(card.innerText, 10);
                const duration = 2000;
                const interval = 10;
                const increment = Math.ceil(countTo / (duration / interval));
                let currentCount = 0;

                const counter = setInterval(() => {
                    currentCount += increment;
                    if (currentCount >= countTo) {
                        currentCount = countTo;
                        clearInterval(counter);
                    }
                    card.innerText = currentCount;
                }, interval);
            });
        });

    </script>
    <script src="<?= ROOT ?>/assets/js/admin/dashboard.js"></script>

    <?php require_once BASE_PATH . '/app/views/inc/footer.view.php' ?>