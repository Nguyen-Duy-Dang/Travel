<?php

include("../includes/functions.php");
$news = layDanhSachTinTuc(); // Hàm lấy danh sách tin tức từ CSDL
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tin Tức</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your custom styles here */
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-5">Quản Lý Tin Tức</h2>
        <a href="add_news.php" class="btn btn-success btn-lg">Thêm Tin Tức Mới</a>

        <div class="table-responsive mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Tin</th>
                        <th>Tiêu Đề</th>
                        <th>Ngày Đăng</th>
                        <th>Hình Ảnh</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news as $item) : ?>
                        <tr>
                            <td><?= $item['id_tintuc'] ?></td>
                            <td><?= $item['tieu_de'] ?></td>
                            <td><?= $item['ngay_dang'] ?></td>
                            <td>
                                <?php if ($item['url_hinh']) : ?>
                                    <img src="../uploads/<?= $item['url_hinh'] ?>" alt="Hình ảnh tin tức" style="max-width: 100px;">
                                <?php else : ?>
                                    No Image
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="edit_news.php?id=<?= $item['id_tintuc'] ?>" class="btn btn-info btn-sm">Sửa</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $item['id_tintuc'] ?>)">Xóa</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Your scripts here -->
    <script>
        function confirmDelete(newsId) {
            var confirmDelete = confirm("Bạn có muốn xóa tin tức không?");
            if (confirmDelete) {
                window.location.href = "delete_news.php?id=" + newsId;
            } else {
                // Người dùng đã nhấn Cancel, không làm gì cả
            }
        }
    </script>
</body>

</html>
