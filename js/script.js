document.addEventListener('DOMContentLoaded', () => {

    const loginBtn = document.getElementById('login-button');
    const blurOverlay = document.querySelector('.blur-bg-overlay'); 
    const formPopup = document.querySelector('.form-popup');
    const formClose = document.querySelector('.form-popup .close-btn');
    const loginForm = document.querySelector('.form-box.login');
    const bottomLink = formPopup.querySelectorAll(".bottom-link a");
    

    // Hide form initially
    formPopup.querySelectorAll('.form-box').forEach((form) => form.style.display = 'none');

    loginBtn.addEventListener('click', (e) => {
        e.preventDefault();
        document.body.classList.add('show-popup');
        formPopup.querySelector('.login').style.display = 'block';
        console.log('login clicked');
    });

    // Add close functionality
    formClose.addEventListener('click', (e) => {
       e.preventDefault();
       document.body.classList.remove('show-popup');
       formPopup.querySelectorAll('.form-box').forEach((form) => form.style.display = 'none');
    });

    bottomLink.forEach((link) => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            formPopup.querySelectorAll('.form-box').forEach((form) => form.style.display = 'none');
            if(link.id === 'register-link') {
                formPopup.querySelector('.register').style.display = 'block';
            } else {
                formPopup.querySelector('.login').style.display = 'block';
            }
        });
    });
    /* function for hide/show password */
    $(document).ready(function () {
        // Toggle password visibility
        $('.toggle-password').on('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            
            const target = $(this).data('target');
            const input = $(target);
            const icon = $(this).find('.toggle-icon');

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.attr('src', '/img/showed.png');
            }   else {
                input.attr('type', 'password');
                icon.attr('src', '/img/hidden.png');
            }
        })

    });

    /* form validation and JSON data submission (LOGIN) */
    $(document).ready(function () {
        $('#login-form').on('submit', function (e) {
            e.preventDefault();
            /* get form input */
            const username = $('#username').val().trim();
            const password = $('#password').val().trim();
            
            //username validation
            if (username === '') {
               showAlert('Username cannot be empty!');
               return;
            }

            if (password === '') {
                showAlert('Password cannot be empty!');
                return;
            }

            $.ajax({
                url: '/page/user/login.php',
                type: 'POST',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify({
                    username: username,
                    password: password
                }),
                success: function (response) {
                    if (response.status === 'success') {
                        showAlert('Login successful! Redirecting...', () => {
                            window.location.href = response.redirectUrl || '/page/index.php';
                        });
                    }   else {
                        showAlert(response.message || 'Invalid credentials! Please try again!');
                    }
                    
                },
                error: function () {
                    showAlert('An error occurred! Please try again.');
                }
            });
        });
    });

    /* form validation and JSON data submission (REGISTER) */
    $(document).ready(function () {
        $('#register-form').on('submit', function (e) {
            e.preventDefault();
            /* get form input */
            const username = $('#usernameReg').val().trim();
            const password = $('#passwordReg').val().trim();
            const confirmPassword = $('#confirm-password').val().trim();

            //username validation
            if (username === '') {
               showAlert('Email cannot be empty!');
               return;
            }

            const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/;
            if (!passwordRegex.test(password)) {
                showAlert('Password must be at least 8 characters long, include at least one uppercase letter, one number, and one special character.');
                return;
            }

            if (password === '') {
                showAlert('Password cannot be empty!');
                return;
            }

            if (confirmPassword === '') {
                showAlert('Confirm Password cannot be empty!');
                return;
            }

            if (password !== confirmPassword) {
                showAlert('Passwords do not match!');
                return;
            }

            $.ajax({
                url: '/page/user/register.php',
                type: 'POST',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify({
                    username: username,
                    password: password
                }),
                success: function (response) {
                    if (response.status === 'success') { // Changed from response.message to response.status
                        showAlert('Registration Successful! Redirecting...', () => {
                            window.location.href = '/page/' + (response.RedirectUrl || 'index.php'); // Added /page/ prefix
                        });
                    } else {
                        showAlert(response.message || 'An error occurred! Please try again.');
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error); // Add error logging
                    showAlert('An error occurred! Please try again.');
                }
            });
        });
    });


    // alert box function
    const alertBox = document.getElementById('alert-box');
    const alertClose = document.getElementById('alert-close');
    const alertMsg = document.getElementById('alert-msg');
    const body = document.body;

    function showAlert(message, callback) {
        if (alertMsg && alertBox) {
            alertMsg.textContent = message;
            alertBox.style.display = 'block';

            const blurOverlay = document.createElement('div');
            blurOverlay.className = 'blur-overlay';
            blurOverlay.id = 'blur-overlay';
            body.appendChild(blurOverlay);

            setTimeout(() => {
                alertBox.style.display = 'none';
                const overlay = document.getElementById('blur-overlay');
                if (overlay) {
                    overlay.remove();
                }
                if (callback) callback();
            }, 1800);
        }
    }

    function closeAlert() {
        if (alertBox) {
            alertBox.style.display = 'none';
            const overlay = document.getElementById('blur-overlay');
            if (overlay) {
                overlay.remove();
            }
        }
    }

    if (alertClose) {
        alertClose.addEventListener('click', closeAlert);
    }

    // Test alert
    window.showAlert = showAlert; // Make showAlert globally available
});

