let source;

// Function to properly close SSE connection
function closeSSEConnection() {
    if (source) {
        source.close();
        source = null;
        console.log("🔌 SSE connection closed");
    }
}

// Function to initialize SSE connection
function initSSE(notificationPopup, notificationMessage) {
    const userId = document.body.dataset.userId;

    if (!userId) {
        console.warn("⚠️ No user ID found in <body data-user-id>");
        return;
    }

    console.log("📡 Connecting for user ID:", userId);

    source = new EventSource(`/remed-1.0/public/sse/notification.php?user_id=${userId}`, {
        withCredentials: true
    });

    source.onopen = function () {
        console.log("✅ Connection to server opened.");
    };

    source.onerror = function (event) {
        console.error("❌ SSE connection error:", event);
        closeSSEConnection();
    };

    // Handle custom "notification" event
    source.addEventListener('notification', function (event) {
        try {
            const data = JSON.parse(event.data);
            console.log("🔔 New notification:", data);

            notificationMessage.textContent = data.message;

            notificationPopup.dataset.orderId = data.orderId;

            // Show the popup
            notificationPopup.classList.add('show');

            // Hide the popup after 5 seconds
            setTimeout(function () {
                notificationPopup.classList.remove('show');
            }, 5000); // Popup will disappear after 5 seconds
        } catch (e) {
            console.error("❗ Error parsing notification data:", e);
        }
    });

    // Handle regular messages (like heartbeats)
    source.onmessage = function (event) {
        if (event.data) {
            try {
                const data = JSON.parse(event.data);
                console.log("📩 Unhandled message:", data);
            } catch (e) {
                // If not JSON, treat as heartbeat or comment
                console.log("💓 Heartbeat or non-JSON message received");
            }
        } else {
            console.log("💓 Heartbeat received");
        }
    };
}

document.addEventListener("DOMContentLoaded", function () {
    const notificationPopup = document.getElementById('notification-popup');
    const notificationMessage = document.getElementById('notification-message');


    initSSE(notificationPopup, notificationMessage);
})

window.addEventListener('beforeunload', function () {
    closeSSEConnection();
});