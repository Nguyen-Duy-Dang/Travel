-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 13, 2023 lúc 07:20 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duan1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdattuor`
--

CREATE TABLE `chitietdattuor` (
  `id_chitietdattuor` int(11) NOT NULL,
  `id_dattuor` int(11) NOT NULL,
  `id_tour` int(11) NOT NULL,
  `so_nguoi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia`
--

CREATE TABLE `danhgia` (
  `id_danhgia` int(11) NOT NULL,
  `id_nguoidung` int(11) NOT NULL,
  `id_tour` int(11) NOT NULL,
  `nhan_xet` text NOT NULL,
  `ngay_danhgia` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhgia`
--

INSERT INTO `danhgia` (`id_danhgia`, `id_nguoidung`, `id_tour`, `nhan_xet`, `ngay_danhgia`) VALUES
(1, 19, 8, 'tour rẻ, chất lượng', '2023-11-29 21:30:32'),
(2, 24, 17, 'wowww', '2023-11-29 21:49:18'),
(3, 24, 17, 'qưeqwe', '2023-11-29 21:49:21'),
(4, 24, 17, 'qưeqwe', '2023-11-29 21:49:23'),
(5, 24, 7, '23432', '2023-11-29 21:49:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `datkhachsan`
--

CREATE TABLE `datkhachsan` (
  `id_datkhachsan` int(11) NOT NULL,
  `id_khachsan` int(11) NOT NULL,
  `id_nguoidung` int(11) NOT NULL,
  `ngay_checkin` date NOT NULL,
  `ngay_checkout` date NOT NULL,
  `so_phong` int(11) NOT NULL,
  `so_nguoi` int(11) NOT NULL,
  `tong_gia` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `datkhachsan`
--

INSERT INTO `datkhachsan` (`id_datkhachsan`, `id_khachsan`, `id_nguoidung`, `ngay_checkin`, `ngay_checkout`, `so_phong`, `so_nguoi`, `tong_gia`) VALUES
(1, 1, 19, '2023-12-14', '2023-12-17', 1, 2, 9000000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dattour`
--

CREATE TABLE `dattour` (
  `id_dattuor` int(11) NOT NULL,
  `id_nguoidung` int(11) DEFAULT NULL,
  `id_tour` int(11) DEFAULT NULL,
  `so_nguoi` int(11) DEFAULT NULL,
  `tong_gia` decimal(10,2) DEFAULT NULL,
  `trang_thai` enum('Chờ xác nhận','Đã xác nhận','Đã hủy') DEFAULT 'Chờ xác nhận',
  `ngay_di` date DEFAULT NULL,
  `ngay_ve` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dattour`
--

INSERT INTO `dattour` (`id_dattuor`, `id_nguoidung`, `id_tour`, `so_nguoi`, `tong_gia`, `trang_thai`, `ngay_di`, `ngay_ve`) VALUES
(5, 19, 12, 7, 99999999.99, 'Đã xác nhận', '2023-12-01', '2023-12-03'),
(6, 22, 18, 3, 99999999.99, 'Đã xác nhận', '2023-12-06', '2023-12-10'),
(7, 22, 18, 3, 99999999.99, 'Đã hủy', '2023-12-06', '2023-12-10'),
(8, 22, 14, 2, 140000.00, 'Chờ xác nhận', '2023-12-05', '2023-12-10'),
(9, 19, 7, 3, 15000.00, 'Đã xác nhận', '2023-12-05', '2023-12-10'),
(10, 19, 8, 2, 400000.00, 'Chờ xác nhận', '2023-12-07', '2023-12-17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachsan`
--

CREATE TABLE `khachsan` (
  `ten_khachsan` varchar(255) NOT NULL,
  `dia_chi` varchar(100) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `gia_phong` decimal(10,2) DEFAULT NULL,
  `url_hinh` varchar(255) DEFAULT NULL,
  `id_khachsan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachsan`
--

INSERT INTO `khachsan` (`ten_khachsan`, `dia_chi`, `mo_ta`, `gia_phong`, `url_hinh`, `id_khachsan`) VALUES
('Intercontinentals Đà Nẵng', 'Đà Nẵng', 'à men ádashjd jasfjdhajkhsf kjahfkajhdf kjhadfkjh adkjfhakdjfhakjdhf akjdhf kạdfhkajdfhakjdh fkjadhf fkjadfhfakjdfhka jhdffkujadf', 1500000.00, 'images.jpg', 1),
('Intercontinentals Đà Nẵng 2', 'DN', 'Khách sạn Sang Trọng Bên Bờ Biển\r\n\r\nChào mừng đến với không gian sang trọng và tiện nghi tại Khách sạn Bên Bờ Biển! Nằm bên cạnh bờ biển tuyệt vời, chúng tôi tự hào mang đến trải nghiệm lưu trú độc đáo và không gian ấm cúng cho du khách.\r\n\r\n**Vị trí Tuyệt Vời:**\r\nVới vị trí lý tưởng ngay bên bờ biển, khách sạn chúng tôi tạo nên một không gian yên bình, giúp du khách tránh xa khỏi sự ồn ào của thành phố. Tận hưởng khung cảnh biển cả đẹp như tranh và thức dậy mỗi buổi sáng với hương biển mặn, hòa mình vào không gian thiên nhiên hòa quyện.\r\n\r\n**Tiện Nghi Sang Trọng:**\r\nKhách sạn Bên Bờ Biển tự hào với những phòng nghỉ đẳng cấp, được thiết kế hiện đại và tiện nghi đầy đủ. Mỗi căn phòng đều có ban công riêng, nơi bạn có thể thư giãn và ngắm nhìn bức tranh biển hùng vĩ. Trang bị đầy đủ các tiện nghi như TV màn hình phẳng, minibar, máy pha cà phê và internet tốc độ cao giúp khách hàng duy trì liên lạc và giải trí mọi lúc.\r\n\r\n**Nhà Hàng Ngon Miệng:**\r\nNhà hàng của chúng tôi sẽ đưa bạn hòa mình vào một hành trình ẩm thực phong phú. Dù là ăn sáng, trưa hay tối, đội ngũ đầu bếp tài năng của chúng tôi sẽ mang đến cho bạn những món ăn tinh tế và độc đáo, từ hải sản tươi ngon cho đến các món ăn quốc tế hấp dẫn.\r\n\r\n**Spa và Trung Tâm Thể Dục:**\r\nĐể mang lại trải nghiệm lưu trú toàn diện, khách sạn chúng tôi cung cấp dịch vụ spa chất lượng cao và trung tâm thể dục hiện đại. Hãy để bản thân bạn được thư giãn và tái tạo năng lượng trong không gian tĩnh lặng và thoải mái của spa hoặc thử thách bản thân tại phòng tập gym với trang thiết bị đa dạng.\r\n\r\n**Phục Vụ Tận Tâm:**\r\nĐội ngũ nhân viên tận tâm và chuyên nghiệp của chúng tôi luôn sẵn lòng phục vụ bạn 24/7, đảm bảo mọi nhu cầu của bạn được đáp ứng một cách nhanh chóng và chất lượng nhất.\r\n\r\nKhách sạn Bên Bờ Biển là điểm đến lý tưởng cho những ai tìm kiếm sự hoàn hảo trong mọi chi tiết. Hãy đặt phòng ngay hôm nay để trải nghiệm không gian lưu trú đẳng cấp và đáng nhớ!', 99999999.99, 'tour9.jpg', 3),
('Intercontinentals Đà Nẵng 4', 'DN', ' lkasdj lkajsdasdj ád khien bao àh adkhf kạhfaue ádh con ala dahsdf àn roi alna i mahf hadf adf  ', 5000000.00, 'tải xuống.jpg', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `id_nguoidung` int(11) NOT NULL,
  `ten_dangnhap` varchar(50) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ho_ten` varchar(100) DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `vai_tro` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`id_nguoidung`, `ten_dangnhap`, `mat_khau`, `email`, `ho_ten`, `so_dien_thoai`, `vai_tro`) VALUES
(19, 'admin', '12345', 'admin@gmail.com', 'admin', '0987654321', 1),
(22, 'khach1', '123', 'khach1@gmail.com', 'khach\'', '09882424525', 0),
(23, 'lailadghouse', '12345', 'hehe123@123', 'Rái Đơ!!', '0923423234', 0),
(24, 'demo123', '123', 'banhmiong6@gmail.com', 'tra vít cốt', '0923423234', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `id_tintuc` int(11) NOT NULL,
  `tieu_de` varchar(255) NOT NULL,
  `noi_dung` text NOT NULL,
  `ngay_dang` datetime NOT NULL,
  `url_hinh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`id_tintuc`, `tieu_de`, `noi_dung`, `ngay_dang`, `url_hinh`) VALUES
(0, 'tin tuc', '234234', '2023-12-13 14:02:00', '../uploads/image_a.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tour`
--

CREATE TABLE `tour` (
  `id_tour` int(11) NOT NULL,
  `ten_tour` varchar(255) NOT NULL,
  `dia_diem` varchar(100) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `ngay_khoi_hanh` date DEFAULT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `gia_tour` float DEFAULT NULL,
  `url_hinh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tour`
--

INSERT INTO `tour` (`id_tour`, `ten_tour`, `dia_diem`, `mo_ta`, `ngay_khoi_hanh`, `ngay_ket_thuc`, `gia_tour`, `url_hinh`) VALUES
(7, 'Tây Nguyên', 'Tây Nguyên', 'Thái Lan là đất nước phồn hoa nổi tiếng với nền văn hóa - lịch sử lâu đời cùng hình ảnh con người thân thiện, mến khách. Ghé thăm \"xứ sở chùa Vàng\", du khách sẽ có cơ hội tham quan những ngôi chùa thiêng liêng, nổi tiếng; khám phá những công trình kiến trúc hiện đại cùng nhiều trải nghiệm hấp dẫn, tiêu biểu như: tắm biển tại Coral, thưởng thức buffet tại tòa nhà 86 tầng BaiYoke Sky, trải nghiệm massage Thái cổ truyền,...', '2023-03-12', '2023-03-14', 1000, 'hinh1.jpg'),
(8, 'demo1', 'demo1', 'demo1', '2023-12-24', '2023-12-16', 20000, 'tour99.jpg'),
(12, 'demo146', 'quảng man', 'man', '2023-10-24', '2023-04-23', 100000000, 'img_65572662b06ad.jpg'),
(14, 'fghfghfghfghfgh', 'gfhfghfgh', 'fghfghfghfg', '2025-10-10', '2026-10-10', 14000, 'demo2.jpg'),
(16, 'ádasdas', 'ádasd', 'ádasd', '0000-00-00', '0000-00-00', 100000000, 'tải xuống.jpg'),
(17, 'rtyhrt', 'rthrth', 'rthrth', '0134-03-12', '1341-04-13', 100000000, 'tour88.jpg'),
(18, '134134', '13413', '134', '0134-04-13', '0000-00-00', 100000000, 'tour89.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`id_danhgia`),
  ADD KEY `fk_danhgia_nguoidung` (`id_nguoidung`),
  ADD KEY `fk_danhgia_tour` (`id_tour`);

--
-- Chỉ mục cho bảng `datkhachsan`
--
ALTER TABLE `datkhachsan`
  ADD PRIMARY KEY (`id_datkhachsan`),
  ADD KEY `fk_datkhachsan_khachsan` (`id_khachsan`),
  ADD KEY `fk_datkhachsan_nguoidung` (`id_nguoidung`);

--
-- Chỉ mục cho bảng `dattour`
--
ALTER TABLE `dattour`
  ADD PRIMARY KEY (`id_dattuor`),
  ADD KEY `id_nguoidung` (`id_nguoidung`),
  ADD KEY `id_tour` (`id_tour`);

--
-- Chỉ mục cho bảng `khachsan`
--
ALTER TABLE `khachsan`
  ADD PRIMARY KEY (`id_khachsan`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`id_nguoidung`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`id_tintuc`);

--
-- Chỉ mục cho bảng `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`id_tour`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `id_danhgia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `datkhachsan`
--
ALTER TABLE `datkhachsan`
  MODIFY `id_datkhachsan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `dattour`
--
ALTER TABLE `dattour`
  MODIFY `id_dattuor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `khachsan`
--
ALTER TABLE `khachsan`
  MODIFY `id_khachsan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `id_nguoidung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `tour`
--
ALTER TABLE `tour`
  MODIFY `id_tour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdattuor`
--
ALTER TABLE `chitietdattuor`
  ADD CONSTRAINT `chitietdattuor_ibfk_1` FOREIGN KEY (`id_dattuor`) REFERENCES `dattuor` (`id_dattuor`),
  ADD CONSTRAINT `chitietdattuor_ibfk_2` FOREIGN KEY (`id_tour`) REFERENCES `tour` (`id_tour`);

--
-- Các ràng buộc cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `fk_danhgia_nguoidung` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`),
  ADD CONSTRAINT `fk_danhgia_tour` FOREIGN KEY (`id_tour`) REFERENCES `tour` (`id_tour`);

--
-- Các ràng buộc cho bảng `datkhachsan`
--
ALTER TABLE `datkhachsan`
  ADD CONSTRAINT `fk_datkhachsan_khachsan` FOREIGN KEY (`id_khachsan`) REFERENCES `khachsan` (`id_khachsan`),
  ADD CONSTRAINT `fk_datkhachsan_nguoidung` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`);

--
-- Các ràng buộc cho bảng `dattour`
--
ALTER TABLE `dattour`
  ADD CONSTRAINT `dattour_ibfk_1` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`),
  ADD CONSTRAINT `dattour_ibfk_2` FOREIGN KEY (`id_tour`) REFERENCES `tour` (`id_tour`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
