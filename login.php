<?php
session_start();

$login_error = ''; // Khởi tạo biến trước khi sử dụng

// Nếu đã đăng nhập, chuyển hướng người dùng về trang chính
if (isset($_SESSION['id_nguoidung'])) {
    header("Location: index.php");
    exit();
}

include_once("../DuAn1/config/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id_nguoidung, ten_dangnhap, mat_khau FROM nguoidung WHERE ten_dangnhap = '$username'";
    $result = $conn->query($query);

    if ($result) {
        $user = $result->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['mat_khau']) {
            $_SESSION['id_nguoidung'] = $user['id_nguoidung'];
            header("Location: index.php");
            exit();
        } else {
            $login_error = "Tên đăng nhập hoặc mật khẩu không đúng!";
        }
    } else {
        // Xử lý lỗi truy vấn nếu cần
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Đăng nhập</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('./style/img/pngtree-travel-around-the-world-travel-poster-template-image_140335.jpg');
            background-size: cover;
        }

        .login-container {
            width: 400px;
            padding: 20px;
            background-color: #f9f9f9;
            /* Changed background color */
            border: 1px solid #ccc;
            /* Added border */
            border-radius: 5px;
            text-align: center;
            /* Center align content */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            /* Increase font size */
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        .login-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .login-btn:hover {
            background-color: #45a049;
        }

        .register-link {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            text-decoration: none;
            transition: background-color 0.3s;
            display: block;
        }

        .register-link:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button class="login-btn" type="submit" name="login">Đăng nhập</button>
                <a href="register.php" class="register-link">Đăng ký</a>
            </div>
            <?php if ($login_error !== '') { ?>
                <p class="error-message"><?php echo $login_error; ?></p>
            <?php } ?>
        </form>
    </div>
</body>

</html>