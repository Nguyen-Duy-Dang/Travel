<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ViVuViet</title>
    <link rel="shortcut icon" href="./style/img/logoo.jpg">
    <link rel="stylesheet" type="text/css" href="styles/css/main_style.css">
    <link rel="stylesheet" type="text/css" href="styles/css/Animation.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick-theme.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script>
        window.onscroll = function () {
            scrollFunction(),
                backTop()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 35 || document.documentElement.scrollTop > 35) {
                $(document).ready(function () {
                    $(".top_bar").hide('slow');
                });

            } else {
                $(document).ready(function () {
                    $(".top_bar").show();
                });
            }
        }

        $(function () {
            $("#tabs").tabs();
        });

        $(document).ready(function () {
            $(".search__item").click(function () {
                $(".input_search").toggle("slow");
            });
        })
    </script>
</head>
<body>
<body>
<div id="wrapper">
    <!-- Header -->
    <header class="header">
        <!-- Top Bar -->
        <div class="top_bar">
            <div class="bar__info">
                <div class="phone">+84 788 079 036</div>
                <div class="social">
                    <ul class="social_list">
                        <li class="social_list_item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="social_list_item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li class="social_list_item"><a href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>

            </div>
            <div class="bar__user">
                        <?php
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        if (isset($_SESSION['id_nguoidung']) && !empty($_SESSION['id_nguoidung'])) {
                            // Hiển thị khi đã đăng nhập
                            echo '<div class="bar__user-login">Xin chào, ' . $_SESSION['id_nguoidung'] . '</div>';
                            echo '<div class="bar__user-regis"><a href="logout.php">Đăng xuất</a></div>';
                        } else {
                            // Hiển thị khi chưa đăng nhập
                            echo '<div class="bar__user-login"><a href="login.php">Đăng nhập</a></div>';
                            echo '<div class="bar__user-regis"><a href="register.php">Đăng ký</a></div>';
                        }
                        ?>
                
</div>

        </div>

        <div class="main_nav">
            <div class="main_nav__logo"><a href="#"><img src="styles/images/logo.png" alt="logo"> VIVUVIET</a></div>
            <div class="main_nav__menu">
                <ul class="main_nav__list">
                    <li class="main_nav__item"><a href="index.php">TRANG CHỦ</a></li>
                    <li class="main_nav__item"><a href="about.php">GIỚI THIỆU</a></li>
                    <li class="main_nav__item"><a href="main.php">TOUR DU LICH</a></li>
                    <li class="main_nav__item"><a href="hotel.php">Khách Sạn</a></li>
                    <li class="main_nav__item"><a href="cart.php">GIỎ HÀNG</a></li>
                    <li class="main_nav__item"><a href="blog.php">TIN TỨC</a></li>
                    <li class="main_nav__item"><a href="contact.php">LIÊN HỆ</a></li>
                </ul>
            </div>

            <div style="display: flex; " class="search" >
                    <form style="display: flex;" action="search_tour.php" method="post">
                        <input style="width:12vw; height: 2vw; " class="search-mini-form" type="text" name="nd_name" placeholder="Tìm kiếm tại đây...">
                        <input style="margin-left   :0.5vw;   background: aqua;border: aqua; " class="btn-search" type="submit" value="Tìm kiếm" name="search_name">
                    </form>
                </div>
            <!-- <div class="main_nav__search">
                <form action=""><input class="input_search" type="text"></form>
                <div class="search__item"><i class="fas fa-search"></i></div>
            </div> -->
        </div>
    </header>
    <div class="main">
        <!--slider-->
        <div class="main__slide">
            <div class="home_slide__item">
                <div class="home_slide__background"
                     style="background-image: url(styles/images/bana-slide.jpg)"></div>
                <div class="home_slider__content">
                    <div class="home_slider_content_inner animated bounceInLeft">
                        <h1>tour</h1>
                        <h1>Bana Hill</h1>
                        <div class="button home_slider__button">
                            <div class="button_bcg"></div>
                            <a href="#">Xem ngay<span></span><span></span><span></span></a></div>
                    </div>
                </div>
            </div>
            <div class="home_slide__item">
                <div class="home_slide__background"
                     style="background-image: url(styles/images/hoian-slide.jpg)"></div>
                <div class="home_slider__content">
                    <div class="home_slider_content_inner animated bounceInRight">
                        <h1>tour</h1>
                        <h1>Hội An</h1>
                        <div class="button home_slider__button">
                            <div class="button_bcg"></div>
                            <a href="#">Xem ngay<span></span><span></span><span></span></a></div>
                    </div>
                </div>
            </div>
            <div class="home_slide__item">
                <div class="home_slide__background"
                     style="background-image: url(styles/images/phuquoc_slide.jpg)"></div>
                <div class="home_slider__content">
                    <div class="home_slider_content_inner animated bounceInDown">
                        <h1>tour</h1>
                        <h1>Phú Quốc</h1>
                        <div class="button home_slider__button">
                            <div class="button_bcg"></div>
                            <a href="#">Xem ngay<span></span><span></span><span></span></a></div>
                    </div>
                </div>
            </div>
            <div class="main_slide__nav nav__prev"><i onclick="plusSlides(-1)" class="fas fa-chevron-circle-left"></i>
            </div>
            <div class="main_slide__nav nav__next"><i onclick="plusSlides(1)"
                                                      class="fas fa-chevron-circle-right"></i></i>
            </div>
            <div class="main_slide__dots">
                <ul class="customs_dots">
                    <li class="customs_dot active" onclick="currentSlide(1)">01.</li>
                    <li class="customs_dot" onclick="currentSlide(2)">02.</li>
                    <li class="customs_dot" onclick="currentSlide(3)">03.</li>
                </ul>
            </div>
        </div>
       
    </div>

</div>

</body>
<script src="styles/js/main_js.js"></script>
<script>

    $("#single_item").slick({
        dots: true
    });
    $("#testimonials").slick({
        dots: false
    });
</script>

</html>
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
    <h1>Tất cả tour</h1>
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
                    <button class="book-button" (<?= $tour['id_tour'] ?>)">Đặt Tour</button>
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
    
</body>

</html>

<footer class="footer">
        <button onclick="topFunction()" id="back_top" title="Go to top"><i class="fas fa-rocket"></i></button>
        <div class="box footer__box">
            <div class="footer__about">
                <div class="footer__logo">
                    <div class="logo">
                        <a href="#"><img src="styles/images/logo.png" alt="">VIVUVIET</a>
                    </div>
                </div>
                <p class="footer_about__text">
                    ViVuViet tự hào là một đơn vị tiêu biểu trong lĩnh vực tour du lịch đón nhận giải thưởng uy tín
                    nhất dành cho cộng đồng doanh nghiệp Việt Nam.
                </p>
                <ul class="footer_social_list">
                    <li class="footer_social_item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="footer_social_item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li class="footer_social_item"><a href="#"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
            <div class="footer__blog">
                <div class="footer_title">bản tin</div>
                <div class="footer_blog__item">
                    <div class="footer_blog__image"><img src="styles/images/footer_blog_1.jpg" alt=""></div>
                    <div class="footer_blog__content">
                        <div class="footer_blog__title"><a href="#">Địa điểm du lịch Hè 2019</a></div>
                        <div class="footer_blog__date">30/04/2019</div>
                    </div>
                </div>
                <div class="footer_blog__item">
                    <div class="footer_blog__image"><img src="styles/images/footer_blog_1.jpg" alt=""></div>
                    <div class="footer_blog__content">
                        <div class="footer_blog__title"><a href="#">Địa điểm du lịch Hè 2019</a></div>
                        <div class="footer_blog__date">30/04/2019</div>
                    </div>
                </div>
                <div class="footer_blog__item">
                    <div class="footer_blog__image"><img src="styles/images/footer_blog_1.jpg" alt=""></div>
                    <div class="footer_blog__content">
                        <div class="footer_blog__title"><a href="#">Địa điểm du lịch Hè 2019</a></div>
                        <div class="footer_blog__date">30/04/2019</div>
                    </div>
                </div>
            </div>
            <div class="footer__tags">
                <div class="footer_title">Tags</div>
                <ul class="tags_list">
                    <li class="tags_item"><a href="#">Miền Bắc</a></li>
                    <li class="tags_item"><a href="#">Miền Trung</a></li>
                    <li class="tags_item"><a href="#">Miền Nam</a></li>
                    <li class="tags_item"><a href="#">Đà Nẵng</a></li>
                    <li class="tags_item"><a href="#">Quảng Nam</a></li>
                    <li class="tags_item"><a href="#">Huế</a></li>
                </ul>
            </div>
            <div class="footer__contact">
                <div class="footer_title">Liên hệ</div>
                <ul class="contact_list">
                    <li class="contact_item">
                        <div class="contact_icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="contact_text">137 Nguyễn Thị Thập, Hòa Minh, Liên Chiểu, Đà Nẵng</div>
                    </li>
                    <li class="contact_item">
                        <div class="contact_icon"><i class="fas fa-phone-square"></i></div>
                        <div class="contact_text">+84 788 079 036</div>
                    </li>
                    <li class="contact_item">
                        <div class="contact_icon"><i class="fas fa-envelope"></i></div>
                        <div class="contact_text">vivuviet@gmail.com</div>
                    </li>
                    <li class="contact_item">
                        <div class="contact_icon"><i class="fas fa-globe-asia"></i></div>
                        <div class="contact_text">www.vivuviet.tk</div>
                    </li>

                </ul>
            </div>
        </div>
    </footer>

</div>

</body>
<script src="styles/js/main_js.js"></script>
<script>

    $("#single_item").slick({
        dots: true
    });
    $("#testimonials").slick({
        dots: false
    });
</script>

</html>