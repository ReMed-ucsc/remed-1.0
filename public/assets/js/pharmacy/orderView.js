document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("medicine-search");
  const searchResults = document.getElementById("search-results");
  const hiddenInput = document.getElementById("medicine-id");

  searchInput.addEventListener("input", function () {
    const query = searchInput.value;
    if (query.length > 2) {
      // Start searching after 3 characters
      fetch(
        `http://localhost/remed-1.0/api/medicine/getMedicines?search=${query}`
      )
        .then((response) => response.json())
        .then((data) => {
          searchResults.innerHTML = "";
          data.data.forEach((medicine) => {
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
      const medicineName = event.target.textContent;
      // Update the input element with the selected medicine's details
      searchInput.value = medicineName;
      searchInput.dataset.medicineId = medicineId;
      // Set the hidden input field's value
      hiddenInput.value = medicineId;
      // Clear the search results
      searchResults.innerHTML = "";
    }
  });
});
