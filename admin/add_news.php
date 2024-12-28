<?php
// Kết nối CSDL sử dụng PDO
include_once('../config/database.php');
include_once('../includes/functions.php');
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Thiết lập chế độ lỗi để báo lỗi khi có lỗi xảy ra
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Kết nối CSDL thất bại: " . $e->getMessage();
}

// Kiểm tra nếu form được gửi đi và tệp tin được chọn
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["hinh_anh"])) {
    // Lấy thông tin từ biểu mẫu
    $tieuDe = $_POST['tieu_de'];
    $noiDung = $_POST['noi_dung'];
    $ngayDang = $_POST['ngay_dang'];

    // Xử lý upload hình ảnh
    $file = $_FILES['hinh_anh'];
    $target_dir = "../uploads/"; // Thư mục lưu trữ hình ảnh
    $target_file = $target_dir . basename($file["name"]);
    
    // Nếu bạn muốn tạo tên file duy nhất, bạn có thể sử dụng một hàm như uniqid() để tạo tên file mới
    
    // Di chuyển tệp tin từ thư mục tạm sang thư mục lưu trữ
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        // Chuẩn bị câu truy vấn SQL để thêm tin tức
        $sql = "INSERT INTO tintuc (tieu_de, noi_dung, ngay_dang, url_hinh) VALUES (:tieu_de, :noi_dung, :ngay_dang, :url_hinh)";
        
        try {
            // Sử dụng prepare statement để thực hiện truy vấn
            $stmt = $conn->prepare($sql);
            
            // Bind các tham số
            $stmt->bindParam(':tieu_de', $tieuDe);
            $stmt->bindParam(':noi_dung', $noiDung);
            $stmt->bindParam(':ngay_dang', $ngayDang);
            $stmt->bindParam(':url_hinh', $target_file); // Lưu đường dẫn hình ảnh
            
            // Thực thi truy vấn
            $stmt->execute();

            // Thông báo nếu thêm thành công và chuyển hướng về trang quản lý tin tức
            echo "Tin tức đã được thêm thành công.";
            header("Location: manage_news.php");
        } catch(PDOException $e) {
            echo "Lỗi khi thêm tin tức: " . $e->getMessage();
        }
    } else {
        echo "Có lỗi xảy ra khi upload hình ảnh.";
    }
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Bài Báo Mới</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Thêm Bài Báo Mới</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="tieu_de">Tiêu Đề:</label>
            <input type="text" class="form-control" id="tieu_de" name="tieu_de" required>
        </div>
        <div class="form-group">
            <label for="noi_dung">Nội Dung:</label>
            <textarea class="form-control" id="noi_dung" name="noi_dung" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="ngay_dang">Ngày Đăng:</label>
            <input type="datetime-local" class="form-control" id="ngay_dang" name="ngay_dang" required>
        </div>
        <div class="form-group">
            <label for="hinh_anh">Hình Ảnh:</label>
            <input type="file" class="form-control-file" id="hinh_anh" name="hinh_anh" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Bài Báo</button>
    </form>
</div>

</body>
</html>
