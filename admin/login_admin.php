<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Nếu đã đăng nhập, chuyển hướng đến trang quản lý
    header("Location: index.php");
    exit();
}

include_once("../includes/functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = xacThucNguoiDung($username, $password);

    if ($user) {
        if ($user['vai_tro'] == 1) {
            // Lưu user_id vào session để đánh dấu đã đăng nhập
            $_SESSION['user_id'] = $user['id_nguoidung'];
            header("Location: index.php");
            exit();
        } else {
            $alertMessage = "Đây không phải tài khoản admin!";
        }
    } else {
        $alertMessage = "Sai mật khẩu hoặc tài khoản.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center">Đăng nhập Admin</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($alertMessage)) {
                            echo "<div class='alert alert-danger'>$alertMessage</div>";
                        }
                        ?>

                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="username">Tên đăng nhập:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>