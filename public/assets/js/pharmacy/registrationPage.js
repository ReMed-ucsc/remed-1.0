let currentStep = 1;
const totalSteps = 5;

document.getElementById("next-button").addEventListener("click", function () {
  if (currentStep === 1) {
    const email = document.getElementById("email").value;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!email.match(emailPattern)) {
      alert("Please enter a valid email address.");
      return;
    }
  }

  if (currentStep === 2) {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    const lengthValid = password.length >= 8;
    const hasNumber = /\d/.test(password);
    const hasSpecialChar = /[!@#$%^&*]/.test(password);

    if (!lengthValid || !hasNumber || !hasSpecialChar) {
      alert(
        "Password must be at least 8 characters, contain a number and a special character."
      );
      return;
    }

    if (password !== confirmPassword) {
      alert("Passwords do not match.");
      return;
    }
  }

  if (currentStep === 3) {
    const pharmacyAddress = document.getElementById("pharmacy-address").value;
    const contactNumber = document.getElementById("contact-number").value;

    if (!pharmacyAddress || !contactNumber) {
      alert("Please fill in all required fields.");
      return;
    }
  }

  if (currentStep === 4) {
    const pharmacyName = document.getElementById("pharmacy-name").value;
    const pharmacistName = document.getElementById("pharmacist-name").value;

    if (!pharmacyName || !pharmacistName) {
      alert("Please fill in all required fields.");
      return;
    }
  }

  showStep(currentStep + 1);
});

document.getElementById("back-button").addEventListener("click", function () {
  showStep(currentStep - 1);
});

function showStep(step) {
  if (step < 1 || step > totalSteps) return;

  document.getElementById("step" + currentStep).style.display = "none";
  document.getElementById("step" + step).style.display = "block";

  currentStep = step;

  if (currentStep === totalSteps) {
    document.getElementById("submit-button").style.display = "block";
    document.getElementById("next-button").style.display = "none";
  } else {
    document.getElementById("submit-button").style.display = "none";
    document.getElementById("next-button").style.display = "block";
  }

  if (currentStep > 1) {
    document.getElementById("back-button").style.display = "inline-block";
  } else {
    document.getElementById("back-button").style.display = "none";
  }
}

document
  .getElementById("submit-button")
  .addEventListener("click", function (event) {
    event.preventDefault();

    const formData = new FormData(document.getElementById("registration-form"));

    console.log(formData);

    fetch("http://localhost/remed-1.0/public/registerPage/apiSubmit", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          window.location.href =
            "http://localhost/remed-1.0/public/login?registered";
          //   console.log(data.result);
        } else {
          alert(data.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

showStep(1);


  // Alternatively, you can target your input element by ID
  // Replace querySelector('input[name="search_input"]') with getElementById('search_input') 
    // and insert id="search_input" in your form's input field
  // var searchInput = document.querySelector('input[name="pharmacy-address"]');
  // document.addEventListener('DOMContentLoaded', function () {
  //   var autocomplete = new google.maps.places.Autocomplete(searchInput, { 
  //     types: ['geocode']
  //   }); 
  //   autocomplete.addListener('place_changed', function () { 
  //     var near_place = autocomplete.getPlace(); 
  //   });
  // });


  document.addEventListener('DOMContentLoaded', function() {
    // Check if Google Maps API is loaded
    if (typeof google === 'object' && typeof google.maps === 'object') {
        initMap();
    } else {
        console.error('Google Maps API not loaded');
    }
});

function initMap() {
    var searchInput = document.getElementById('pharmacy-address');

    if (!searchInput) {
        console.error('Address input field not found');
        return;
    }

    var latitudeField = document.getElementById('latitude');
    var longitudeField = document.getElementById('longitude');

    try {
        // Initialize the autocomplete for Sri Lanka
        var autocomplete = new google.maps.places.Autocomplete(searchInput, {
            types: ['address'],
            componentRestrictions: {
                country: 'lk'
            } // 'lk' is the country code for Sri Lanka
        });

        // When a place is selected, populate the lat/lng fields
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();

            // Verify that we got a valid place with geometry
            if (!place.geometry) {
                console.error("Autocomplete's returned place contains no geometry");
                return;
            }

            // Get the location data
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();

            // Set the values in the hidden fields
            latitudeField.value = lat;
            longitudeField.value = lng;

            console.log("Selected location:", place.formatted_address);
            console.log("Latitude:", lat);
            console.log("Longitude:", lng);
        });
    } catch (error) {
        console.error('Error initializing Google Places Autocomplete:', error);
    }
}