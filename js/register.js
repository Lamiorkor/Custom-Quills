// Form Validation
document
  .getElementById("signupForm")
  .addEventListener("submit", function (event) {
    const nameRegex = /^[a-zA-Z\s]+$/;
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const phoneRegex = /^\+\d{10,15}$/;
    const passwordRegex =
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const passwordRetype = document.getElementById("passwordRetype").value;
    const contact = document.getElementById("contact").value;

    // Validate Name
    if (!nameRegex.test(name)) {
      alert("Name must contain only letters and spaces.");
      event.preventDefault();
      return;
    }

    // Validate Email
    if (!emailRegex.test(email)) {
      alert("Please enter a valid email address.");
      event.preventDefault();
      return;
    }

    // Validate Password
    if (!passwordRegex.test(password)) {
      alert(
        "Password must be at least 8 characters long and include one uppercase letter, one lowercase letter, one number, and one special character."
      );
      event.preventDefault();
      return;
    }

    // Validate Retyped Password
    if (password !== passwordRetype) {
      alert("Passwords do not match.");
      event.preventDefault();
      return;
    }

    // Validate Phone Number
    if (!phoneRegex.test(contact)) {
      alert(
        "Phone number must include a country code and be of valid length (e.g., +233890982765)."
      );
      event.preventDefault();
      return;
    }
  });
