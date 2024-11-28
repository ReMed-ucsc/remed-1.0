// Function to handle search logic
function performSearch() {
  // Get the search input value
  var query = document.getElementById("searchInput").value;

  // Basic validation for empty input
  if (query.trim() === "") {
    alert("Please enter a search query.");
    return;
  }

  // Simulating search (you can replace this part with actual search logic)
  var results = "You searched for: " + query;

  // Display the search results
  document.getElementById("searchResults").innerText = results;
}
document.querySelector(".edit").addEventListener("click", function () {
  window.location.href = ROOT + "/admin/editPharmacy";
});
document.querySelector(".remove").addEventListener("click", function () {
  window.location.href = ROOT + "/admin/removePharmacy";
});


function confirmDelete(deleteUrl) {
  const userConfirmed = confirm(
    "Are you sure you want to delete this pharmacy?"
  );
  if (userConfirmed) {
    // Redirect to the delete URL
    window.location.href = deleteUrl;
  } else {
    // Reload the page if the user cancels
    window.location.reload();
  }
}
