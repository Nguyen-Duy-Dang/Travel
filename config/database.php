<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Thiết lập chế độ lỗi PDO để ném ngoại lệ
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Thiết lập chế độ truy xuất dữ liệu mặc định thành mảng kết hợp
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>