<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Car Rental - Login</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
        }
        .container {
            width: 100vw;
            height: 90vh;
        }
        .login-card {
            display: flex;
            flex-direction: row;
            border-radius: 20px;
            overflow: hidden;
            width: 300%;
            height: 100%;
        }
        .image-section {
            background: url("image/bg.jpg") no-repeat center;
            background-size: cover;
            width: 60%;
            height: 100%;
        }
        .login-section {
            flex: 1;
            padding: 50px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .custom-btn {
            background-color: #000;
            color: white;
            transition: background-color 0.3s ease;
        }
        .custom-btn:hover {
            background-color: #333;
            color: white;
        }
        .input-group-text {
            background: #f8f9fa;
            border-right: none;
        }
        .form-control {
            border-left: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card shadow-lg login-card">
            <div class="login-section">
                <h3 class="mb-5 text-center">LOGIN&nbsp;<i class="fa-solid fa-car"></i></h3>
                <?php
                session_start();
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']);
                }
                ?>
<form action="login_process.php" method="POST">
<div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input type="text" name="username" class="form-control" placeholder="Username" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control" placeholder="Password" required />
                        </div>
                    </div>
                    <button type="submit" class="btn w-100 custom-btn"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;Login</button>
                </form>
            </div>
            <div class="image-section"></div>
        </div>
    </div>
</body>
</html>
