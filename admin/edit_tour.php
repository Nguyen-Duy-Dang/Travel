<?php
include_once('../includes/functions.php');
include_once("../config/database.php");

// Kiểm tra nếu không có id được cung cấp
if (!isset($_GET['id'])) {
    echo "Không có id tour được cung cấp.";
    exit();
    
}

// Lấy thông tin tour từ database
$tourId = $_GET['id'];
$tour = getTourById($tourId);

// Kiểm tra xem tour có tồn tại không
if (!$tour) {
    echo "Không tìm thấy tour.";
    exit();
}

// Kiểm tra nếu form được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Xử lý logic khi submit form

    // Xử lý upload hình ảnh mới nếu có
    if ($_FILES['new_image']['name']) {
        $newImage = uploadHinhAnh($_FILES['new_image']);
        if ($newImage) {
            // Nếu upload thành công, cập nhật tên file ảnh mới trong database
            $tour['url_hinh'] = $newImage;
        } else {
            // Xử lý khi upload hình ảnh mới thất bại
            echo "Lỗi khi upload hình ảnh mới.";
        }
    }

    // Cập nhật thông tin tour vào database
    $query = "UPDATE tour SET ten_tour=?, dia_diem=?, mo_ta=?, ngay_khoi_hanh=?, ngay_ket_thuc=?, gia_tour=?, url_hinh=? WHERE id_tour=?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $_POST['ten_tour']);
    $stmt->bindParam(2, $_POST['dia_diem']);
    $stmt->bindParam(3, $_POST['mo_ta']);
    $stmt->bindParam(4, $_POST['ngay_khoi_hanh']);
    $stmt->bindParam(5, $_POST['ngay_ket_thuc']);
    $stmt->bindParam(6, $_POST['gia_tour']);
    $stmt->bindParam(7, $tour['url_hinh']);
    $stmt->bindParam(8, $tourId);

    if ($stmt->execute()) {
        // Chuyển hướng về trang manage_tours.php sau khi cập nhật thành công
        header("Location: manage_tours.php");
        exit();
    } else {
        // Xử lý khi cập nhật thất bại
        echo "Lỗi khi cập nhật thông tin tour.";
    }
}

// Hiển thị form và thông tin tour
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Tour</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Sửa Tour</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Tên Tour -->
            <div class="form-group">
                <label for="ten_tour">Tên Tour:</label>
                <input type="text" class="form-control" id="ten_tour" name="ten_tour" value="<?= $tour['ten_tour'] ?>" required>
            </div>

            <!-- Địa điểm -->
            <div class="form-group">
                <label for="dia_diem">Địa điểm:</label>
                <input type="text" class="form-control" id="dia_diem" name="dia_diem" value="<?= $tour['dia_diem'] ?>" required>
            </div>

            <!-- Mô tả -->
            <div class="form-group">
                <label for="mo_ta">Mô tả:</label>
                <textarea class="form-control" id="mo_ta" name="mo_ta" rows="3"><?= $tour['mo_ta'] ?></textarea>
            </div>

            <!-- Ngày khởi hành -->
            <div class="form-group">
                <label for="ngay_khoi_hanh">Ngày khởi hành:</label>
                <input type="date" class="form-control" id="ngay_khoi_hanh" name="ngay_khoi_hanh" value="<?= $tour['ngay_khoi_hanh'] ?>" required>
            </div>

            <!-- Ngày kết thúc -->
            <div class="form-group">
                <label for="ngay_ket_thuc">Ngày kết thúc:</label>
                <input type="date" class="form-control" id="ngay_ket_thuc" name="ngay_ket_thuc" value="<?= $tour['ngay_ket_thuc'] ?>" required>
            </div>

            <!-- Giá Tour -->
            <div class="form-group">
                <label for="gia_tour">Giá Tour:</label>
                <input type="number" class="form-control" id="gia_tour" name="gia_tour" value="<?= $tour['gia_tour'] ?>" required>
            </div>

            <!-- Hình ảnh hiện tại -->
            <div class="form-group">
                <label for="url_hinh">Hình ảnh hiện tại:</label>
                <img src="../uploads/<?= $tour['url_hinh'] ?>" alt="Hình ảnh tour" class="img-thumbnail" style="max-width: 200px;">
            </div>

            <!-- Upload Hình ảnh mới -->
            <div class="form-group">
                <label for="new_image">Upload Hình ảnh mới:</label>
                <input type="file" class="form-control-file" id="new_image" name="new_image">
            </div>

            <!-- Nút lưu lại và cancel -->
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="manage_tours.php" class="btn btn-secondary">Hủy bỏ</a>
        </form>
    </div>
</body>

</html>
