const from = document.querySelector(".typing-area");
const inputField = from.querySelector(".input-field");
const sendBtn = from.querySelector("button");
const chatBox = document.querySelector(".chat-box");
let messageCount = 20; // Initialize with the initial message count
let isFetching = false; // Flag to prevent multiple fetch requests
let isScrolledToBottom = true; // Flag to track if user manually scrolled


from.onsubmit = (e) => {
    e.preventDefault(); // Prevent the default form submission
    sendMessage();
};

chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
};

chatBox.addEventListener("scroll", () => {
    const scrollThreshold = 10; // Adjust as needed

    // Check if the user manually scrolled near the top
    isScrolledToBottom = chatBox.scrollHeight - chatBox.scrollTop - scrollThreshold <= chatBox.clientHeight;
});

setInterval(() => {
    if (!isFetching && chatBox.scrollTop === 0) {
        isFetching = true;
        fetchMessages();
    }
}, 500);

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}

function sendMessage() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = "";
                if (isScrolledToBottom) {
                    // Scroll to the bottom only if the user was already at the bottom
                    scrollToBottom();
                }
                fetchMessages();
            } else {
                // Handle errors here, e.g., display an error message.
            }
        }
    };
    let formData = new FormData(from);
    xhr.send(formData);
}

function fetchMessages() {
    const previousScrollHeight = chatBox.scrollHeight;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                isFetching = false;

                if (isScrolledToBottom) {
                    // Scroll to the bottom only if the user was already at the bottom
                    chatBox.scrollTop = chatBox.scrollHeight;
                } else {
                    // Maintain the scroll position after adding more messages
                    chatBox.scrollTop = chatBox.scrollHeight - previousScrollHeight;
                }
            }
        }
    };
    let formData = new FormData(from);
    formData.append("messageCount", messageCount);
    messageCount += 20;
    xhr.send(formData);
}