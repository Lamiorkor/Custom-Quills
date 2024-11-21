document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signupForm");
  
    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent form from submitting by default
  
        // Validate each field
        const fname = document.getElementById("fname").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const passwordRetype = document.getElementById("passwordRetype").value;
        const country = document.getElementById("country").value;
        const city = document.getElementById("city").value;
        const contactNumber = document.getElementById("contact").value;
  
        // Full Name Validation
        const namePattern = /^[A-Za-z ]+$/;
        if (!namePattern.test(fname)) {
            alert("Please enter a valid full name (letters and spaces only).");
            return;
        }
  
        // Email Validation - Accept only Ashesi emails
        const emailPattern = /^[a-zA-Z0-9._%+-]+@ashesi\.edu\.gh$/;
        if (!emailPattern.test(email)) {
            alert("Please enter a valid Ashesi email address.");
            return;
        }
  
        // Password Validation - At least 8 characters, 1 letter, 1 number, 1 special character
        const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!passwordPattern.test(password)) {
            alert("Password must be at least 8 characters long, include at least one letter, one number, and one special character.");
            return;
        }
  
        // Check if passwords match
        if (password !== passwordRetype) {
            alert("Passwords do not match.");
            return;
        }
  
        // Phone number validation using E.164 format (e.g., +233890982765)
        const phonePattern = /^\+233\d{9}$/;
        if (!phonePattern.test(contactNumber)) {
            alert("Please enter a valid phone number in the format: +233 followed by 9 digits.");
            return;
        }
  
        // Validate other fields (Country, City)
        if (!country.trim() || !city.trim()) {
            alert("Country and City fields cannot be empty.");
            return;
        }
  
        // If all validations pass, submit the form
        form.submit(); // Submit the form traditionally
    });
});
