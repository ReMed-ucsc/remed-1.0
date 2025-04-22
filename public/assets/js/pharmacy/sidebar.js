$(".menu > ul > li").click(function (e) {
    // remove active from already active
    $(this).siblings().removeClass("active");
    // add active to clicked
    $(this).toggleClass("active");
    // if has sub menu open it
    $(this).find("ul").slideToggle();
    // close other sub menu if any open
    $(this).siblings().find("ul").slideUp();
    // remove active class of sub menu items
    $(this).siblings().find("ul").find("li").removeClass("active");
  });
  
  $(".menu-btn").click(function () {
    $(".sidebar").toggleClass("active");
  });

  document.addEventListener("DOMContentLoaded", function () {
    const logoutLink = document.getElementById("logout-link");
    logoutLink.addEventListener("click", function (event) {
      event.preventDefault(); // Stop the default action
      const confirmLogout = confirm("Are you sure you want to logout?");
      if (confirmLogout) {
        window.location.href = logoutLink.href; // Proceed with logout
      }
    });
  });
  