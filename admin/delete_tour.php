<?php
// Include file kết nối CSDL và các hàm hỗ trợ
include_once "../config/database.php";
include_once "../includes/functions.php";

// Kiểm tra xem đã có id được truyền vào hay chưa
if (isset($_GET['id'])) {
    // Lấy id từ tham số truyền vào
    $id_tour = $_GET['id'];

    // Thực hiện truy vấn xóa tour từ CSDL
    $sql = "DELETE FROM tour WHERE id_tour = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_tour, PDO::PARAM_INT);

    // Kiểm tra xem có xóa thành công hay không
    if ($stmt->execute()) {
        // Nếu xóa thành công, chuyển hướng về trang quản lý tour
        header("Location: manage_tours.php");
        exit();
    } else {
        // Nếu xóa không thành công, hiển thị thông báo lỗi
        echo "Lỗi xóa tour.";
    }
} else {
    // Nếu không có id được truyền vào, hiển thị thông báo lỗi
    echo "Không có id tour được cung cấp.";
}
?>
