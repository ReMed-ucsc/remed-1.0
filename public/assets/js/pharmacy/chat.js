let senderId = 1; // Pharmacy ID
let receiverId = null; // Selected Patient ID
const hide_chat = document.getElementById('hide-chat');
const chat_container = document.getElementById('chat'); // Corrected id

chat_container.style.display = 'none';

hide_chat.addEventListener('click', function() {
    if (chat_container.style.display === 'none') {
        chat_container.style.display = 'block';
    } else {
        chat_container.style.display = 'none';
    }
});

// Populate Patient List Dynamically
// Example patients array with profile pictures
const patients = [
    { id: 2, name: "John Doe", profilePicture: "assets/john.png" },
    { id: 3, name: "Jane Smith", profilePicture: "assets/jane.png" },
    { id: 4, name: "Mark Wilson", profilePicture: "assets/mark.png" }
];

const userList = document.getElementById("user-list");

patients.forEach(patient => {
    const li = document.createElement("li");
    li.classList.add("patient-item");

    // Add profile picture
    const img = document.createElement("img");
    img.src = patient.profilePicture;
    img.alt = `${patient.name}'s Profile Picture`;
    img.classList.add("patient-image");

    // Add patient name
    const nameSpan = document.createElement("span");
    nameSpan.textContent = patient.name;
    nameSpan.classList.add("patient-name");

    // Add click event to select the patient
    li.addEventListener("click", () => {
        receiverId = patient.id;
        document.getElementById("messages").innerHTML = ""; // Clear the chat window
        loadMessages(); // Fetch messages for the specific patient
    });

    // Append image and name to the list item
    li.appendChild(img);
    li.appendChild(nameSpan);

    // Append the list item to the user list
    userList.appendChild(li);
});


// Load Messages for the Selected Pharmacy-Patient Pair
function loadMessages() {
    if (!receiverId) return;

    // Update chat header with patient name
    const patient = patients.find(p => p.id === receiverId);
    const chatHeader = document.getElementById("chat-header");
    chatHeader.innerHTML = `<img src="${patient.profilePicture}" /><h3>${patient.name}</h3>`;

    fetch(`api/fetch_messages.php?sender_id=${senderId}&receiver_id=${receiverId}`)
        .then(response => response.json())
        .then(messages => {
            const messagesDiv = document.getElementById("messages");
            messagesDiv.innerHTML = ""; // Clear existing messages
            messages.forEach(msg => {
                const div = document.createElement("div");
                div.classList.add("message", msg.sender_id == senderId ? "sent" : "received");
                div.textContent = msg.message;
                messagesDiv.appendChild(div);
            });
            messagesDiv.scrollTop = messagesDiv.scrollHeight; // Auto-scroll to the latest message
        });
}

// Send message
// const emojiButton = document.getElementById("emoji-button");
const messageInput = document.getElementById("message-input");

// Initialize Emoji Picker
// const picker = new EmojiButton();
// emojiButton.addEventListener("click", () => picker.togglePicker(emojiButton));

// Add selected emoji to the input field
// picker.on("emoji", emoji => {
//     messageInput.value += emoji;
// });

const fileInput = document.getElementById("file-input");
const fileLabel = document.getElementById("file-label");

fileInput.addEventListener("change", () => {
    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        
        // Show the file name or handle it for sending
        alert(`Selected File: ${file.name}`);
    }
});

document.getElementById("message-form").addEventListener("submit", event => {
    event.preventDefault();
    const message = messageInput.value.trim();
    const file = fileInput.files[0]; // Get the selected file
    
    if (message || file) {
        // Display the message or file in the chat
        const messagesDiv = document.getElementById("messages");

        if (message) {
            const div = document.createElement("div");
            div.classList.add("message", "sent");
            div.textContent = message;
            messagesDiv.appendChild(div);
        }

        if (file) {
            const div = document.createElement("div");
            div.classList.add("message", "sent");
            div.textContent = `File: ${file.name}`;
            messagesDiv.appendChild(div);
        }

        // Clear the input fields
        messageInput.value = "";
        fileInput.value = "";
    }
});