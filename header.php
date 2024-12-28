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
                    <li class="main_nav__item"><a href="tour.php">TOUR DU LICH</a></li>
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