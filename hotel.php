<?php
    include('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Khách Sạn</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Danh Sách Khách Sạn</h1>

        <!-- Danh sách Khách Sạn -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <?php
            // Kết nối CSDL và truy vấn dữ liệu
            include_once("../DuAn1/config/database.php");
            $query = $conn->prepare("SELECT * FROM khachsan");
            $query->execute();
            $hotels = $query->fetchAll(PDO::FETCH_ASSOC);

            // Lặp qua danh sách khách sạn và hiển thị
            foreach ($hotels as $hotel) :
            ?>
                <!-- Mỗi Khách Sạn -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                <img src="uploads/<?php echo $hotel['url_hinh']; ?>" alt="Hình Ảnh" class="w-full h-32 object-cover mb-4 rounded">
                    <h2 class="text-xl font-bold mb-2"><?php echo $hotel['ten_khachsan']; ?></h2>
                    <p class="text-gray-600 mb-4">Địa Chỉ: <?php echo $hotel['dia_chi']; ?></p>
                    <p class="text-gray-800" style ="font-weight: bold;">Giá Phòng: <?php echo $hotel['gia_phong']; ?> VND</p>
                    <a href="hotel_detail.php?id=<?php echo $hotel['id_khachsan']; ?>" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Xem Chi Tiết</a>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</body>
</html>
<?php
    include('footer.php');
?>
