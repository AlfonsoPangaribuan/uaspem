<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <script src="scripts/form-handler.js" defer></script>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling with Gradient Background */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #000, #808080, #fff); /* Black to Gray to White Gradient */
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form Container */
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            border: 1px solid #333;
        }

        /* Header */
        h1 {
            color: #000;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Error Message */
        .error {
            color: #e74c3c;
            margin-bottom: 15px;
            font-size: 12px;
        }

        /* Success Message */
        .success {
            color: #2ecc71;
            font-size: 18px;
            margin-bottom: 15px;
        }

        /* Form Labels and Inputs */
        label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            font-size: 14px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #333;
            border-radius: 4px;
            font-size: 16px;
            background-color: #fff;
            color: #333;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #000;
            outline: none;
        }

        /* Password Visibility Toggle */
        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #333;
        }

        /* Submit Button */
        button {
            background-color: #333;
            color: #fff;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #555;
        }

        /* Link Styling */
        p {
            color: #000;
            margin-top: 20px;
        }

        p a {
            color: #000;
            text-decoration: underline;
        }

        p a:hover {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Registrasi Akun</h1>
        <form id="registrationForm" method="POST" action="process_registration.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <div id="usernameError" class="error"></div>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <div id="emailError" class="error"></div>

            <label for="password">Password:</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" required>
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>
            <div id="passwordError" class="error"></div>

            <button type="submit">Daftar</button>
        </form>
        <div id="successMessage" class="success"></div>
    </div>

    <script>
        // Ambil elemen-elemen form dan pesan error
        const form = document.getElementById('registrationForm');
        const usernameField = document.getElementById('username');
        const emailField = document.getElementById('email');
        const passwordField = document.getElementById('password');
        const usernameError = document.getElementById('usernameError');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        const successMessage = document.getElementById('successMessage');

        // Validasi Username saat mengetik
        usernameField.addEventListener('input', function() {
            const username = usernameField.value.trim();
            if (username.length < 3) {
                usernameError.textContent = 'Username harus minimal 3 karakter!';
            } else {
                usernameError.textContent = '';
            }
        });

        // Validasi Email saat mengetik
        emailField.addEventListener('input', function() {
            const email = emailField.value.trim();
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email)) {
                emailError.textContent = 'Format email tidak valid!';
            } else {
                emailError.textContent = '';
            }
        });

        // Validasi Password saat mengetik
        passwordField.addEventListener('input', function() {
            const password = passwordField.value.trim();
            if (password.length < 8) {
                passwordError.textContent = 'Password minimal 8 karakter!';
            } else {
                const passwordRegex = /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
                if (!passwordRegex.test(password)) {
                    passwordError.textContent = 'Password harus mengandung angka dan huruf kapital.';
                } else {
                    passwordError.textContent = '';
                }
            }
        });

        // Fungsi untuk menangani pengiriman form
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form untuk disubmit secara langsung

            // Lakukan validasi form sebelum melanjutkan
            const username = usernameField.value.trim();
            const email = emailField.value.trim();
            const password = passwordField.value.trim();

            // Jika form valid, tampilkan pesan sukses dan redirect
            if (username.length >= 3 && email.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/) && password.length >= 8 && /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/.test(password)) {
                successMessage.textContent = 'Daftar berhasil dilakukan!';
                
                // Redirect setelah 2 detik
                setTimeout(function() {
                    window.location.href = 'table.php'; // Ganti dengan alamat yang sesuai
                }, 2000);
            } else {
                successMessage.textContent = ''; // Kosongkan pesan jika form tidak valid
            }
        });

        // Password Visibility Toggle
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            const isPasswordVisible = passwordField.type === 'text';

            passwordField.type = isPasswordVisible ? 'password' : 'text';
            toggleIcon.textContent = isPasswordVisible ? '👁️' : '❌'; // Ganti ikon mata/mata silang
        }
    </script>
</body>
</html>
