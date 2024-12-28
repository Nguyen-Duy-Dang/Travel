<?php
include_once("../DuAn1/config/database.php");

// Khai báo biến để lưu thông báo
$message = "";

// Lấy thông tin khách sạn từ cơ sở dữ liệu
$id_khachsan = $_GET['id']; // Giả sử bạn có thể lấy id từ tham số truyền vào hoặc từ session, cookie, etc.

$query = "SELECT * FROM khachsan WHERE id_khachsan = :id_khachsan";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id_khachsan', $id_khachsan);
$stmt->execute();
$khachsan = $stmt->fetch(PDO::FETCH_ASSOC);

// Lấy id_nguoidung từ phiên phiên bản
session_start();
$userId = isset($_SESSION['id_nguoidung']) ? $_SESSION['id_nguoidung'] : null;

// Kiểm tra nếu người dùng đã đăng nhập
if (!$userId) {
    // Redirect hoặc xử lý theo ý của bạn nếu người dùng chưa đăng nhập
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Nhận dữ liệu từ form
    $ngay_checkin = $_POST["checkin"];
    $ngay_checkout = $_POST["checkout"];
    $so_phong = $_POST["num_rooms"];
    $so_nguoi = $_POST["num_guests"];

    // Tính số ngày thuê
    $ngay_thue = (strtotime($ngay_checkout) - strtotime($ngay_checkin)) / (60 * 60 * 24);

    // Tính tổng giá tiền
    $gia_phong = $khachsan['gia_phong'];
    $tong_gia = $ngay_thue * $so_phong * $so_nguoi * $gia_phong;

    // Thực hiện truy vấn SQL để chèn dữ liệu vào bảng datkhachsan
    $sql = "INSERT INTO datkhachsan (id_khachsan, id_nguoidung, ngay_checkin, ngay_checkout, so_phong, so_nguoi, tong_gia) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_khachsan, $userId, $ngay_checkin, $ngay_checkout, $so_phong, $so_nguoi, $tong_gia]);

    // Kiểm tra xem truy vấn đã thực hiện thành công hay không
    if ($stmt->rowCount() > 0) {
        echo "Đặt phòng thành công! Tổng giá: $tong_gia VND";
    } else {
        echo "Có lỗi xảy ra khi đặt phòng.";
    }
}
?>



<?php
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .shadow-md {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .text-blue-500 {
            color: #3b82f6;
        }

        .flex-container {
            display: flex;
        }

        .flex-container img {
            max-width: 100%;
            height: auto;
        }

        .form-container {
            padding: 20px;
        }

        /* Style for input */
        input[type="date"],
        input[type="number"] {
            border: 1px solid #e2e8f0;
            padding: 8px;
            width: 100%;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
        }
    </style>
    <title>Thông tin khách sạn</title>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto my-8 p-8 bg-white shadow-md">
        <div class="flex-container">
            <img src="uploads/<?php echo $khachsan['url_hinh']; ?>" alt="Hình ảnh khách sạn" class="w-1/2 mr-8">
            <div class="form-container">
                <h1 class="text-3xl font-bold mb-4"><?php echo $khachsan['ten_khachsan']; ?></h1>
                <p class="text-gray-600"><?php echo $khachsan['dia_chi']; ?></p>
                <p class="text-xl font-bold text-blue-500 mt-4"><?php echo number_format($khachsan['gia_phong'], 2); ?> VND</p>

                <form action="" method="post" class="mt-4">
                    <div class="mb-4">
                        <label for="checkin">Ngày Check-in:</label>
                        <input type="date" id="checkin" name="checkin" class="ml-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="checkout">Ngày Check-out:</label>
                        <input type="date" id="checkout" name="checkout" class="ml-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="num_rooms">Số Phòng:</label>
                        <input type="number" id="num_rooms" name="num_rooms" min="1" class="ml-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="num_guests">Số Người:</label>
                        <input type="number" id="num_guests" name="num_guests" min="1" class="ml-2" required>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2">Đặt Ngay</button>
                </form>
            </div>
        </div>
        <div class="mt-4 mb-4">
            <p class="text-gray-800"><?php echo $khachsan['mo_ta']; ?></p>
        </div>
    </div>

</body>
<?php
include('footer.php');
?>

</html>