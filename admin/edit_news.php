<?php
include_once('../includes/functions.php');
include_once("../config/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_tintuc'])) {
        $idTinTuc = $_POST['id_tintuc'];
        $tieuDe = $_POST['tieu_de'];
        $noiDung = $_POST['noi_dung'];
        $ngayDang = $_POST['ngay_dang'];
        $urlHinh = isset($_POST['url_hinh']) ? $_POST['url_hinh'] : null;

        // Xử lý upload hình ảnh mới nếu có
        if ($_FILES['new_image']['name']) {
            $newImage = uploadHinhAnh($_FILES['new_image']);

            if ($newImage) {
                // Nếu upload thành công, cập nhật đường dẫn ảnh mới
                $urlHinh = $newImage;
            } else {
                echo "Lỗi khi upload hình ảnh mới.";
            }
        }

        $query = "UPDATE tintuc SET tieu_de = :tieu_de, noi_dung = :noi_dung, ngay_dang = :ngay_dang, url_hinh = :url_hinh WHERE id_tintuc = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tieu_de', $tieuDe);
        $stmt->bindParam(':noi_dung', $noiDung);
        $stmt->bindParam(':ngay_dang', $ngayDang);
        $stmt->bindParam(':url_hinh', $urlHinh);
        $stmt->bindParam(':id', $idTinTuc);

        if ($stmt->execute()) {
            echo "Thông tin tin tức đã được cập nhật thành công.";
        } else {
            echo "Có lỗi xảy ra khi cập nhật thông tin tin tức.";
        }
    } if ($stmt->execute()) {
        header("Location: manage_news.php"); // Chuyển hướng về trang quản lý tin tức
        exit(); // Đảm bảo dừng luồng chạy sau khi chuyển hướng
    } else {
        echo "Có lỗi xảy ra khi cập nhật thông tin tin tức.";
    }
    
} else {
    if (isset($_GET['id'])) {
        $tinTucId = $_GET['id'];
        $query = "SELECT * FROM tintuc WHERE id_tintuc = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $tinTucId);
        $stmt->execute();
        $tinTuc = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$tinTuc) {
            echo "Không tìm thấy tin tức.";
            exit();
        }
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Tin Tức</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Sửa Tin Tức</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_tintuc" value="<?= $tinTuc['id_tintuc'] ?>">

            <!-- Tiêu đề -->
            <div class="form-group">
                <label for="tieu_de">Tiêu đề:</label>
                <input type="text" class="form-control" id="tieu_de" name="tieu_de" value="<?= $tinTuc['tieu_de'] ?>" required>
            </div>

            <!-- Nội dung -->
            <div class="form-group">
                <label for="noi_dung">Nội dung:</label>
                <textarea class="form-control" id="noi_dung" name="noi_dung" rows="5"><?= $tinTuc['noi_dung'] ?></textarea>
            </div>

            <!-- Ngày đăng -->
            <div class="form-group">
                <label for="ngay_dang">Ngày đăng:</label>
                <input type="date" class="form-control" id="ngay_dang" name="ngay_dang" value="<?= $tinTuc['ngay_dang'] ?>" required>
            </div>

            <!-- Hình ảnh hiện tại -->
            <div class="form-group">
                <label for="url_hinh">Hình ảnh hiện tại:</label>
                <img src="../dulich/uploads/<?= $tinTuc['url_hinh'] ?>" alt="Hình ảnh tin tức" class="img-thumbnail" style="max-width: 200px;">
            </div>

            <!-- Upload hình ảnh mới -->
            <div class="form-group">
                <label for="new_image">Upload hình ảnh mới:</label>
                <input type="file" class="form-control-file" id="new_image" name="new_image">
            </div>

            <!-- Nút lưu lại và hủy bỏ -->
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="manage_news.php" class="btn btn-secondary">Hủy bỏ</a>
        </form>
    </div>
</body>

</html>
<?php
    } else {
        echo "Không có ID tin tức được cung cấp.";
    }
}
?>
