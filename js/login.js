document.getElementById('loginForm').addEventListener('submit', function (event) {
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    const email = document.getElementById('emailInput').value;
    const password = document.getElementById('passwordInput').value;

    // Validate Email
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        event.preventDefault();  // Prevent form submission
        return;
    }

    // Validate Password
    if (!passwordRegex.test(password)) {
        alert("Password must be at least 8 characters long and include one uppercase letter, one lowercase letter, one number, and one special character.");
        event.preventDefault();  // Prevent form submission
        return;
    }

    // If all validations pass, the form will be submitted
});
