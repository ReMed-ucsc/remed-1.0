<!-- Navbar start-->
<header class="navbar">
    <div class="navbar-left">
        <a href="<?= ROOT ?>/admin/dashboard">
            <img class="logo" src="<?= ROOT ?>/assets/images/ReMeD.png" alt="logo" />
        </a>
    </div>

    <div class="navbar-right">
        <img class="bell" src="<?= ROOT ?>/assets/images/bell-icon.png" alt="notification" />

        <a href="<?= ROOT ?>/admin/Profile"><img class="user" src="<?= ROOT ?>/assets/images/TestAccount.png"
                alt="user" /></a>
    </div>
</header>
<!-- Navbar end-->

<!-- notification start -->
<div id="notification" class="notification">
    <div class="notifi-head">
        <h3>Notification</h3>
    </div>
    <div class="notifi-item">
        <?php if (!empty($notification) || !empty($notificationDriver)): ?>
            
            <?php if (!empty($notification)): ?>
                <?php foreach ($notification as $msg): ?>
                    <?php if ($msg): ?>
                        <a href="<?= ROOT ?>/admin/PendingPharmacy/onbordPharmacy/<?= htmlspecialchars($msg->PharmacyID) ?>"
                            class="notifi-link">
                            <?= htmlspecialchars($msg->name) ?> is in the waiting queue.
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($notificationDriver)): ?>
                <?php foreach ($notificationDriver as $msgDriver): ?>
                    <?php if ($msgDriver): ?>
                        <a href="<?= ROOT ?>/admin/PendingDriver/OnboardDrivers/<?= htmlspecialchars($msgDriver->driverId) ?>"
                            class="notifi-link">
                            <?= htmlspecialchars($msgDriver->driverName) ?> is in the waiting queue.
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

        <?php else: ?>
            <p>No pending notifications</p>
        <?php endif; ?>
    </div>
</div>

<!-- notification end -->

<script>
    /* show notification */
    document.querySelector('.bell').addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent the click event from bubbling up to the document
        var dropdown = document.getElementById('notification');
        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    });

    document.addEventListener('click', function (event) {
        var dropdown = document.getElementById('notification');
        if (dropdown.style.display === 'block' && !dropdown.contains(event.target) && !event.target.matches('.bell')) {
            dropdown.style.display = 'none';
        }
    });
    document.querySelectorAll('.notifi-link').forEach(link => {
        link.addEventListener('click', function () {
            document.getElementById('notification').style.display = 'none';
        });
    });


</script>
<!-- <script>
    document.querySelector('.bell').addEventListener('click', function (event) {
        event.stopPropagation();
        var dropdown = document.getElementById('notification');

        // Toggle display
        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
            dropdown.style.display = 'block';

            // Load notifications using AJAX
            fetch('<?= ROOT ?>/admin/Notification')
                .then(response => response.text())
                .then(data => {
                    dropdown.innerHTML = `<div class="notifi-head"><h3>Notification</h3></div>` + data;
                });
        } else {
            dropdown.style.display = 'none';
        }
    });

    document.addEventListener('click', function (event) {
        var dropdown = document.getElementById('notification');
        if (dropdown.style.display === 'block' && !dropdown.contains(event.target) && !event.target.matches('.bell')) {
            dropdown.style.display = 'none';
        }
    });
</script> -->