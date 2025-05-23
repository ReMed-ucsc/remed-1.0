console.log("P:", pharmacyId);

document.addEventListener("DOMContentLoaded", function () {
  // console.log(orderData); // Your PHP data is available here

  const searchInput = document.getElementById("medicine-search");
  const searchResults = document.getElementById("search-results");
  const hiddenInput = document.getElementById("medicine-id");

  searchInput.addEventListener("input", function () {
    const query = searchInput.value;
    if (query.length > 2) {
      // Start searching after 3 characters
      fetch(
        `${API_URL}/medicine/getPharmacyMedicines?search=${query}&pharmacyID=${pharmacyId}`
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
      searchInput.value = event.target.textContent;
      searchInput.dataset.medicineId = medicineId;
      hiddenInput.value = medicineId;
      searchResults.innerHTML = "";

      // Fetch full medicine details
      fetch(`${API_URL}/medicine/getMedicineById?id=${medicineId}`)
        .then((response) => response.json())
        .then((data) => {
          const medicine = data.data;

          // Fill form fields here
          document.getElementById("ProductName").value = medicine.ProductName;
          document.getElementById("Manufacturer").value = medicine.Manufacturer;
          document.getElementById("genericName").value = medicine.GenericName;
          document.getElementById("category").value = medicine.CategoryID;
          document.getElementById("unitPrice").value = medicine.SellingPrice;
          // etc...
        })
        .catch((error) =>
          console.error("Error fetching medicine details:", error)
        );
    }
  });
});

const chatIcon = document.querySelector(".chaticon");
const prescriptionView = document.getElementById("prescriptionView");
const chatView = document.getElementById("chatView");
let isChatOpen = false;

chatIcon.addEventListener("click", () => {
  isChatOpen = !isChatOpen;
  prescriptionView.style.display = isChatOpen ? "none" : "block";
  chatView.style.display = isChatOpen ? "block" : "none";
});

document.getElementById("sendChat")?.addEventListener("click", () => {
  const input = document.getElementById("chatInput");
  const message = input.value.trim();
  if (message) {
    const log = document.getElementById("chatLog");
    const newMsg = document.createElement("div");
    newMsg.textContent = "You: " + message;
    log.appendChild(newMsg);
    input.value = "";
  }
});

//message with dummy data

document.addEventListener("DOMContentLoaded", function () {
  const chatIcon = document.getElementById("chatIcon");
  const prescriptionView = document.getElementById("prescriptionView");
  const chatView = document.getElementById("chatView");
  const chatMessages = document.getElementById("chatMessages");
  const sendBtn = document.getElementById("sendBtn");
  const chatInput = document.getElementById("chatInput");

  let isChatOpen = false;

  console.log(orderData); // Your PHP data is available here

  const orderId = orderData.order.OrderID;
  const medicines = orderData.medicineList;
  const comments = orderData.comments;
  const isViewOnly = orderData.viewOnly;

  comments.sort((a, b) => {
    // Convert createdAt strings to Date objects for comparison
    const dateA = new Date(a.createdAt);
    const dateB = new Date(b.createdAt);
    return dateA - dateB; // Ascending order (oldest first)
  });

  // Populate dummy chat
  comments.forEach((msg) => {
    const sender = msg.sender == "p" ? "pharmacy" : "patient";
    const msgDiv = document.createElement("div");
    msgDiv.classList.add("message", sender);
    msgDiv.textContent = msg.comments;
    chatMessages.appendChild(msgDiv);
  });

  // Toggle chat/prescription view
  chatIcon.addEventListener("click", () => {
    isChatOpen = !isChatOpen;
    prescriptionView.style.display = isChatOpen ? "none" : "block";
    chatView.style.display = isChatOpen ? "block" : "none";
  });

  // Send button action
  sendBtn.addEventListener("click", () => {
    const text = chatInput.value.trim();
    if (text !== "") {
      const msgDiv = document.createElement("div");
      msgDiv.classList.add("message", "pharmacy");
      msgDiv.textContent = text;
      chatMessages.appendChild(msgDiv);
      chatInput.value = "";
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }
  });
});

// Function to send a new message
function sendMessage(text) {
  const token = orderData.authToken;

  // Get the order ID from your order data
  const orderId = orderData.order.OrderID; // assuming you have orderData available

  // Create the request payload
  const payload = {
    OrderID: orderId,
    comments: text,
    sender: "p", // 'p' for pharmacy, assuming that's your convention
  };

  // Make the API call
  fetch(`${API_URL}/order/commentOrder`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${token}`,
    },
    body: JSON.stringify(payload),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      console.log("Message sent successfully:", data);

      // // Add the message to the UI
      // const msgDiv = document.createElement("div");
      // msgDiv.classList.add("message", "pharmacy");
      // msgDiv.textContent = text;
      // chatMessages.appendChild(msgDiv);

      // Scroll to bottom of chat
      chatMessages.scrollTop = chatMessages.scrollHeight;
    })
    .catch((error) => {
      console.error("Error sending message:", error);
      alert("Failed to send message. Please try again.");
    });
}

// Update the send button event listener
sendBtn.addEventListener("click", () => {
  const text = chatInput.value.trim();
  if (text !== "") {
    sendMessage(text);
    chatInput.value = "";
  }
});

// Also update the Enter key press on input field
chatInput.addEventListener("keypress", (event) => {
  if (event.key === "Enter") {
    const text = chatInput.value.trim();
    if (text !== "") {
      sendMessage(text);
      chatInput.value = "";
    }
  }
});
