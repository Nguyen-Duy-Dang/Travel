<?php
// manage_tours.php

include("../includes/functions.php");

$tours = layDanhSachTour();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tour</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
        }

        .btn-action {
            margin: 10px 0;
            font-size: 18px;
            padding: 15px 30px;
        }

        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-5">Quản Lý Tour</h2>
        <a href="add_tour.php" class="btn-action btn btn-success btn-lg">Thêm Tour Mới</a>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Tour</th>
                        <th>Tên Tour</th>
                        <th>Địa Điểm</th>
                        <th>Mô Tả</th>
                        <th>Ngày Khởi Hành</th>
                        <th>Ngày Kết Thúc</th>
                        <th>Giá Tour</th>
                        <th>Hình Ảnh</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tours as $tour) : ?>
                        <tr>
                            <td><?= $tour['id_tour'] ?></td>
                            <td><?= $tour['ten_tour'] ?></td>
                            <td><?= $tour['dia_diem'] ?></td>
                            <td><?= $tour['mo_ta'] ?></td>
                            <td><?= $tour['ngay_khoi_hanh'] ?></td>
                            <td><?= $tour['ngay_ket_thuc'] ?></td>
                            <td><?= $tour['gia_tour'] ?></td>
                            <td><img src="../uploads/<?= $tour['url_hinh'] ?>" alt="Hình ảnh tour" style="max-width: 100px;"></td>
                            <td>
                            <a href="edit_tour.php?id=<?= $tour['id_tour'] ?>" class="btn btn-info btn-sm">Sửa</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDeleteTour(<?= $tour['id_tour']; ?>)">Xóa</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    // Hàm xác nhận xóa tour
    function confirmDeleteTour(tourId) {
        // Sử dụng hàm confirm để hiển thị cảnh báo
        var confirmDelete = confirm("Bạn có muốn xóa tour không?");
        
        // Kiểm tra xem người dùng đã nhấn OK hay Cancel
        if (confirmDelete) {
            // Nếu người dùng đồng ý xóa, chuyển hướng đến trang xóa tour với tham số tourId
            window.location.href = "delete_tour.php?id=" + tourId;
        } else {
            // Người dùng đã nhấn Cancel, không làm gì cả
        }
    }
</script>

</body>

</html>