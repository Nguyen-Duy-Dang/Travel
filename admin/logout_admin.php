<?php
session_start();

// Hủy bỏ tất cả các session
session_destroy();

// Chuyển hướng về trang đăng nhập
header("Location: login_admin.php");
exit();
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

