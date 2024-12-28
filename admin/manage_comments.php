<?php

include("../includes/functions.php");
$comment = layDanhSachBinhLuan();
// $sql = "SELECT * FROM danhgia ORDER BY id_danhgia DESC";
// $results = mysqli_query($conn, $sql);
// $comment = mysqli_fetch_all($results, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Bình Luận</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your custom styles here */
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-5">Quản Lý Bình Luận</h2>
      

        <div class="table-responsive mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Đánh Giá</th>
                        <th>ID Người Dùng </th>
                        <th>ID Tour </th>
                        <th>Nhận Xét</th>
                        <th>Ngày Đánh Giá</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>

                
                 <?php
                    foreach ($comment as $comment){
                    
                 ?>
                        <tr>
                            <td><?=  $comment['id_danhgia'];?></td>
                            <td><?= $comment['id_nguoidung'];?></td>
                            <td><?=  $comment['id_tour'];?></td>
                            <td><?=  $comment['nhan_xet'];?></td>
                            <td><?= $comment['ngay_danhgia'];?></td>
                           
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $comment['id_danhgia'] ?>)">Xóa</button>
                            </td>
                        </tr>
                       <?php }?>
                    
                </tbody>
            </table>
        </div>
    </div>

    <!-- Your scripts here -->
    <script>
        function confirmDelete(commentId) {
    var confirmDelete = confirm("Bạn có muốn xóa bình luận này không?");
    if (confirmDelete) {
        window.location.href = "delete_comment.php?id=" + commentId; // Thay đổi đường dẫn tới tệp xóa bình luận và truyền ID bình luận
    } else {
        // Người dùng đã nhấn Cancel, không làm gì cả
    }
}
    </script>
</body>

</html>
