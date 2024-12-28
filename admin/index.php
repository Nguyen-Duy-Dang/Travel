<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tour</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #sidebar {
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            position: fixed;
            width: 250px;
            overflow-y: auto;
        }

        #iframe-container {
            margin-left: 250px;
            padding: 20px;
        }

        .nav-item:hover{
            background-color: lightgrey;
            border-radius: 10px;
        }

        .nav-link {
            font-size: 18px;
            color: #fff;
        }

        .nav-link:hover {
            color: #000;
        }

        iframe {
            width: 100%;
            height: calc(100vh - 40px);
            border: none;
        }
    </style>
</head>

<body>

    <div id="sidebar">
        <h2>Dashboard Admin</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="loadContent('manage_tours.php')">Quản Lý Tour</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="loadContent('manage_orders.php')">Quản Lý Đặt Tour</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="loadContent('manage_comments.php')">Quản Lý Bình Luận</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="loadContent('manage_users.php')">Quản Lý Khách Hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="loadContent('manage_hotel.php')">Quản Lý Khách Sạn</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="loadContent('manage_news.php')">Quản Lý Tin Tức</a>
            </li>
            <!-- Các mục menu khác -->
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="loadContent('thongke.php')">Thống kê</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout_admin.php" onclick="loadContent('logout_admin.php')">Đăng Xuất</a>
            </li>
        </ul>
    </div>

    <div id="iframe-container">
        <!-- Nội dung chức năng sẽ được tải ở đây -->
        <iframe id="content-frame" src="thongke.php"></iframe>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Hàm tải nội dung bằng AJAX và đặt nó vào thẻ iframe
        function loadContent(page) {
            $('#content-frame').attr('src', page);
        }
    </script>

</body>

</html>