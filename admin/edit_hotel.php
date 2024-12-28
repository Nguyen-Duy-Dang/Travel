<?php
include_once("../config/database.php");

// Kiểm tra xem id đã được truyền từ URL chưa
if (isset($_GET['id'])) {
    $hotelId = $_GET['id'];

    // Truy vấn cơ sở dữ liệu để lấy thông tin của khách sạn
    $query = $conn->prepare("SELECT * FROM khachsan WHERE id_khachsan = :id");
    $query->bindParam(":id", $hotelId, PDO::PARAM_INT);
    $query->execute();
    $hotel = $query->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra xem khách sạn có tồn tại không
    if (!$hotel) {
        echo "Khách sạn không tồn tại.";
        exit;
    }
} else {
    echo "ID khách sạn không được cung cấp.";
    exit;
}

// Kiểm tra xem có sự thay đổi dữ liệu hay không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Xử lý dữ liệu được gửi từ form sửa đổi
    $newHotelName = $_POST['ten_khachsan'];
    $newAddress = $_POST['dia_chi'];
    $newRoomPrice = $_POST['gia_phong'];
    $newDescription = $_POST['mo_ta'];

    // Kiểm tra xem có tệp tin hình ảnh mới được chọn hay không
    if ($_FILES['hinh_anh']['error'] == 0) {
        // Nếu có tệp tin hình ảnh mới, thực hiện quá trình upload
        $uploadedImage = $_FILES['hinh_anh'];
        $newImageUrl = uploadHinhAnh($uploadedImage);

        if ($newImageUrl) {
            // Nếu upload thành công, cập nhật URL hình ảnh trong cơ sở dữ liệu
            $updateQuery = $conn->prepare("UPDATE khachsan SET ten_khachsan = :ten, dia_chi = :dia_chi, gia_phong = :gia_phong, mo_ta = :mo_ta, url_hinh = :url_hinh WHERE id_khachsan = :id");
            $updateQuery->bindParam(":url_hinh", $newImageUrl, PDO::PARAM_STR);
        } else {
            echo "Có lỗi xảy ra khi upload hình ảnh.";
            exit;
        }
    } else {
        // Nếu không có hình ảnh mới, chỉ cập nhật các trường thông tin khác
        $updateQuery = $conn->prepare("UPDATE khachsan SET ten_khachsan = :ten, dia_chi = :dia_chi, gia_phong = :gia_phong, mo_ta = :mo_ta WHERE id_khachsan = :id");
    }

    // Binding các tham số và thực hiện cập nhật
    $updateQuery->bindParam(":ten", $newHotelName, PDO::PARAM_STR);
    $updateQuery->bindParam(":dia_chi", $newAddress, PDO::PARAM_STR);
    $updateQuery->bindParam(":gia_phong", $newRoomPrice, PDO::PARAM_INT);
    $updateQuery->bindParam(":mo_ta", $newDescription, PDO::PARAM_STR);
    $updateQuery->bindParam(":id", $hotelId, PDO::PARAM_INT);

    if ($updateQuery->execute()) {
        echo "Cập nhật thành công!";
    } else {
        echo "Có lỗi xảy ra khi cập nhật thông tin khách sạn.";
    }
}

// Function uploadHinhAnh giữ nguyên từ trước
function uploadHinhAnh($file)
{
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra xem tệp có tồn tại không
    if (file_exists($target_file)) {
        // Nếu tệp đã tồn tại, không cần tạo bản sao hoặc đổi tên
        return basename($file["name"]);
    } else {
        // Nếu tệp không tồn tại, tải lên và trả về tên tệp tin
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return basename($file["name"]);
        } else {
            return false;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Khách Sạn</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Sửa Khách Sạn</h1>

        <!-- Form Sửa Khách Sạn -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="ten_khachsan" class="block text-gray-700 font-bold mb-2">Tên Khách Sạn:</label>
                <input type="text" name="ten_khachsan" id="ten_khachsan" value="<?php echo $hotel['ten_khachsan']; ?>" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="dia_chi" class="block text-gray-700 font-bold mb-2">Địa Chỉ:</label>
                <input type="text" name="dia_chi" id="dia_chi" value="<?php echo $hotel['dia_chi']; ?>" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="gia_phong" class="block text-gray-700 font-bold mb-2">Giá Phòng:</label>
                <input type="text" name="gia_phong" id="gia_phong" value="<?php echo $hotel['gia_phong']; ?>" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label for="mo_ta" class="block text-gray-700 font-bold mb-2">Mô Tả:</label>
                <textarea name="mo_ta" id="mo_ta" class="w-full p-2 border rounded"><?php echo $hotel['mo_ta']; ?></textarea>
            </div>

            <div class="mb-4">
                <label for="hinh_anh" class="block text-gray-700 font-bold mb-2">Hình Ảnh:</label>
                <input type="file" name="hinh_anh" id="hinh_anh" accept="image/*" class="w-full p-2 border rounded">
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 hover:bg-blue-700">Lưu Thay Đổi</button>
        </form>
    </div>
</body>

</html>
