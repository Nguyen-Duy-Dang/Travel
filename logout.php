<?php
session_start();

// Unset và hủy session
session_unset();
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập hoặc trang chủ
header("Location: login.php"); // Đổi thành trang đăng nhập của bạn nếu cần
exit();
?>
