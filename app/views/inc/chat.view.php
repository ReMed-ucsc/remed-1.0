<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Chat</title>
    <link rel="stylesheet" href="style.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@4.6.2/dist/emoji-button.min.js"></script> -->
</head>

<body>

    <img src="<?= ROOT ?>/assets/images/arrow-right.png" alt="" id="hide-chat">
    <div class="chat" id="chat" style="display: none;">
        <div id="chat-container">
            <div class="user-list">
                <div class="list-header">
                    <img src="<?= ROOT ?>/assets/images/ReMeD.png" alt="logo">
                    <p>Pharmacy Chat</p>
                </div>
                <ul id="user-list"></ul>
            </div>
            <div class="chat-section">
                <!-- Chat Header -->
                <div class="chat-header" id="chat-header">
                    <img src="<?= ROOT ?>/assets/images/no-image.png" alt="logo">
                    <h3>Select a Patient to Start Chatting</h3>
                </div>

                <!-- Message Display Area -->
                <div class="messages" id="messages"></div>

                <!-- Message Input Section -->
                <form id="message-form">
                    <!-- Emoji Picker Button -->
                    <!-- <button type="button" id="emoji-button">😊</button> -->

                    <!-- Message Input -->
                    <input type="text" id="message-input" placeholder="Type your message..." required />

                    <!-- File Input -->
                    <input type="file" id="file-input" style="display: none;" />
                    <label for="file-input" id="file-label">@</label>

                    <!-- Submit Button -->
                    <button type="submit">
                        <img id="btn" src="<?= ROOT ?>/assets/images//send.png" alt="">
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/pharmacy/chat.js"></script>
</body>

</html>