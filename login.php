<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Bank Sampah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap, Icons & Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #a8ff78, #78ffd6);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 450px;
            width: 100%;
        }

        .logo-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo-header img {
            height: 60px;
            object-fit: contain;
        }

        .login-title {
            text-align: center;
            font-weight: 600;
            color:rgb(40, 80, 167);
            font-size: 1.5rem;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-success {
            width: 100%;
        }

        .error {
            color: #dc3545;
            text-align: center;
            margin-bottom: 15px;
        }

        .input-group-text {
            cursor: pointer;
        }

        @media (max-width: 500px) {
            .logo-header img {
                height: 45px;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Logo Header -->
    <div class="logo-header">
        <img src="https://i.imgur.com/n0Zz98i.png" alt="Logo LPPM">
        <div class="login-title">Login Admin</div>
        <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjrbmVRfLrLQ_W0S8TyeY-ITGn2b4USxdM0xVBBliS2O8CpZKeGhIj_wDGJDcGJrLP3Y_z-5GPlZ5B8K1bc6bIfOGrDfwUY523y9eaevm1tY6dd3oxnKa7Mqa_pdjTckw0DqxNNm3-XS90/s1600/LOGO+USMJAYA.png" alt="Logo USM">
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div class="error">❌ Username atau password salah</div>
    <?php endif; ?>

    <!-- Form Login -->
    <form action="auth.php" method="post">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" required>
                <span class="input-group-text" onclick="togglePassword()">
                    <i id="eyeIcon" class="bi bi-eye-slash"></i>
                </span>
            </div>
        </div>

        <button type="submit" class="btn btn-success">🔓 Masuk</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for Show/Hide Password -->
<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("bi-eye-slash");
            eyeIcon.classList.add("bi-eye");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("bi-eye");
            eyeIcon.classList.add("bi-eye-slash");
        }
    }
</script>

</body>
</html>
