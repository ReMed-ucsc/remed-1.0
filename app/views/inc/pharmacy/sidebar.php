<?php
// Assuming session has been started on the parent page
// $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : 'userexample123@gmail.com';
// $pharmacyName = isset($_SESSION['pharmacy_name']) ? $_SESSION['pharmacy_name'] : 'Healthcare Pharmacy';

$pharmacyID = $_SESSION['user_id'];

$pharmacyModel = new Pharmacy();
$pharmacy = $pharmacyModel->getPharmacyById($pharmacyID);


?>

<!-- <div class="sidebar-part"> -->
<div class="container">
  <div class="sidebar active">
    <div class="menu-btn">
      <i class="ph-bold ph-caret-left"></i>
    </div>
    <div class="head">
      <div class="user-img">
        <img src="<?= ROOT ?>/assets/images/pharmacy logo.png" alt="" />
      </div>
      <div class="user-details">
        <p class="title"><?= htmlspecialchars($pharmacy->email) ?></p>
        <p class="name"><?= htmlspecialchars($pharmacy->name) ?></p>
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
            <a href="<?= ROOT ?>/IncomeView">
              <i class="icon ph-bold ph-currency-dollar"></i>
              <span class="text">Income</span>
            </a>

          </li>
        </ul>
      </div>
      <div class="menu">
        <p class="title">Settings</p>
        <ul>
          <li>
            <a href="<?= ROOT ?>/profilePage">
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
          <a href="<?= ROOT ?>/rulesPage">
            <i class="icon ph-bold ph-info"></i>
            <span class="text">Help</span>
          </a>
        </li>
        <li>
          <a href="<?= ROOT ?>/login/logout" id="logout-link">
            <i class="icon ph-bold ph-sign-out"></i>
            <span class="text">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- </div> -->

<!-- Jquery -->
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"
  integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
  crossorigin="anonymous"></script>
<script src="<?= ROOT ?>/assets/js/pharmacy/sidebar.js"></script>
<script src="<?= ROOT ?>/jquery"></script>