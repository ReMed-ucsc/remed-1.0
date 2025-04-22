// Example when selecting a result
document.getElementById('search-results').addEventListener('click', function(e) {
    if (e.target.classList.contains('result-item')) {
      const medData = JSON.parse(e.target.dataset.medicine); // assuming search result has data-medicine='{"ProductName":"Paracetamol",...}'
  
      document.querySelector('input[name="ProductName"]').value = medData.ProductName;
      document.querySelector('input[name="Manufacturer"]').value = medData.Manufacturer;
      document.querySelector('input[name="genericName"]').value = medData.GenericName;
      document.querySelector('input[name="category"]').value = medData.Category; // or select field
      document.querySelector('input[name="purchasePrice"]').value = medData.UnitPrice;
      
      // Optional: auto-calculate next batchID
      fetch('<?= ROOT ?>/inventoryCreate/getNextBatchID') // backend route
        .then(res => res.text())
        .then(batchID => {
          document.querySelector('input[name="batchID"]').value = batchID;
        });
    }
  });
  

  //outside button


document.getElementById('addInventoryBtn').addEventListener('click', function () {
  const form = document.getElementById('inventoryForm');
  const formData = new FormData(form);

  fetch('<?= ROOT ?>/inventoryCreate', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(result => {
    if (result === 'success') {
      document.getElementById('success-msg').style.display = 'inline';
      setTimeout(() => {
        document.getElementById('success-msg').style.display = 'none';
        form.reset();
      }, 2000);
    } else {
      alert('Error: ' + result);
    }
  });
});

