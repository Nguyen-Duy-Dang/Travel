<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/css/header.css">
    <link rel="stylesheet" href="../style/css/main.css">
    <link rel="stylesheet" href="../style/css/footer.css">
    <link rel="stylesheet" href="../style/css/csstrangcon.css/introduce.css">
    <link rel="stylesheet" href="../style/css/csstrangcon.css/news.css">
</head>
 <style>
    iframe{
    margin-top:1vw;
    height: 45vw;
}
        /* Thay đổi kích thước map */
        .map-container {
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
            height: 0;
        }
        .map-container iframe {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }
        /* Các tùy chỉnh khác */
        .contact-info {
            padding-top: 20px;
        }
 
 </style>
<body>
    <div class="container">
        <div class="header">
        <header> 
            <div class="header-top">
               <div class="logo">
                <img src="../style/img/logo.webp" alt="">
               </div> 
            </div>
            <div class="search">
                <form action="" method="post">
                <input class="search-mini-form" type="text" placeholder="Tìm kiếm tại đây...">
                <input class="btn-search" type="submit" value="Tìm kiếm" name="" >
            </form>
            </div>

            <div class="form">
                
                <div class="register-login">
                    <ul>
                        <li><a href="">Đăng ký</a></li>
                        <li>/</li>
                        <li><a href="">Đăng nhập</a></li>
                    </ul>
                </div>
                
                <div class="cart">
                    <a href="">
                    <img src="../style/img/cart.webp" alt="">
                </a>
            </div>    
            </div>
      
        </header>

   
              
        <div class="nav">
        <nav>
            <div class="menu">
                <ul>
                    <li><a style="background: #32aad6 ; " href="../index.php">Trang chủ</a></li>
                    <li><a href="./introduce.php">Giới thiệu</a></li>
                    <li><a href="./tour.php">Tour du lịch</a></li>
                    <li><a href="./news.php">Tin tức</a></li>
                    <li><a href="./contact.php">Liên hệ</a></li>
                </ul>
            </div>
           
        </nav>
    </div>
</div>  


<div class="introduce">
        <a href="../index.php">Trang chủ</a>> <b>Liên hệ</b>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Thông tin liên hệ</h3>
                <p><strong>Số điện thoại:</strong> 0123 456 789</p>
                <p><strong>Email:</strong> example@gmail.com</p>
                <h3>Nội dung liên hệ</h3>
                <p>Bạn có thể nhập nội dung liên hệ ở đây...</p>
            </div>
            <div class="col-md-6">
                <h3>Bản đồ</h3>
                <div class="map-container">
                    <!-- Thay đổi src của iframe để giảm kích thước map -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.8018884494327!2d108.16737297396932!3d16.075767084604717!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314218e6e72e66f5%3A0x46619a0e2d55370a!2zMTM3IE5ndXnhu4VuIFRo4buLIFRo4bqtcCwgVGhhbmggS2jDqiBUw6J5LCBMacOqbiBDaGnhu4N1LCDEkMOgIE7hurVuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1700896854305!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>

    
    <div class="footer mt">
    <footer>
        <p>Dự án 1 2023: Nhóm Ctrl C + Ctrl V</p>
    </footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>