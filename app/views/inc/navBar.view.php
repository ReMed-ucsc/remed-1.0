<!-- Navbar start-->
<header class="navbar">
    <div class="navbar-left">
        <a href="<?= ROOT ?>/admin/dashboard">
            <img class="logo" src="<?= ROOT ?>/assets/images/ReMeD.png" alt="logo" />
        </a>
    </div>

    <div class="navbar-right">
        <img class="bell" src="<?= ROOT ?>/assets/images/bell-icon.png" alt="notification" />
        
        <a href="<?=ROOT?>/admin/Profile"><img class="user" src="<?= ROOT ?>/assets/images/TestAccount.png" alt="user" /></a>
</header>
<!-- Navbar end-->

<!-- Dropdown menu start-->
<div id="dropdown-menu" class="dropdown-menu">

    <div class="tab">
        <img src="<?= ROOT ?>/assets/images/home.png" alt="" />
        <a href="<?= ROOT ?>/admin"> Home</a>
    </div>


    <div class="dropdown-item">
        <div class="tab">
            <img src="<?= ROOT ?>/assets/images/drugs.png" alt="pharmacy" />
            <a href="#" id="pharmacy-menu"> Pharmacy</a>
            <img class="arrow" src="<?= ROOT ?>/assets/images/Arrow.png" alt="" />
        </div>

        <!-- Submenu start-->
        <div id="pharmacy-submenu" class="submenu">
            <div class="tab">
                <img src="<?= ROOT ?>/assets/images/Vector.png" alt="add" />
                <a href="<?= ROOT ?>/admin/newPharmacy"> Add Pharmacy</a>
            </div>

        </div>
        <!-- Submenu start-->

    </div>


    <div class="tab">
        <img src="<?= ROOT ?>/assets/images/user.png" alt="user" />
        <a href="<?= ROOT ?>/admin/user">User</a>
    </div>


    <div class="dropdown-item">
        <div class="tab">
            <img src="<?= ROOT ?>/assets/images/setting.png" alt="setting" />
            <a href="#" id="settings-menu"> Settings </a>
            <img class="arrow" src="<?= ROOT ?>/assets/images/Arrow.png" alt="" />
        </div>
        <!-- Submenu start-->
        <div id="settings-submenu" class="submenu">
            <div class="tab">
                <img src="<?= ROOT ?>/assets/images/settings.png" alt="" />
                <a href="<?= ROOT ?>/admin/general">General Settings</a>
            </div>
            <div class="tab">
                <img src="<?= ROOT ?>/assets/images/UserManagement.png" alt="" />
                <a href="<?= ROOT ?>/admin/accountManage"> User Management</a>
            </div>
            <div class="tab">
                <img src="<?= ROOT ?>/assets/images/policy.png" alt="" />
                <a href="<?= ROOT ?>/admin/legal"> Legal & Compliance</a>
            </div>
        </div>
        <!-- Submenu end-->
    </div>

    <div class="bottom">
        <img src="<?= ROOT ?>/assets/images/ReMeD.png" alt="">
        <a href="#">ONLINE PHARMACY LOCATOR AND MEDICINE TRACKER</a>
    </div>
</div>
<!-- Dropdown menu end-->

<!-- <div id="profile" class="profile">
    <div class="profile-item">
        <a href="<?=ROOT?>/admin/Profile"><img src="<?= ROOT ?>/assets/images/admin.png" alt="" /></a>
        <div class="details">
            <h4>ADMINISTRATOR</h4>
            <p>admin@gmail.com</p>
        </div>
        <div class="tab">
            <img src="<?= ROOT ?>/assets/images/setting.png" alt="" />
            <a href="<?= ROOT ?>/admin/login/edit/">Setting</a>
        </div>
        <div class="tab">
            <img src="<?= ROOT ?>/assets/images/logout.png" alt="" />
            <a href="<?= ROOT ?>/admin/login/logout">Logout</a>
        </div>
    </div>
</div> -->
<!-- profile end -->

<!-- notification start -->
<div id="notification" class="notification">
    <div class="notifi-head">
        <h3>Notification</h3>
    </div>
    <div class="notifi-item">
        <p>Empty</p>
    </div>
</div>
<!-- notification end -->

<script>
    // JavaScript to toggle the dropdown menu visibility
    // document.querySelector('.menu').addEventListener('click', function(event) {
    //     event.stopPropagation(); // Prevent the click event from bubbling up to the document
    //     var dropdown = document.getElementById('dropdown-menu');
    //     if (dropdown.style.display === 'none' || dropdown.style.display === '') {
    //         dropdown.style.display = 'block';
    //     } else {
    //         dropdown.style.display = 'none';
    //     }
    // });

    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById('dropdown-menu');
        if (dropdown.style.display === 'block' && !dropdown.contains(event.target) && !event.target.matches('.menu')) {
            dropdown.style.display = 'none';
        }
    });

    document.getElementById('pharmacy-menu').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default anchor click behavior
        var submenu = document.getElementById('pharmacy-submenu');
        if (submenu.style.display === 'none' || submenu.style.display === '') {
            submenu.style.display = 'block';
        } else {
            submenu.style.display = 'none';
        }
    });

    document.getElementById('settings-menu').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default anchor click behavior
        var submenu = document.getElementById('settings-submenu');
        if (submenu.style.display === 'none' || submenu.style.display === '') {
            submenu.style.display = 'block';
        } else {
            submenu.style.display = 'none';
        }
    });

    /*  show profile */
    document.querySelector('.user').addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent the click event from bubbling up to the document
        var dropdown = document.getElementById('profile');
        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    });

    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById('profile');
        if (dropdown.style.display === 'block' && !dropdown.contains(event.target) && !event.target.matches('.user')) {
            dropdown.style.display = 'none';
        }
    });

    /* show notification */
    document.querySelector('.bell').addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent the click event from bubbling up to the document
        var dropdown = document.getElementById('notification');
        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    });

    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById('notification');
        if (dropdown.style.display === 'block' && !dropdown.contains(event.target) && !event.target.matches('.bell')) {
            dropdown.style.display = 'none';
        }
    });

</script>