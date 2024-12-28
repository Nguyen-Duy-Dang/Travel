<?php
include_once("../DuAn1/config/database.php");

$stmt = $conn->query("SELECT * FROM tour");
$tours = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Truy vấn tin tức từ CSDL
$query = "SELECT * FROM tintuc ORDER BY ngay_dang DESC"; // Sắp xếp theo ngày đăng mới nhất
$stmt = $conn->prepare($query);
$stmt->execute();
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../DuAn1/style/css/main.css">
    <style>
        .book-button {
            background-color: #9b6cba;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            display: inline-block;
            transition: background-color 0.3s ease-in-out;
            text-decoration: none;
        }

        .book-button:hover {
            background: rgb(131, 58, 180);
            background: linear-gradient(90deg, rgba(131, 58, 180, 1) 0%, rgba(253, 29, 29, 1) 50%, rgba(252, 176, 69, 1) 100%);
        }  
        /* CSS để làm đẹp giao diện */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        .news-row {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .news-item {
            width: calc(33.33% - 20px); /* 33.33% width for each item with margins */
            background: #fff;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .news-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #333;
            font-size: 20px;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            font-size: 14px;
        }

        .date {
            color: #777;
            font-size: 12px;
        }
        .news-item {
            transition: transform 0.3s ease-in-out; /* Thêm hiệu ứng transition */
            overflow: hidden; /* Ẩn phần hình ảnh vượt ra khỏi phần tử cha */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .news-item:hover {
            transform: scale(1.05); /* Phóng to tin tức khi hover */
            cursor: pointer;
        }

        .news-item a {
            text-decoration: none;
            color: inherit; /* Dùng để kế thừa màu chữ từ cha */
            display: block; /* Để thẻ a mở rộng để bao phủ toàn bộ nội dung */
        }

        .news-item img {
            width: 100%; /* Đặt chiều rộng ảnh là 100% để ảnh nằm trong khung */
            height: 200px; /* Chiều cao cố định cho tất cả các ảnh */
            object-fit: cover; /* Chế độ fill để giữ tỷ lệ khung hình */
        }
        
    </style>
</head>

<body>
    <h1>Tour Nổi Bật</h1>
    <div class="tour-container">
        <!-- Hiển thị danh sách tour -->
        <?php foreach ($tours as $tour) : ?>
            <div class="tour" onclick="redirectToTourDetails(<?= $tour['id_tour'] ?>)">
                <img src="uploads/<?= urlencode($tour['url_hinh']) ?>" alt="<?= $tour['ten_tour'] ?>" title="<?= $tour['mo_ta'] ?>">
                <strong><?= $tour['ten_tour'] ?></strong><br>
                Địa điểm: <?= $tour['dia_diem'] ?><br>
                Ngày khởi hành: <?= $tour['ngay_khoi_hanh'] ?><br>
                Ngày kết thúc: <?= $tour['ngay_ket_thuc'] ?><br>
                <div class="tour-details">
                    Giá: <span class="tour-price"><?= number_format($tour['gia_tour'], 2, '.', ',') ?> VND</span><br>
                    <button class="book-button" (<?= $tour['id_tour'] ?>)>Đặt Tour</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        // Chuyển hướng đến trang chi tiết tour khi click vào thẻ tour
        function redirectToTourDetails(tourId) {
            window.location.href = 'tourdetails.php?id=' + tourId;
        }
    </script>  
    <div class="container">
        <h1>Tin Tức</h1>
        <div class="news-row">
            <?php
           foreach ($news as $item) {
            echo '<div class="news-item">';
            echo '<a href="blog.php?id_tintuc=' . $item['id_tintuc'] . '">';
            echo '<img src="./uploads/' . $item['url_hinh'] . '" alt="Hình ảnh">';
            echo '<h3>' . $item['tieu_de'] . '</h3>';
            echo '<p>' . $item['noi_dung'] . '</p>';    
            echo '<p class="date">Ngày đăng: ' . $item['ngay_dang'] . '</p>';
            echo '</a>';
            echo '</div>';
        }
        ?>
        </div>
    </div>
</body>

</html>