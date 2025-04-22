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
