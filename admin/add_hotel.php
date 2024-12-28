<?php
include_once('../config/database.php');
include_once('../includes/functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $ten_khachsan = $_POST['ten_khachsan'];
    $dia_chi = $_POST['dia_chi'];
    $gia_phong = $_POST['gia_phong'];
    $mo_ta = $_POST['mo_ta'];

    // Kiểm tra xem có tệp tin hình ảnh được chọn không
    if ($_FILES['hinh_anh']['name'] != '') {
        // Thực hiện upload hình ảnh và lấy tên tệp
        $hinh_anh = uploadHinhAnh($_FILES['hinh_anh']);
    } else {
        $hinh_anh = null;
    }

    // Thêm khách sạn mới vào cơ sở dữ liệu
    $query = $conn->prepare("INSERT INTO khachsan (ten_khachsan, dia_chi, gia_phong, mo_ta, url_hinh) VALUES (:ten_khachsan, :dia_chi, :gia_phong, :mo_ta, :url_hinh)");
    $query->bindParam(':ten_khachsan', $ten_khachsan);
    $query->bindParam(':dia_chi', $dia_chi);
    $query->bindParam(':gia_phong', $gia_phong);
    $query->bindParam(':mo_ta', $mo_ta);
    $query->bindParam(':url_hinh', $hinh_anh);

    try {
        $query->execute();
        // Chuyển hướng về trang quản lý sau khi thêm thành công
        header("Location: manage_hotel.php");
        exit();
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khách Sạn Mới</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Thêm Khách Sạn Mới</h1>

        <!-- Form Thêm Khách Sạn -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="ten_khachsan" class="block text-gray-600">Tên Khách Sạn:</label>
                <input type="text" name="ten_khachsan" id="ten_khachsan" class="border rounded py-2 px-3 w-full">
            </div>

            <div class="mb-4">
                <label for="dia_chi" class="block text-gray-600">Địa Chỉ:</label>
                <input type="text" name="dia_chi" id="dia_chi" class="border rounded py-2 px-3 w-full">
            </div>

            <div class="mb-4">
                <label for="gia_phong" class="block text-gray-600">Giá Phòng:</label>
                <input type="text" name="gia_phong" id="gia_phong" class="border rounded py-2 px-3 w-full">
            </div>

            <div class="mb-4">
                <label for="mo_ta" class="block text-gray-600">Mô Tả:</label>
                <textarea name="mo_ta" id="mo_ta" class="border rounded py-2 px-3 w-full"></textarea>
            </div>

            <div class="mb-4">
                <label for="hinh_anh" class="block text-gray-600">Hình Ảnh:</label>
                <input type="file" name="hinh_anh" id="hinh_anh" class="border py-2 px-3">
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 hover:bg-blue-700">Thêm Khách Sạn</button>
        </form>
    </div>
</body>
    

</html>
