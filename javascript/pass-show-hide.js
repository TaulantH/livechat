// Get references to the input field and the toggle button
const passwordInput = document.getElementById("password");
const togglePasswordButton = document.getElementById("togglePassword");

// Function to toggle the password visibility
function togglePasswordVisibility() {
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
}

// Add a click event listener to the toggle button
togglePasswordButton.addEventListener("click", togglePasswordVisibility);
