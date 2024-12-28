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

// Kiểm tra xem người dùng có chắc chắn muốn xóa không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Nếu chắc chắn, thực hiện xóa người dùng
    $result = xoaNguoiDung($userId);

    if ($result) {
        echo '<div class="alert alert-success" role="alert">Xóa người dùng thành công!</div>';
        // Chuyển hướng về trang manage_users.php sau 2 giây
        header("refresh:2;url=manage_users.php");
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Có lỗi xảy ra khi xóa người dùng.</div>';
    }
}
?>

