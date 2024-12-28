<?php
include_once('./config/database.php');

// Kiểm tra xem id_tintuc có tồn tại trong URL không
if (!isset($_GET['id_tintuc'])) {
    echo "Không tìm thấy ID tin";
    exit();
}

$id_tintuc = $_GET['id_tintuc'];

try {
    // Sử dụng biến kết nối PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Truy vấn để lấy tin tức
    $sql = "SELECT * FROM tintuc WHERE id_tintuc = :id_tintuc";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_tintuc', $id_tintuc);
    $stmt->execute();

    // Kiểm tra và hiển thị dữ liệu
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $tieu_de = $row['tieu_de'];
        $noi_dung = $row['noi_dung'];
        $ngay_dang = $row['ngay_dang'];
        $url_hinh = $row['url_hinh'];
    } else {
        echo "Không có tin tức";
        exit();
    }
} catch (PDOException $e) {
    echo "Lỗi kết nối CSDL: " . $e->getMessage();
}

// Include header
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Thêm Tailwind CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        /* Thêm các quy tắc kiểu CSS tùy chỉnh cho trang của bạn ở đây */

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        p {
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .text-gray-500 {
            color: #6c757d;
        }
    </style>
    <title>Chi Tiết Tin Tức</title>
</head>

<body>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4"><?php echo $tieu_de; ?></h1>
        <p class="text-gray-500 mb-4"><?php echo $ngay_dang; ?></p>
        <?php if ($url_hinh) : ?>
            <img src="./uploads/<?php echo $url_hinh; ?>" alt="Hình ảnh" class="mb-4">
        <?php endif; ?>
        <p class="text-lg leading-relaxed"><?php echo $noi_dung; ?></p>
    </div>

<?php
// Include footer
include('footer.php');
?>

</body>

</html>
