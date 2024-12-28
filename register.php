<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

$registration_error = '';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối không thành công: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Kiểm tra xem username đã tồn tại chưa
    $check_query = "SELECT * FROM nguoidung WHERE ten_dangnhap = :username";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bindParam(':username', $username);
    $check_stmt->execute();

    if ($check_stmt->rowCount() > 0) {
        $registration_error = "Tên đăng nhập đã tồn tại";
    } else {
        // Thực hiện truy vấn để thêm người dùng mới vào CSDL
        $insert_query = "INSERT INTO nguoidung (ten_dangnhap, mat_khau, email, vai_tro) VALUES (:username, :password, :email, :role)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bindParam(':username', $username);
        $insert_stmt->bindParam(':password', $password); // Mật khẩu không được mã hóa
        $insert_stmt->bindParam(':email', $email);
        $role = 0; // Vai trò mặc định
        $insert_stmt->bindParam(':role', $role);

        if ($insert_stmt->execute()) {
            header("Location: login.php"); // Chuyển hướng sau khi đăng ký thành công
            exit();
        } else {
            $registration_error = "Đăng ký không thành công";
        }
    }
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('./style/img/pngtree-travel-around-the-world-travel-poster-template-image_140335.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        h2 {
            font-size: 24px;
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
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        .register-btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
            display: block;
        }

        .register-btn:hover {
            background-color: #45a049;
        }

        .login-btn,
        .forgot-password {
            width: 48%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            text-decoration: none;
            transition: background-color 0.3s;
            display: inline-block;
        }

        .login-btn:hover,
        .forgot-password:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đăng ký</h2>
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
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <button type="submit" name="register" class="register-btn">Đăng ký</button>
            </div>
            <?php if($registration_error !== '') { ?>
                <p class="error-message"><?php echo $registration_error; ?></p>
            <?php } ?>
            <div class="form-group">
                <a href="login.php" class="login-btn">Đăng nhập</a>
            </div>
        </form>
    </div>
</body>
</html>





