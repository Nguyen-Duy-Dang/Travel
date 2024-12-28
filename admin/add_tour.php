<?php
// add_tour.php
include_once('../config/database.php');
include_once('../includes/functions.php');

// Kiểm tra nếu form được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin về hình ảnh từ form
    $file = $_FILES['ten_hinh_anh'];

    // Gọi hàm uploadHinhAnh và truyền đối số
    $hinhAnhMoi = uploadHinhAnh($file);

    // Tiếp tục xử lý các bước khác sau khi tải lên hình ảnh
    if ($hinhAnhMoi) {
        // Lấy thông tin từ form
        $tenTour = $_POST['ten_tour'];
        $diaDiem = $_POST['dia_diem'];
        $moTa = $_POST['mo_ta'];
        $ngayKhoiHanh = $_POST['ngay_khoi_hanh'];
        $ngayKetThuc = $_POST['ngay_ket_thuc'];
        $giaTour = $_POST['gia_tour'];

        // Chuẩn bị câu truy vấn SQL
        $sql = "INSERT INTO tour (ten_tour, dia_diem, mo_ta, ngay_khoi_hanh, ngay_ket_thuc, gia_tour, url_hinh) 
                VALUES (:ten_tour, :dia_diem, :mo_ta, :ngay_khoi_hanh, :ngay_ket_thuc, :gia_tour, :url_hinh)";

        // Chuẩn bị và thực thi câu truy vấn
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ten_tour', $tenTour);
        $stmt->bindParam(':dia_diem', $diaDiem);
        $stmt->bindParam(':mo_ta', $moTa);
        $stmt->bindParam(':ngay_khoi_hanh', $ngayKhoiHanh);
        $stmt->bindParam(':ngay_ket_thuc', $ngayKetThuc);
        $stmt->bindParam(':gia_tour', $giaTour);
        $stmt->bindParam(':url_hinh', $hinhAnhMoi);

        if ($stmt->execute()) {
            // Tour được thêm thành công
            echo "Tour đã được thêm thành công.";
            header("Location: manage_tours.php");
        } else {
            echo "Lỗi khi thêm tour: " . $stmt->errorInfo()[2];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Tour Mới</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Thêm Tour Mới</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="ten_tour">Tên Tour:</label>
            <input type="text" class="form-control" id="ten_tour" name="ten_tour" required>
        </div>
        <div class="form-group">
            <label for="dia_diem">Địa Điểm:</label>
            <input type="text" class="form-control" id="dia_diem" name="dia_diem" required>
        </div>
        <div class="form-group">
            <label for="mo_ta">Mô Tả:</label>
            <textarea class="form-control" id="mo_ta" name="mo_ta" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="ngay_khoi_hanh">Ngày Khởi Hành:</label>
            <input type="date" class="form-control" id="ngay_khoi_hanh" name="ngay_khoi_hanh" required>
        </div>
        <div class="form-group">
            <label for="ngay_ket_thuc">Ngày Kết Thúc:</label>
            <input type="date" class="form-control" id="ngay_ket_thuc" name="ngay_ket_thuc" required>
        </div>
        <div class="form-group">
            <label for="gia_tour">Giá Tour:</label>
            <input type="number" class="form-control" id="gia_tour" name="gia_tour" required>
        </div>
        <div class="form-group">
            <label for="ten_hinh_anh">Hình Ảnh:</label>
            <input type="file" class="form-control-file" id="ten_hinh_anh" name="ten_hinh_anh" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Tour</button>
    </form>
</div>

</body>
</html>
