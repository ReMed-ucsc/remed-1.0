/* click cards */
document.querySelector(".greenA").addEventListener("click", function () {
  window.location.href = ROOT + "/admin/pharmacyDetails";
});

document.querySelector(".blue").addEventListener("click", function () {
  window.location.href = ROOT + "/admin/user";
});

document.querySelector(".red").addEventListener("click", function () {
  window.location.href = ROOT + "/admin/pendingPharmacy";
});

document.querySelector(".yellow").addEventListener("click", function () {
  window.location.href = ROOT + "/admin/driverDetails";
});

document.querySelector(".black").addEventListener("click", function () {
    window.location.href = ROOT + "/admin/pendingDriver";
  });

//Animation for card number counting
document.addEventListener("DOMContentLoaded", function () {
  const cards = document.querySelectorAll(".card h2");
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
