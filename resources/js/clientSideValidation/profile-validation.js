document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const name = document.getElementById('name');

    form.addEventListener('submit', function (event) {
        let isValid = true;

        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

        // Validate username
        if (username.value.trim() === '' || username.value.length > 50) {
            showError(username, 'Username is required and must be less than 50 characters.');
            isValid = false;
        }

        // Validate email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email.value) || email.value.length > 50) {
            showError(email, 'A valid email is required and must be less than 50 characters.');
            isValid = false;
        }

        // Validate name
        if (name.value.trim() === '' || name.value.length > 50) {
            showError(name, 'Name is required and must be less than 50 characters.');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    function showError(input, message) {
        const error = input.nextElementSibling;
        error.textContent = message;
    }
});
