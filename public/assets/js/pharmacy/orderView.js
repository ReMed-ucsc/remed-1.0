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


  const chatIcon = document.querySelector('.chaticon');
  const prescriptionView = document.getElementById('prescriptionView');
  const chatView = document.getElementById('chatView');
  let isChatOpen = false;

  chatIcon.addEventListener('click', () => {
    isChatOpen = !isChatOpen;
    prescriptionView.style.display = isChatOpen ? 'none' : 'block';
    chatView.style.display = isChatOpen ? 'block' : 'none';
  });

  // Optional: Basic message sending (no API yet)
  document.getElementById('sendChat')?.addEventListener('click', () => {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    if (message) {
      const log = document.getElementById('chatLog');
      const newMsg = document.createElement('div');
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
  
    // Dummy messages
    const dummyMessages = [
      { sender: "pharmacy", message: "Hello, we received your prescription." },
      { sender: "patient", message: "Thank you! How long will it take?" },
      { sender: "pharmacy", message: "About 30 minutes. We’ll notify you once ready." }
    ];
  
    // Populate dummy chat
    dummyMessages.forEach(msg => {
      const msgDiv = document.createElement("div");
      msgDiv.classList.add("message", msg.sender);
      msgDiv.textContent = msg.message;
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
  

