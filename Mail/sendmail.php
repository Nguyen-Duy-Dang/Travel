<?php
// Bước 1: Đưa đường dẫn đến tệp PHPMailer
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Bước 2: Tạo một đối tượng PHPMailer mới
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($toEmail, $toName, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Thiết lập thông số cho máy chủ SMTP của bạn
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // Bạn có thể thay đổi thành SMTP::DEBUG_SERVER để kiểm tra lỗi (nếu có)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Địa chỉ máy chủ SMTP của bạn
        $mail->SMTPAuth   = true;
        $mail->Username   = 'thanhnv2923@gmail.com'; // Tên đăng nhập SMTP của bạn
        $mail->Password   = 'ntfyctlhboaakbva'; // Mật khẩu SMTP của bạn
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Sử dụng TLS hoặc PHPMailer::ENCRYPTION_SMTPS nếu sử dụng SSL
        $mail->Port       = 587; // Cổng của máy chủ SMTP của bạn (587 cho TLS, 465 cho SSL)

        // Thiết lập thông tin người gửi và người nhận
        $mail->setFrom('thanhnv2923@gmail.com', 'Thành'); // Địa chỉ email của bạn và tên bạn muốn hiển thị
        $mail->addAddress($toEmail, $toName); // Địa chỉ email và tên của người nhận
        $mail->addReplyTo('your_email@example.com', 'Your Name'); // Địa chỉ email để phản hồi (tùy chọn)

        // Thêm CC và BCC nếu cần thiết
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Thiết lập nội dung email
        $mail->isHTML(true); // Nội dung email là HTML
        $mail->Subject = $subject; // Tiêu đề email
        $mail->Body    = $body; // Nội dung email (có thể sử dụng mã HTML)

        // Gửi email
        $mail->send();
        echo 'Email đã được gửi thành công';
    } catch (Exception $e) {
        echo "Lỗi: {$mail->ErrorInfo}";
    }
}

// Gọi hàm gửi email
$toEmail = 'thanhne20092003@gmail.com';
$toName = 'Recipient Name';
$subject = 'Chủ đề email';
$body = '<h1>Đây là nội dung email</h1><p>Xin chào!</p>';
sendEmail($toEmail, $toName, $subject, $body);
?>