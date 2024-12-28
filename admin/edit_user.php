<?php
include_once('../includes/functions.php');
include_once("../config/database.php");

// Kiểm tra nếu không có id được cung cấp
if (!isset($_GET['id'])) {
    echo "Không có id người dùng được cung cấp.";
    exit();
}

// Lấy thông tin người dùng từ database
$userId = $_GET['id'];
$user = getNguoiDungById($userId);

// Kiểm tra xem người dùng có tồn tại không
if (!$user) {
    echo "Không tìm thấy người dùng.";
    exit();
}

// Kiểm tra nếu form được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Xử lý logic khi submit form

    // Lấy thông tin từ form
    $tenDangNhap = $_POST['ten_dangnhap'];
    $matKhau = $_POST['mat_khau'];
    $email = $_POST['email'];
    $hoTen = $_POST['ho_ten'];
    $soDienThoai = $_POST['so_dien_thoai'];
    $vaiTro = $_POST['vai_tro'];

    // Cập nhật thông tin người dùng vào database
    $result = capNhatNguoiDung($userId, $tenDangNhap, $matKhau, $email, $hoTen, $soDienThoai, $vaiTro);

    if ($result) {
        echo '<div class="alert alert-success" role="alert">Cập nhật người dùng thành công!</div>';
        // Chuyển hướng về trang manage_users.php sau 2 giây
        header("refresh:2;url=manage_users.php");
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Có lỗi xảy ra khi cập nhật người dùng.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa người dùng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Chỉnh sửa người dùng</h2>
        <form action="" method="post">
            <!-- Các trường thông tin người dùng -->
            <div class="form-group">
                <label for="ten_dangnhap">Tên đăng nhập:</label>
                <input type="text" class="form-control" id="ten_dangnhap" name="ten_dangnhap" value="<?= $user['ten_dangnhap'] ?>" required>
            </div>
            <div class="form-group">
                <label for="mat_khau">Mật khẩu:</label>
                <input type="password" class="form-control" id="mat_khau" name="mat_khau" value="<?= $user['mat_khau'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="ho_ten">Tên:</label>
                <input type="text" class="form-control" id="ho_ten" name="ho_ten" value="<?= $user['ho_ten'] ?>" required>
            </div>
            <div class="form-group">
                <label for="so_dien_thoai">Số điện thoại:</label>
                <input type="tel" class="form-control" id="so_dien_thoai" name="so_dien_thoai" value="<?= $user['so_dien_thoai'] ?>" required>
            </div>
            <div class="form-group">
                <label for="vai_tro">Vai trò:</label>
                <select class="form-control" id="vai_tro" name="vai_tro" required>
                    <option value="1" <?= $user['vai_tro'] == 1 ? 'selected' : '' ?>>Admin</option>
                    <option value="0" <?= $user['vai_tro'] == 0 ? 'selected' : '' ?>>Khách hàng</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật người dùng</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
