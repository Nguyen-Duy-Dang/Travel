<?php
session_start();
include_once('../includes/functions.php');

// Xử lý khi nút "Xác nhận" hoặc "Hủy" được bấm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $id_dattuor = $_POST['id_dattuor'];
    $action = $_POST['action'];

    // Gọi hàm cập nhật trạng thái
    updateOrderStatus($id_dattuor, $action);
}

// Lấy tất cả thông tin từ bảng dattour
$orders = getAllOrders();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đơn Đặt Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/your/tailwind.css"> <!-- Đường dẫn đến file Tailwind CSS -->
</head>

<body>
    <div class="container mx-auto my-10 p-5 bg-white shadow-lg" style = "border-radius: 10px;">
        <h2 class="text-3xl font-semibold mb-5">Quản Lý Đơn Đặt Tour</h2>

        <?php if ($orders) : ?>
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Người Đặt</th>
                        <th class="border border-gray-300 px-4 py-2">Tour</th>
                        <th class="border border-gray-300 px-4 py-2">Số Người</th>
                        <th class="border border-gray-300 px-4 py-2">Tổng Giá</th>
                        <th class="border border-gray-300 px-4 py-2">Trạng Thái</th>
                        <th class="border border-gray-300 px-4 py-2">Ngày Đi</th>
                        <th class="border border-gray-300 px-4 py-2">Ngày Về</th>
                        <th class="border border-gray-300 px-4 py-2">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2"><?= $order['id_dattuor']; ?></td>
                            <!-- Thêm các cột thông tin cần hiển thị từ $order -->
                            <td class="border border-gray-300 px-4 py-2"><?= $order['id_nguoidung']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= $order['id_tour']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= $order['so_nguoi']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= number_format($order['tong_gia'], 2, '.', ','); ?> VND</td>
                            <td class="border border-gray-300 px-4 py-2"><?= $order['trang_thai']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= $order['ngay_di']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= $order['ngay_ve']; ?></td>
                            <td class="border border-gray-300 px-4 py-2">
                                <!-- Nút "Xác Nhận" -->
                                <form method="get">
                                    <input type="hidden" name="id_dattuor" value="<?= $order['id_dattuor']; ?>">
                                    <input type="hidden" name="action" value="confirm">
                                     <a href="manage_orders.php?id_dattuor=<?=$order['id_dattuor']?>&id_nguoidung=<?= $order['id_nguoidung'];?>&id_tour=<?=$order['id_tour'];?>&so_nguoi=<?=$order['so_nguoi'];?>&tong_gia=<?=number_format($order['tong_gia'], 2, '.', ',');?>&trang_thai=<?=$order['trang_thai'];?>&ngay_di=<?=$order['ngay_di'];?>&ngay_ve=<?=$order['ngay_ve'];?>"  class="btn btn-info btn-sm">Xác nhận</a> 
                                    <!-- <button type="submit" name="xacnhan"  class="bg-green-500 text-white px-3 py-1 rounded">Xác Nhận</button> -->
                                </form>
                                <!-- Nút "Hủy" -->
                                <form method="post">
                                    <input type="hidden" name="id_dattuor" value="<?= $order['id_dattuor']; ?>">
                                    <input type="hidden" name="action" value="cancel">
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hủy</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="text-gray-600">Không có đơn đặt tour nào.</p>
        <?php endif; ?>
    </div>
</body>

</html>
</html>

<?php
$order = layDanhDonHang();
// if (isset($_POST['xacnhan'])) {
//     $id_dattuor = $_POST['id_dattuor'];
//     $id_nguoidung = $_POST['id_nguoidung'];
//     $id_tour = $_POST['id_tour'];
//     $so_nguoi = $_POST['so_nguoi'];
//     $tong_gia = $_POST['tong_gia'];
//     $trang_thai = $_POST['trang_thai'];
//     $ngay_di = $_POST['ngay_di'];
//     $ngay_ve = $_POST['ngay_ve'];

if(isset($_GET['id_dattuor'])&&($_GET['id_nguoidung'])){
    $id_dattuor = $_GET['id_dattuor'];
    $id_nguoidung= $_GET['id_nguoidung'];
   $id_tour = $_GET['id_tour'];
  $so_nguoi = $_GET['so_nguoi'];
   $tong_gia = $_GET['tong_gia'];
   $trang_thai = $_GET['trang_thai'];
    $ngay_di = $_GET['ngay_di'];
    $ngay_ve = $_GET['ngay_ve'];
   
        

    // Email người nhận
    $to = "  dangndpd09151@fpt.edu.vn "; // Thay bằng địa chỉ email thực tế của người nhận

    // Chủ đề email
    $subject = "Thông tin đặt tour của bạn";

    // Nội dung email
    $message = "
    <html>
    <head>
    <title>Thông tin đặt tour của bạn</title>
    </head>
    <body>
    <p>Chào bạn,</p>
    <p>Tôi viết email này để xác nhận thông tin đặt tour của bạn và cung cấp một số chi tiết liên quan đến đơn đặt hàng của bạn:</p>
    <ul>
    <li><strong>ID Đặt tour:</strong>  $id_dattuor </li>
    <li><strong>ID Người dùng:</strong> $id_nguoidung</li>
    <li><strong>ID tour:</strong> $id_tour</li>
    <li><strong>Số người:</strong>   $so_nguoi</li>
    <li><strong>Tổng giá:</strong>$tong_gia</li>
    <li><strong>Trạng thái:</strong>  $trang_thai</li>
    <li><strong>Ngày đi</strong>   $ngay_di </li>
    <li><strong>Ngày về</strong> $ngay_ve </li>
    </ul>
    <p>Xin chào quý khách. Đơn đặt tour đã được xác nhận. Vào ngày $ngay_di  quý khách vui lòng đến điểm hẹn để được hướng dẫn về tour. chúc quý khách có 1 chuyến tour vui vẻ </p>
    <p>Chúng tôi rất mong được phục vụ bạn và hy vọng bạn sẽ có một trải nghiệm du lịch tuyệt vời.</p>
  
    </body>
    </html>
    ";

    // Header email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: tourdulichvivuviet@gmail.com"; // Thay bằng địa chỉ email của bạn

    // Gửi email
    mail($to, $subject, $message, $headers);
    // if ($mail_success) {
    //     Header('Location: ./manage_orders.php');
    //  } else {
    //      echo "Gửi email thất bại. Vui lòng kiểm tra lại cấu hình của bạn.";
    //  }
    echo "Email đã được gửi đi thành công!";
}
?>