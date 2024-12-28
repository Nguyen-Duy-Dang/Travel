<?php
include_once('../includes/functions.php');
include_once("../config/database.php");

// Kiểm tra xem có thực hiện hành động xóa không
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Thực hiện xóa người dùng
    $result = xoaNguoiDung($userId);

    if ($result) {
        echo '<div class="alert alert-success" role="alert">Xóa người dùng thành công!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Có lỗi xảy ra khi xóa người dùng.</div>';
    }
}

// Kiểm tra nếu form thêm người dùng được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin từ form
    $tenDangNhap = $_POST['ten_dangnhap'];
    $matKhau = $_POST['mat_khau'];
    $email = $_POST['email'];
    $hoTen = $_POST['ho_ten'];
    $soDienThoai = $_POST['so_dien_thoai'];
    $vaiTro = $_POST['vai_tro'];

    // Thêm người dùng mới vào CSDL
    $result = themNguoiDungMoi($tenDangNhap, $matKhau, $email, $hoTen, $soDienThoai, $vaiTro);

    if ($result) {
        echo '<div class="alert alert-success" role="alert">Thêm người dùng thành công!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Có lỗi xảy ra khi thêm người dùng.</div>';
    }
}

// Lấy danh sách người dùng từ CSDL
$users = layDanhSachNguoiDung();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Quản lý người dùng</h2>

        <!-- Button mở form thêm người dùng -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal">
            Thêm người dùng
        </button>

        <!-- Bảng hiển thị danh sách người dùng -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Vai trò</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['id_nguoidung'] ?></td>
                        <td><?= $user['ten_dangnhap'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['ho_ten'] ?></td>
                        <td><?= $user['so_dien_thoai'] ?></td>
                        <td><?= $user['vai_tro'] == 1 ? 'Admin' : 'Khách hàng' ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= $user['id_nguoidung'] ?>" class="btn btn-info btn-sm">Sửa</a>
                            <a href="manage_users.php?action=delete&id=<?= $user['id_nguoidung'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Nút quay về trang index.php -->
        <a href="../admin/index.php" class="btn btn-secondary">Quay về Dashboard</a>

        <!-- Modal thêm người dùng -->
        <div class="modal" id="addUserModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm người dùng mới</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Form thêm người dùng -->
                        <form action="manage_users.php" method="post">
                            <!-- Các trường thông tin người dùng -->
                            <div class="form-group">
                                <label for="ten_dangnhap">Tên đăng nhập:</label>
                                <input type="text" class="form-control" id="ten_dangnhap" name="ten_dangnhap" required>
                            </div>
                            <div class="form-group">
                                <label for="mat_khau">Mật khẩu:</label>
                                <input type="password" class="form-control" id="mat_khau" name="mat_khau" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="ho_ten">Tên:</label>
                                <input type="text" class="form-control" id="ho_ten" name="ho_ten" required>
                            </div>
                            <div class="form-group">
                                <label for="so_dien_thoai">Số điện thoại:</label>
                                <input type="tel" class="form-control" id="so_dien_thoai" name="so_dien_thoai" required>
                            </div>
                            <div class="form-group">
                                <label for="vai_tro">Vai trò:</label>
                                <select class="form-control" id="vai_tro" name="vai_tro" required>
                                    <option value="1">Admin</option>
                                    <option value="0">Khách hàng</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm người dùng</button>
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
