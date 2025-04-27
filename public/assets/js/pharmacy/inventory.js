// Example when selecting a result
document
  .getElementById("search-results")
  .addEventListener("click", function (e) {
    if (e.target.classList.contains("result-item")) {
      const medData = JSON.parse(e.target.dataset.medicine); // assuming search result has data-medicine='{"ProductName":"Paracetamol",...}'

      document.querySelector('input[name="productName"]').value =
        medData.ProductName;
      document.querySelector('input[name="manufacturer"]').value =
        medData.Manufacturer;
      document.querySelector('input[name="genericName"]').value =
        medData.GenericName;
      document.querySelector('input[name="category"]').value = medData.Category; // or select field
      document.querySelector('input[name="purchasePrice"]').value =
        medData.UnitPrice;

      // Optional: auto-calculate next batchID
      // fetch('<?= ROOT ?>/inventoryCreate/getNextBatchID') // backend route
      //   .then(res => res.text())
      //   .then(batchID => {
      //     document.querySelector('input[name="batchID"]').value = batchID;
      //   });
    }
  });

//outside button

// document.getElementById('addInventoryBtn').addEventListener('click', function () {
//   const form = document.getElementById('inventoryForm');
//   const formData = new FormData(form);

//   fetch('<?= ROOT ?>/inventoryCreate', {
//     method: 'POST',
//     body: formData
//   })
//   .then(response => response.text())
//   .then(result => {
//     if (result === 'success') {
//       document.getElementById('success-msg').style.display = 'inline';
//       setTimeout(() => {
//         document.getElementById('success-msg').style.display = 'none';
//         form.reset();
//       }, 2000);
//     } else {
//       alert('Error: ' + result);
//     }
//   });
// });

//searchbar
document.addEventListener("DOMContentLoaded", function () {
  // console.log(orderData); // Your PHP data is available here

  const searchInput = document.getElementById("productName");
  const searchResults = document.getElementById("search-results");
  const hiddenInput = document.getElementById("medicine-id");

  searchInput.addEventListener("input", function () {
    const query = searchInput.value;
    if (query.length > 1) {
      // Start searching after 3 characters
      fetch(
        `${API_URL}/medicine/getMedicinesForInventory?search=${query}&pharmacyID=${pharmacyId}`
      )
        .then((response) => response.json())
        .then((data) => {
          searchResults.innerHTML = "";
          data.data.forEach((medicine) => {
            console.log(medicine);
            const div = document.createElement("div");
            div.classList.add("search-result-item");
            div.textContent = `${medicine.ProductName}`;
            div.dataset.medicineId = medicine.ProductID;
            searchResults.appendChild(div);
          });
        })
        .catch((error) => console.error("Error fetching medicines:", error));
    } else {
      searchResults.innerHTML = "";
    }
  });

  searchResults.addEventListener("click", function (event) {
    if (event.target.classList.contains("search-result-item")) {
      const medicineId = event.target.dataset.medicineId;
      console.log(medicineId);
      searchInput.value = event.target.textContent;
      searchInput.dataset.medicineId = medicineId;
      hiddenInput.value = medicineId;
      searchResults.innerHTML = "";

      // Fetch full medicine details
      // fetch(`http://localhost/remed-1.0/api/medicine/getMedicineById?id=${medicineId}`)
      //   .then((response) => response.json())
      //   .then((data) => {
      //     const medicine = data.data;

      //     // Fill form fields here
      //     document.getElementById("productName").value = medicine.ProductName;
      //     document.getElementById("manufacturer").value = medicine.Manufacturer;
      //     document.getElementById("genericName").value = medicine.GenericName;
      //     document.getElementById("category").value = medicine.CategoryID;
      //     document.getElementById("unitPrice").value = medicine.SellingPrice;
      //     // etc...

      //   })
      //   .catch((error) => console.error("Error fetching medicine details:", error));
    }
  });

  //expiry,manufacture,purchase date validations

  document.querySelector("form").addEventListener("submit", function (e) {
    const mfgDate = new Date(
      document.querySelector('[name="manufacturingDate"]').value
    );
    const expDate = new Date(
      document.querySelector('[name="expiryDate"]').value
    );
    const purDate = new Date(
      document.querySelector('[name="purchaseDate"]').value
    );

    if (expDate <= mfgDate) {
      alert("Expiry date must be after manufacturing date.");
      e.preventDefault();
      return;
    }

    if (purDate > expDate) {
      alert("Purchase date must be before expiry date.");
      e.preventDefault();
      return;
    }
  });
});
