<?php
if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();
}

// Rest of your code


include_once("../DuAn1/config/database.php");

function datTour($conn, $userId, $tourId, $ngayDi, $ngayVe, $soNguoi)
{
    // Lấy giá tour từ cơ sở dữ liệu
    $stmt = $conn->prepare("SELECT gia_tour FROM tour WHERE id_tour = ?");
    $stmt->execute([$tourId]);
    $tourData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra xem có dữ liệu không
    if ($tourData) {
        $giaTour = $tourData['gia_tour'];

        // Tính số ngày đi
        $ngayDiTimestamp = strtotime($ngayDi);
        $ngayVeTimestamp = strtotime($ngayVe);
        $soNgay = ($ngayVeTimestamp - $ngayDiTimestamp) / (60 * 60 * 24);

        // Tính tổng giá tour
        $tongGia = $giaTour * $soNguoi * $soNgay;

        // Thêm thông tin vào bảng dattour
        $stmtInsert = $conn->prepare("INSERT INTO dattour (id_nguoidung, id_tour, so_nguoi, tong_gia, trang_thai, ngay_di, ngay_ve) VALUES (?, ?, ?, ?, 'Chờ xác nhận', ?, ?)");
        $stmtInsert->execute([$userId, $tourId, $soNguoi, $tongGia, $ngayDi, $ngayVe]);

        return $tongGia;
    }

    return false; // Trả về false nếu không tìm thấy thông tin tour
}

$userId = isset($_SESSION['id_nguoidung']) ? $_SESSION['id_nguoidung'] : null;
$tourId = isset($_GET['id']) ? $_GET['id'] : null;

if (!$tourId) {
    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM tour WHERE id_tour = :tourId");
$stmt->bindParam(':tourId', $tourId, PDO::PARAM_INT);
$stmt->execute();
$tour = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tour) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitDatTour'])) {
    if ($userId) {
        $ngayDi = $_POST['ngay_di'];
        $ngayVe = $_POST['ngay_ve'];
        $soNguoi = $_POST['so_nguoi'];

        $tongGia = datTour($conn, $userId, $tourId, $ngayDi, $ngayVe, $soNguoi);

        if ($tongGia !== false) {
            $successMessage = "Bạn đã đặt tour thành công!";
        } else {
            $errorMessage = "Đã xảy ra lỗi khi đặt tour. Vui lòng thử lại!";
        }
    } else {
        header("Location: login.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitDanhGia'])) {
    // Xử lý đánh giá
    if ($userId) {
        $nhanXet = $_POST['nhan_xet'];

        $stmtInsert = $conn->prepare("INSERT INTO danhgia (id_nguoidung, id_tour, nhan_xet, ngay_danhgia) VALUES (?, ?, ?, NOW())");
        $stmtInsert->execute([$userId, $tourId, $nhanXet]);

        $successMessage = "Cảm ơn bạn đã đánh giá!";
    } else {
        header("Location: login.php");
        exit();
    }
}
?>
<?php
include_once("header.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Tour</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
           
        }

        .container {
            padding: 0;
            margin: o auto;
        }

        .tour-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 20px;
            background-color: #F5F5F5;
        }

        .tour-image-container {
            width: 48%;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tour-details-container {
            width: 48%;
            box-sizing: border-box;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .tour-details-container h2 {
            margin-bottom: 10px;
            text-align: center;
        }

        .tour-details-container .tour-location {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tour-details-container .tour-location i {
            margin-right: 5px;
        }

        .tour-image {
            width: 90%;
            height: 90%;
            border-radius: 8px;
        }

        .tour-price {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .tour-price i {
            margin-right: 5px;
            color: #007bff;
            /* Màu sắc cho biểu tượng giá tour (ví dụ: màu xanh dương) */
        }

        .tour-price span {
            font-size: 28px;
            /* Kích thước chữ cho phần "Giá Tour" */
            color: chocolate;
            /* Màu sắc chữ cho phần "Giá Tour" (ví dụ: màu đen) */
        }

        .tour-price h2 {
            font-size: 24px;
        }

        .tour-price-number {
            font-size: 24px;
            /* Kích thước chữ cho phần số lượng */
            font-weight: bold;
            color: linear-gradient(90deg, rgba(155, 108, 186, 1) 0%, rgba(253, 29, 29, 1) 50%, rgba(252, 176, 69, 1) 100%);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .book-button,
        .review-button {
            background-color: #9b6cba;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            width: 100%;
            margin-bottom: 10px;
        }

        .book-button:hover,
        .review-button:hover {
            background: rgb(131, 58, 180);
            background: linear-gradient(90deg, rgba(131, 58, 180, 1) 0%, rgba(253, 29, 29, 1) 50%, rgba(252, 176, 69, 1) 100%);
        }

        .success-message {
            color: green;
            margin-top: 10px;
        }

        .tour-description {
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.5;
        }

        .danhgia-container {
            margin-top: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .danhgia-container h3 {
            text-align: center;
        }

        .form-danhgia {
            margin-top: 20px;
        }

        .form-danhgia textarea {
            width: 100%;
            resize: vertical;
        }

        .form-danhgia button {
            margin-top: 10px;
        }

        .danhgia-list {
            margin-top: 20px;
        }

        .danhgia-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .danhgia-item:last-child {
            border-bottom: none;
        }

        .danhgia-item strong {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .danhgia-item p {
            color: #777;
            font-size: 12px;
        }

        .danhgia-item small {
            color: #777;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="tour-container">
            <div class="tour-image-container">
                <img src="../DuAn1/uploads/<?= $tour['url_hinh'] ?>" alt="<?= $tour['ten_tour'] ?>" class="tour-image">
            </div>

            <div class="tour-details-container">
                <h2><?= $tour['ten_tour'] ?></h2>
                <?php if (isset($successMessage)) : ?>
                    <p class="success-message"><?= $successMessage ?></p>
                <?php endif; ?>

                <div class="tour-location">
                    <i class="fas fa-map-marker-alt"></i>
                    <span><strong>Địa Điểm:</strong> <?= $tour['dia_diem'] ?></span>
                </div>
                <div class="tour-price">
                    <i class="fas fa-money-bill-wave"></i>
                    <h2 class=""><strong>Giá Tour:</strong> </h2>
                    <span class="tour-price-number"><?= number_format($tour['gia_tour'], 0, ',', '.') ?> VND</span>
                </div>

                <!-- Bao phủ form -->
                <form action="" method="post">
                    <div class="form-group">
                        <label for="ngay_di">Ngày đi:</label>
                        <input type="date" id="ngay_di" name="ngay_di" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="ngay_ve">Ngày về:</label>
                        <input type="date" id="ngay_ve" name="ngay_ve" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="so_nguoi">Số người:</label>
                        <input type="number" id="so_nguoi" name="so_nguoi" min="1" value="1" class="form-control">
                    </div>

                    <button type="submit"  class="btn btn-primary book-button" name="submitDatTour">
                        Đặt Tour <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Hiển thị mô tả tour -->
        <div class="tour-details">
            <h3>Mô tả</h3>
            <p class="tour-description"><?= $tour['mo_ta'] ?></p>
        </div>

        <div class="danhgia-container">
            <h3>Đánh Giá</h3>

            <?php if ($userId) : ?>
                <form action="" method="post" class="form-danhgia">
                    <div class="form-group">
                        <label for="nhan_xet">Nhận xét:</label>
                        <textarea id="nhan_xet" name="nhan_xet" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submitDanhGia">Gửi Đánh Giá</button>
                </form>
            <?php else : ?>
                <p>Vui lòng <a href="login.php"></a>đăng nhập để đánh giá tour.</p>
            <?php endif; ?>

            <div class="danhgia-list">
                <?php
                $stmtDanhGia = $conn->prepare("SELECT nguoidung.ho_ten, danhgia.nhan_xet, danhgia.ngay_danhgia FROM danhgia JOIN nguoidung ON danhgia.id_nguoidung = nguoidung.id_nguoidung WHERE danhgia.id_tour = :tourId ORDER BY danhgia.ngay_danhgia DESC");
                $stmtDanhGia->bindParam(':tourId', $tourId, PDO::PARAM_INT);
                $stmtDanhGia->execute();
                $danhGiaList = $stmtDanhGia->fetchAll(PDO::FETCH_ASSOC);

                foreach ($danhGiaList as $danhGia) {
                ?>
                    <div class="danhgia-item">
                        <strong><?= $danhGia['ho_ten'] ?></strong>
                        <p><?= $danhGia['nhan_xet'] ?></p>
                        <small>Ngày đánh giá: <?= $danhGia['ngay_danhgia'] ?></small>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (you may need to include jQuery and Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>

<?php
include('footer.php');
?>

</html>