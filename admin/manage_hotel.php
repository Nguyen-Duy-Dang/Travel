<?php
include_once("../config/database.php");

// Lấy danh sách khách sạn từ cơ sở dữ liệu
$query = $conn->prepare("SELECT * FROM khachsan");
$query->execute();
$hotels = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['id'])) {
    $hotelId = $_GET['id'];

    // Thực hiện câu lệnh SQL để xóa khách sạn
    $query = $conn->prepare("DELETE FROM khachsan WHERE id_khachsan = ?");
    $query->execute([$hotelId]);

    // Trả về thông báo xóa thành công (có thể không cần)
    echo "Xóa thành công!";
} else {
    echo "Không có ID khách sạn được cung cấp.";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Khách Sạn</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Danh sách Khách Sạn</h1>

        <!-- Button Thêm Khách Sạn -->
        <a href="add_hotel.php" class="bg-blue-500 text-white py-2 px-4 mb-4 inline-block hover:bg-blue-700">Thêm Khách Sạn</a>

        <!-- Danh sách Khách Sạn -->
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Tên Khách Sạn</th>
                    <th class="py-2 px-4 border-b">Địa Chỉ</th>
                    <th class="py-2 px-4 border-b">Giá Phòng</th>
                    <th class="py-2 px-4 border-b">Hình Ảnh</th>
                    <th class="py-2 px-4 border-b">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hotels as $hotel) : ?>
                    <tr data-id="<?php echo $hotel['id_khachsan']; ?>">
                        <td class="py-2 px-4 border-b"><?php echo $hotel['id_khachsan']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $hotel['ten_khachsan']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $hotel['dia_chi']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $hotel['gia_phong']; ?></td>
                        <td class="py-2 px-4 border-b">
                            <img src="../uploads/<?php echo $hotel['url_hinh']; ?>" alt="Hình Ảnh" class="w-20 h-20 object-cover">
                        </td>
                        <td class="py-2 px-4 border-b">
                            <a href="edit_hotel.php?id=<?php echo $hotel['id_khachsan']; ?>" class="text-blue-500">Sửa</a>
                            <a href="#" class="text-red-500 ml-2" onclick="confirmDelete(<?php echo $hotel['id_khachsan']; ?>)">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(hotelId) {
            // Hiển thị thông báo xác nhận xóa
            var confirmDelete = confirm("Bạn có muốn xóa không?");

            // Nếu người dùng xác nhận xóa, thực hiện xóa không chuyển trang
            if (confirmDelete) {
                // Sử dụng AJAX để gửi yêu cầu xóa
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Xóa thành công, cập nhật giao diện ngay lập tức (ví dụ: ẩn dòng)
                        var deletedRow = document.querySelector('tr[data-id="' + hotelId + '"]');
                        if (deletedRow) {
                            deletedRow.style.display = 'none';
                        }
                    }
                };
                xhr.open("GET", "manage_hotel.php?id=" + hotelId, true);
                xhr.send();
            }
        }
    </script>
</body>

</html>
