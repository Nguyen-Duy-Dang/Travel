<?php
include_once("../config/database.php");

// Hàm xác thực role đăng nhập admin
function xacThucNguoiDung($tenDangNhap, $matKhau)
{
    global $conn;

    $tenDangNhap = htmlspecialchars($tenDangNhap); // Chống XSS attacks
    $matKhau = htmlspecialchars($matKhau);

    try {
        $query = "SELECT * FROM nguoidung WHERE ten_dangnhap = :tenDangNhap AND mat_khau = :matKhau";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tenDangNhap', $tenDangNhap);
        $stmt->bindParam(':matKhau', $matKhau);

        $stmt->execute();

        $nguoiDung = $stmt->fetch(PDO::FETCH_ASSOC);

        return $nguoiDung;
    } catch (PDOException $e) {
        die("Lỗi xác thực người dùng: " . $e->getMessage());
    }
}

// Hàm lấy danh sách tour từ database
function layDanhSachTour()
{
    global $conn;

    try {
        $query = "SELECT * FROM tour";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

function themTourMoi($tenTour, $diaDiem, $moTa, $ngayKhoiHanh, $ngayKetThuc, $giaTour, $urlHinh)
{
    global $conn;

    try {
        $query = "INSERT INTO tour (ten_tour, dia_diem, mo_ta, ngay_khoi_hanh, ngay_ket_thuc, gia_tour, url_hinh) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $tenTour);
        $stmt->bindParam(2, $diaDiem);
        $stmt->bindParam(3, $moTa);
        $stmt->bindParam(4, $ngayKhoiHanh);
        $stmt->bindParam(5, $ngayKetThuc);
        $stmt->bindParam(6, $giaTour);
        $stmt->bindParam(7, $urlHinh);

        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

// Hàm xử lý upload ảnh
function uploadHinhAnh($file)
{
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra xem tệp có tồn tại không
    if (file_exists($target_file)) {
        // Nếu tệp đã tồn tại, không cần tạo bản sao hoặc đổi tên
        return basename($file["name"]);
    } else {
        // Nếu tệp không tồn tại, tải lên và trả về tên tệp tin
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return basename($file["name"]);
        } else {
            return false;
        }
    }
}

// Hàm lấy thông tin tour theo id
function getTourById($tourId) {
    global $conn;

    try {
        $sql = "SELECT * FROM tour WHERE id_tour = :tourId";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':tourId', $tourId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $rowCount = $stmt->rowCount();

            if ($rowCount > 0) {
                $tour = $stmt->fetch(PDO::FETCH_ASSOC);
                return $tour;
            } else {
                throw new Exception("Không tìm thấy tour.");
            }
        } else {
            throw new Exception("Lỗi khi thực hiện truy vấn.");
        }
    } catch (Exception $e) {
        echo 'Lỗi: ' . $e->getMessage();
        return null;
    }
}

// Hàm lấy danh sách khách hàng từ database
function layDanhSachNguoiDung()
{
    global $conn;

    try {
        $query = "SELECT * FROM nguoidung";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

// Hàm xóa người dùng
function xoaNguoiDung($userId)
{
    global $conn;

    try {
        $query = "DELETE FROM nguoidung WHERE id_nguoidung = :userId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}
//Hàm lấy thông tin người dùng byID để sửa
function getNguoiDungById($userId) {
    global $conn;

    try {
        $query = "SELECT * FROM nguoidung WHERE id_nguoidung = :userId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        $stmt->execute();

        $nguoiDung = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$nguoiDung) {
            throw new Exception("Không tìm thấy người dùng.");
        }

        return $nguoiDung;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return null;
    }
}

//Hàm thêm user mới
function themNguoiDungMoi($tenDangNhap, $matKhau, $email, $hoTen, $soDienThoai, $vaiTro)
{
    global $conn;

    try {
        $query = "INSERT INTO nguoidung (ten_dangnhap, mat_khau, email, ho_ten, so_dien_thoai, vai_tro) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $tenDangNhap);
        $stmt->bindParam(2, $matKhau);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $hoTen);
        $stmt->bindParam(5, $soDienThoai);
        $stmt->bindParam(6, $vaiTro);

        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

//Hàm cập nhật thông tin user (sửa người dùng)
function capNhatNguoiDung($userId, $tenDangNhap, $matKhau, $email, $hoTen, $soDienThoai, $vaiTro)
{
    global $conn;

    try {
        $query = "UPDATE nguoidung 
                  SET ten_dangnhap = :tenDangNhap, mat_khau = :matKhau, email = :email, ho_ten = :hoTen, so_dien_thoai = :soDienThoai, vai_tro = :vaiTro
                  WHERE id_nguoidung = :userId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tenDangNhap', $tenDangNhap);
        $stmt->bindParam(':matKhau', $matKhau);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':hoTen', $hoTen);
        $stmt->bindParam(':soDienThoai', $soDienThoai);
        $stmt->bindParam(':vaiTro', $vaiTro);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

//quản lý tin tức
function layDanhSachTinTuc()
{
    global $conn;

    try {
        $query = "SELECT * FROM tintuc";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

//quản lý bình luận
function layDanhSachBinhLuan(){

 
    global $conn;

    try {
        $query = "SELECT * FROM danhgia ORDER BY id_danhgia DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

//xử lý đặt tour
function updateOrderStatus($id_dattuor, $action)
{
    // Hàm cập nhật trạng thái đơn đặt tour
    global $conn;
    // $action có thể là 'confirm' hoặc 'cancel'
    // Kiểm tra hành động và cập nhật trạng thái tương ứng
    switch ($action) {
        case 'confirm':
            $trang_thai_moi = 'Đã xác nhận';
            break;
        case 'cancel':
            $trang_thai_moi = 'Đã hủy';
            break;
        default:
            // Nếu hành động không hợp lệ, không làm gì cả
            return;
    }

    // Cập nhật trạng thái
    $stmt = $conn->prepare("UPDATE dattour SET trang_thai = ? WHERE id_dattuor = ?");
    $stmt->execute([$trang_thai_moi, $id_dattuor]);
}

function getAllOrders()
{
    global $conn;
    // Hàm lấy tất cả đơn đặt tour từ bảng dattour
    $stmt = $conn->query("SELECT * FROM dattour");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $orders;
}

function layDanhDonHang(){

 
    global $conn;

    try {
        $query = "SELECT * FROM dattour ORDER BY id_dattuor DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}


?>
