<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ViVuViet - About</title>
    <link rel="stylesheet" type="text/css" href="styles/css/main_style.css">
    <link rel="stylesheet" type="text/css" href="styles/css/Animation.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/tooltipster/dist/css/tooltipster.bundle.min.css" />
    <script type="text/javascript" src="styles/tooltipster/dist/js/tooltipster.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script>
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 35 || document.documentElement.scrollTop > 35) {
                $(document).ready(function () {
                    $(".top_bar").hide();
                });

            } else {
                $(document).ready(function () {
                    $(".top_bar").show();
                });
            }
        }

        $(document).ready(function () {
            $('.bar_1').animate({
                width: "70%"
            });
            $('.bar_2').animate({
                width: "40%"
            });
            $('.bar_3').animate({
                width: "43%"
            });
            $('.bar_4').animate({
                width: "65%"
            });
        });
        $(document).ready(function() {
            $('.tooltip').tooltipster();
        });
    </script>
</head>
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
                <div class="bar__user-login"><a href="register.php">login</a></div>
                <div class="bar__user-regis"><a href="login.php">register</a></div>
            </div>
        </div>

        <div class="main_nav">
            <div class="main_nav__logo"><a href="#"><img src="styles/images/logo.png" alt="logo"> VIVUVIET</a></div>
            <div class="main_nav__menu">
            <ul class="main_nav__list">
                    <li class="main_nav__item"><a href="index.php">TRANG CHỦ</a></li>
                    <li class="main_nav__item"><a href="about.php">GIỚI THIỆU</a></li>
                    <li class="main_nav__item"><a href="blog.php">TOUR DU LICH</a></li>
                    <li class="main_nav__item"><a href="offers.php">TIN TỨC</a></li>
                    <li class="main_nav__item"><a href="contact.php">LIÊN HỆ</a></li>
                </ul>
            </div>
            <div class="main_nav__search"></div>
        </div>
    </header>
    <div class="main">
        <div class="main__slide_offers">
            <div class="home_slide__item">
                <div class="home_slide__background"
                     style="background-image: url(styles/images/about_slide.jpg)"></div>
                <div class="home__content">
                    <div class="home__title animated bounceInDown">
                        Giới thiệu
                    </div>
                </div>
            </div>
        </div>

        <!--        About us-->
        <div class="about">
            <div class="box about__box">
                <div class="about__image"><img src="styles/images/intro.png" alt=""></div>
                <div class="about__content">
                    <div class="about__title">Về chúng tôi</div>
                    <p class="about__text">ViVuViet là trang website bán tour du lịch hàng đầu Việt Nam, với tiêu chí
                        tour không hoàn, không hủy, không thay đổi lịch trình. Gía cả tốt nhất thị trường hơn hết đảm
                        bảo cho du khách có những trải nghiệm thú vị nhất, dịch dụ chuyên nghiệp nhất khi mua tour tại
                        đây. ViVuViet phục vụ du khách đi tham quan du lịch trên cả 5 châu, du lịch ra nước ngoài tại
                        đây rất được khách hàng tin tưởng và đánh giá cao.</p>
                    <div class="button button_about">
                        <div class="button_bcg"></div>
                        <a href="#">Đọc thêm <span></span><span></span><span></span></a>
                    </div>
                </div>

            </div>
        </div>
        <div class="statistic">
            <div class="box statistic__box">
                <h2>Thống kê theo năm</h2>
                <p class="statistic__text">Thống kê số lượng khách hàng, khách hàng quay lại, các hoạt động và số lượng
                    tour giữa năm 2018 và 2019 của chúng tôi</p>
                <div class="statistic__content">
                    <div class="statistic__item">
                        <div class="stats">
                            <div class="stats__icon"><i class="fas fa-user-friends"></i></div>
                            <div class="stats__content">
                                <div class="stats__number">13456</div>
                                <div class="stats__type">Khách hàng</div>
                            </div>
                        </div>
                        <div class="stats__bar">
                            <div class="stats__year">2018 <i class="fas fa-level-down-alt"></i></div>
                            <div class="stats__bar1"></div>
                            <div class="tooltip bar_1 stats__bar2" title="Tăng 20%"></div>
                        </div>
                    </div>
                    <div class="statistic__item">
                        <div class="stats">
                            <div class="stats__icon"><i class="fas fa-hiking"></i></div>
                            <div class="stats__content">
                                <div class="stats__number">6564</div>
                                <div class="stats__type">Khách hàng quay lại</div>
                            </div>
                        </div>
                        <div class="stats__bar">
                            <div class="stats__year">2018 <i class="fas fa-level-down-alt"></i></div>
                            <div class="stats__bar1"></div>
                            <div class="tooltip bar_2 stats__bar2" title="Giảm 10%"></div>
                        </div>
                    </div>
                    <div class="statistic__item">
                        <div class="stats">
                            <div class="stats__icon"><i class="fas fa-umbrella-beach"></i></div>
                            <div class="stats__content">
                                <div class="stats__number">906</div>
                                <div class="stats__type">Hoạt động</div>
                            </div>
                        </div>
                        <div class="stats__bar">
                            <div class="stats__year">2018 <i class="fas fa-level-down-alt"></i></div>
                            <div class="stats__bar1"></div>
                            <div class="tooltip bar_3 stats__bar2" title="Giảm 7%"></div>
                        </div>
                    </div>
                    <div class="statistic__item">
                        <div class="stats">
                            <div class="stats__icon"><i class="fas fa-globe-asia"></i></div>
                            <div class="stats__content">
                                <div class="stats__number">1320</div>
                                <div class="stats__type">Số lượng tour</div>
                            </div>
                        </div>
                        <div class="stats__bar">
                            <div class="stats__year">2018 <i class="fas fa-level-down-alt"></i></div>
                            <div class="stats__bar1"></div>
                            <div class="tooltip bar_4 stats__bar2" title="Tăng 15%"></div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <footer class="footer">
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
    $(function () {
        $("#tabs").tabs();
    });

</script>

</html>