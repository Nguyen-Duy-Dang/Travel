<?php
include("../includes/functions.php"); // Đảm bảo rằng bạn đã kết nối đến CSDL ở đây

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $comment_id = $_GET['id'];

    // Thực hiện truy vấn xóa bình luận từ CSDL dựa trên ID
    $sql = "DELETE FROM danhgia WHERE id_danhgia = :comment_id"; // Thay danhgia bằng tên bảng thực tế trong CSDL của bạn
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $stmt->execute();

    // Kiểm tra xem có bao nhiêu hàng đã bị ảnh hưởng (xóa)
    $affected_rows = $stmt->rowCount();

    if ($affected_rows > 0) {
        // Bình luận đã được xóa thành công
        header("Location: manage_comments.php"); // Điều hướng người dùng trở lại trang quản lý bình luận sau khi xóa
        exit();
    } else {
        // Không có bình luận nào được xóa
        echo "Không có bình luận nào được xóa.";
    }
} else {
    // Nếu không có ID được cung cấp hoặc ID trống, thông báo lỗi
    echo "Không có ID bình luận được cung cấp để xóa.";
}
?>
