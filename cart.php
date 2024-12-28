<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once("../DuAn1/config/database.php");

// Function datTour here...

$userId = isset($_SESSION['id_nguoidung']) ? $_SESSION['id_nguoidung'] : null;

// Kiểm tra đăng nhập
if (!$userId) {
    echo '<div class="bg-yellow-200 p-4 mb-4 text-yellow-800">Bạn cần đăng nhập để xem giỏ hàng.</div>';
} else {
    // Lấy thông tin tour đã đặt theo id_nguoidung
    $stmtCart = $conn->prepare("SELECT * FROM dattour WHERE id_nguoidung = ?");
    $stmtCart->execute([$userId]);
    $cartItems = $stmtCart->fetchAll(PDO::FETCH_ASSOC);

    if (!$cartItems) {
        echo '<div class="bg-blue-200 p-4 mb-4 text-blue-800">Giỏ hàng của bạn trống.</div>';
    } else {
        // Tính tổng tiền
        $tongTien = 0;

        // Hiển thị thông tin giỏ hàng
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
            <link rel="stylesheet" href="path/to/your/custom.css"> <!-- Thêm file CSS tùy chỉnh của bạn -->
            <title>Giỏ Hàng</title>
            <style>
                body {
                    background-color: #f8f9fa;
                }

                .container {
                    background: #8A2387;
                    /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #F27121, #E94057, #8A2387);
                    /* Chrome 10-25, Safari 5.1-6 */
                    background: linear-gradient(to right, #F27121, #E94057, #8A2387);
                    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

                    padding: 20px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                .alert {
                    margin-top: 20px;
                }

                .cart-item {
                    border: 1px solid #fff;
                    margin-bottom: 20px;
                    border-radius: 8px;
                    overflow: hidden;
                    background-color: rgba(169, 169, 169, 0.3);
                    height: 300px;
                }

                .cart-item img {
                    width: 300px;
                    height: 300px;
                    object-fit: cover;
                }

                .cart-item-details {
                    padding: 20px;
                }

                .cart-item-details h3 {
                  
                    color: #fff;
                }

                .cart-item-details p {
                    color: #fff;
                    font-size: 14px;
                    margin-bottom: 8px;
                    font-weight: bold;
                }

                .cart-item-details .total-price {
                    color: #8A2387;
                    font-size: 18px;
                    font-weight: bold;
                }

                .btn-primary {
                    background: #b92b27;
                    /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #1565C0, #b92b27);
                    /* Chrome 10-25, Safari 5.1-6 */
                    background: linear-gradient(to right, #1565C0, #b92b27);
                    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

                    color: #ffffff;
                    width: 100px;
                    height: 50px;
                    border-radius: 10px;
                }

                .btn-success {
                    background: #b92b27;
                    /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #1565C0, #b92b27);
                    /* Chrome 10-25, Safari 5.1-6 */
                    background: linear-gradient(to right, #1565C0, #b92b27);
                    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

                    border-color: #28a745;
                    width: 150px;
                    height: 50px;
                    border-radius: 10px;
                    color: #ffffff;
                }

                .font-bold {
                    color: #f8f9fa;
                    font-size: larger;
                }

                /* Hiển thị form thanh toán giữa màn hình */
                .payment-form {
                    display: none;
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                    z-index: 1000;
                }
                .payment-form h2{
                    color: black;
                    font-size: medium;
                    justify-content: center;
                }

                /* Định dạng style của nút thanh toán */
                .btn-success {
                    background-color: #28a745;
                    border-color: #28a745;
                    width: 150px;
                    height: 50px;
                    border-radius: 10px;
                    color: #ffffff;
                    cursor: pointer;
                }

                .btn-success:hover {
                    background-color: #218838;
                }

                /* Định dạng style của input và select trong form */
                .payment-form input,
                .payment-form select {
                    width: 100%;
                    padding: 8px;
                    margin-bottom: 10px;
                    border: 1px solid #ced4da;
                    border-radius: 4px;
                    box-sizing: border-box;
                }

                /* Định dạng style của nút xác nhận trong form */
                .payment-form button {
                    background-color: #007bff;
                    border-color: #007bff;
                    color: #ffffff;
                    padding: 10px;
                    border-radius: 4px;
                    cursor: pointer;
                }

                .payment-form button:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>

        <body>
            <?php
            include("./header.php");
            ?>

            <div class="container mt-5">
                <h2 class="text-2xl font-bold mb-4">Tour Đã Đặt</h2>

                <?php foreach ($cartItems as $cartItem) : ?>
                    <div class="cart-item flex">
                        <?php
                        // Lấy thông tin của tour từ bảng tour dựa trên id_tour
                        $stmtTour = $conn->prepare("SELECT ten_tour, url_hinh FROM tour WHERE id_tour = ?");
                        $stmtTour->execute([$cartItem['id_tour']]);
                        $tour = $stmtTour->fetch(PDO::FETCH_ASSOC);

                        // Cộng dồn vào tổng tiền
                        $tongTien += $cartItem['tong_gia'];
                        ?>

                        <img src="./uploads/<?= $tour['url_hinh']; ?>" alt="<?= $tour['ten_tour']; ?>">

                        <div class="cart-item-details">
                            <h3><?= $tour['ten_tour']; ?></h3>
                            <p>Số Người: <?= $cartItem['so_nguoi']; ?></p>
                            <p>Ngày Đi: <?= $cartItem['ngay_di']; ?></p>
                            <p>Ngày Về: <?= $cartItem['ngay_ve']; ?></p>
                            <p class="total-price"><?= number_format($cartItem['tong_gia'], 2, '.', ',') . ' VND'; ?></p>
                            <p>Trạng Thái: <?= $cartItem['trang_thai']; ?></p>
                            <button class="btn btn-primary" onclick="showPaymentForm()">Thanh Toán</button>
                            <button class="btn btn-primary">Xóa</button>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="text-end mt-3">
                    <span class="font-bold">Tổng Tiền: <?= number_format($tongTien, 2, '.', ',') . ' VND'; ?></span>
                </div>
                <div class="text-end mt-3">
                    <button class="btn btn-success" onclick="showPaymentForm()">Thanh Toán Tất Cả</button>
                </div>
            </div>

            <!-- Form thanh toán -->
            <div id="paymentForm" class="payment-form">
                <h2 class="text-2xl font-bold mb-4">Thông Tin Thanh Toán</h2>

                <!-- Thêm thẻ img để hiển thị ảnh -->
                <img src="./uploads/tp-bank.png" alt="Bank Logo" style="width: 200px; height: 200px; display: block; margin: 0 auto;">

                <!-- Thêm các thẻ h2 hiển thị thông tin -->
                <h2>Chủ tài khoản: Nguyễn Duy Đẳng</h2>
                <h2>Số tài khoản: XXXXXXXXXXXXX</h2>
                <h2>Ngân hàng: TP Bank</h2>

                <label for="bank">Chọn Ngân Hàng:</label>
                <select id="bank" name="bank">
                <option value="TpBank">Tp bank</option>
                    <option value="acb">ACB Bank</option>
                    <option value="vietcombank">Vietcombank</option>
                    <option value="BIDV">BIDV</option>
                    <option value="Techcombank">Techcombank</option>
                    <option value="MBBank">MBBank</option>
                    <option value="Agribank">Agribank</option>
                    <option value="SHB">SHB</option>
                    <!-- ... -->
                </select>

                <label for="account">Số Tài Khoản:</label>
                <input type="text" id="account" name="account" placeholder="Nhập số tài khoản">

                <button onclick="confirmPayment()">Xác Nhận Thanh Toán</button>
             
            </div>

            <!-- Các đoạn script của bạn -->

            <script>
                function showPaymentForm() {
                    document.getElementById('paymentForm').style.display = 'block';
                }

                function confirmPayment() {
                    alert('Thanh toán thành công! Vui lòng chờ xử lý cho Tour của bạn');
                    document.getElementById('paymentForm').style.display = 'none';
                }
            </script>

            </script>

            <?php
            include_once('./footer.php');
            ?>
        </body>

        </html>

<?php
    }
}
?>