<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Admin Login" />
    <meta name="author" content="YourCompany" />
    <meta name="description" content="Secure admin login panel" />
    <meta name="keywords" content="admin, login, dashboard, authentication, bootstrap" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }

        .login-box {
            width: 380px;
            margin: 50px auto;
        }

        .login-card {
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .login-card .card-header {
            text-align: center;
            font-size: 22px;
            font-weight: 600;
            padding: 20px;
        }

        .login-card .card-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 8px;
            height: 45px;
        }

        .btn-primary {
            border-radius: 8px;
            height: 45px;
            font-weight: 500;
        }

        .login-box-msg {
            text-align: center;
            font-size: 16px;
            margin-bottom: 15px;
            font-weight: 400;
        }

        .forgot-password {
            font-size: 14px;
            text-align: right;
            display: block;
            margin-top: 5px;
        }

        .forgot-password a {
            text-decoration: none;
            color: #007bff;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-box">
        <div class="card login-card">
            <div class="card-header bg-primary text-white">
                <h2>Admin Login</h2>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to manage your dashboard</p>

                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" id="loginEmail" name="email" class="form-control"
                                placeholder="Enter your email" required>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <div class="input-group relative">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" id="loginPassword" name="password" class="form-control"
                                placeholder="Enter your password" required>
                            <span class="absolute inset-y-0 right-3 flex items-center justify-center h-full cursor-pointer" onclick="togglePassword('loginPassword', 'eye-icon-password')" style="position: absolute;top: 50%;transform: translateY(-50%);right: 10px;z-index: 111;cursor: pointer;">
                                <i id="eye-icon-password" class="fa fa-eye text-gray-600"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                            <label class="form-check-label" for="rememberMe"> Remember Me </label>
                        </div>
                        <div class="forgot-password">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-primary w-100">Sign In</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

<script>
    function togglePassword(inputId, iconId) {
        const inputField = document.getElementById(inputId);
        const eyeIcon = document.getElementById(iconId);

        if (inputField.type === 'password') {
            inputField.type = 'text';
            eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            inputField.type = 'password';
            eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
</body>

</html>