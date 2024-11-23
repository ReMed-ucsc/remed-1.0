<?php
// Assuming session has been started on the parent page
$userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : 'userexample123@gmail.com';
$pharmacyName = isset($_SESSION['pharmacy_name']) ? $_SESSION['pharmacy_name'] : 'Healthcare Pharmacy';
?>

<div class="sidebar-part">
  <div class="container">
    <div class="sidebar active">
      <div class="menu-btn">
        <i class="ph-bold ph-caret-left"></i>
      </div>
      <div class="head">
        <div class="user-img">
          <img src="<?= ROOT ?>/assets/images/admin.png" alt="" />
        </div>
        <div class="user-details">
          <p class="title"><?php echo htmlspecialchars($userEmail); ?></p>
          <p class="name"><?php echo htmlspecialchars($pharmacyName); ?></p>
        </div>
      </div>
      <div class="nav">
        <div class="menu">
          <p class="title">Main</p>
          <ul>
            <li>
              <a href="<?= ROOT ?>/dashboardPage">
                <i class="icon ph-bold ph-house-simple"></i>
                <span class="text">Dashboard</span>
              </a>
            </li>
            <li>
              <a href="<?= ROOT ?>/medicine">
                <i class="icon ph-bold ph-user"></i>
                <span class="text">Medicine</span>
                <i class="arrow ph-bold ph-caret-down"></i>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="<?= ROOT ?>/availableMedicine">
                    <span class="text">Available Medicine</span>
                  </a>
                </li>
                <li>
                  <a href="<?= ROOT ?>/nonAvailableMedicine">
                    <span class="text">Non-Available Medicine</span>
                  </a>
                </li>
              </ul>
            </li>
            <!-- <li class="active"> -->
            <li>
              <a href="<?= ROOT ?>/orderMain">
                <i class="icon ph-bold ph-file-text"></i>
                <span class="text">Orders</span>
              </a>
            </li>
            <li>
              <a href="<?= ROOT ?>/inventoryMain">
                <i class="icon ph-bold ph-calendar-blank"></i>
                <span class="text">Inventory</span>
              </a>
            </li>
            <li>
              <a href="<?= ROOT ?>/income">
                <i class="icon ph-bold ph-chart-bar"></i>
                <span class="text">Income</span>
                <i class="arrow ph-bold ph-caret-down"></i>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="#">
                    <span class="text">Earnings</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span class="text">Funds</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span class="text">Declines</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span class="text">Payouts</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="menu">
          <p class="title">Settings</p>
          <ul>
            <li>
              <a href="#">
                <i class="icon ph-bold ph-gear"></i>
                <span class="text">Settings</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="menu">
        <p class="title">Account</p>
        <ul>
          <li>
            <a href="#">
              <i class="icon ph-bold ph-info"></i>
              <span class="text">Help</span>
            </a>
          </li>
          <li>
            <a href="<?= ROOT ?>">
              <i class="icon ph-bold ph-sign-out"></i>
              <span class="text">Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Jquery -->
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"
  integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
  crossorigin="anonymous"></script>
<script src="<?= ROOT ?>/assets/js/pharmacy/sidebar.js"></script>
<script src="<?= ROOT ?>/jquery"></script>