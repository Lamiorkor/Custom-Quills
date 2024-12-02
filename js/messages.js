// This function sends a message
document.getElementById('chat-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const messageContent = document.getElementById('message-input').value;

    if (messageContent) {
        // Send the message via AJAX
        fetch('../actions/send_message_action.php', {
            method: 'POST',
            body: JSON.stringify({
                message: messageContent,
                receiver_id: receiverID // Pass the receiver's user ID
            }),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
            // Add the new message to the chat window
            if (data.status === 'success') {
                document.getElementById('message-input').value = '';
                appendMessage(data.message);
            }
        });
    }
});

// Function to append the message to the chat window
function appendMessage(message) {
    const chatWindow = document.getElementById('chat-window');
    const messageElement = document.createElement('div');
    messageElement.classList.add('message', 'mb-2', 'p-2', 'bg-gray-100', 'rounded-lg');
    messageElement.textContent = message.content;
    chatWindow.appendChild(messageElement);
}

// Fetch new messages periodically
setInterval(fetchMessages, 5000);

function fetchMessages() {
    fetch('../actions/get_messages_action.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                updateChatWindow(data.messages);
            }
        });
}

// Update chat window with new messages
function updateChatWindow(messages) {
    const chatWindow = document.getElementById('chat-window');
    chatWindow.innerHTML = ''; // Clear existing messages
    messages.forEach(message => {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', 'mb-2', 'p-2', 'bg-gray-100', 'rounded-lg');
        messageElement.textContent = message.content;
        chatWindow.appendChild(messageElement);
    });
}
