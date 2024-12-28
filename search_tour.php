<style>
    body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .tour-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .tour-row {
            display: flex;
            justify-content: space-around;
            width: 100%;
            margin-bottom: 20px;
        }

        .tour {
            width: calc(30% - 20px);
            box-sizing: border-box;
            background-color: white;
            margin-bottom: 20px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            position: relative;
            text-align: center;
        }

        .tour:hover {
            transform: scale(1.05);
        }

        .tour img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 10px;
        }

        .tour-details {
            margin-top: 20px;
            font-size: 16px;
        }

        .tour-description {
            margin-top: 20px;
            font-size: 14px;
            line-height: 1.5;
        }

        .tour-price {
            font-size: 22px;
            font-weight: bold;
            color: #4caf50;
        }

        .book-button {
            background-color: #45a0b9;
            color: white;
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
            background-color: #4caf50;
        }

        .cart-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: #4caf50;
            cursor: pointer;
        }

        /* Thêm phần chi tiết tour */
        .tour-details {
            margin-top: 10px;
            font-size: 14px;
        }

        .tour-details span {
            display: block;
            margin-bottom: 5px;
        }

        .tour-description {
            margin-top: 10px;
        }
        .image-container {
            position: relative;
            display: inline-block;
        }

        .tour-details-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            padding: 10px 20px;
            border: none;



            border-radius: 5px;
            background-color: #4caf50;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .tour-details-button:hover {
            background-color: #45a0b9; /* Màu xanh dương khi hover */
        }

        .image-container:hover .tour-details-button {
            opacity: 1;
        }

        .book-button {
            background-color: #45a0b9; /* Thay đổi màu xanh dương cho nút "Đặt Tour" */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            display: block;
            transition: background-color 0.3s ease-in-out;
            width: 100%;
        }

        .book-button:hover {
            background-color: #4caf50; /* Màu xanh lá cây khi hover */
        }
        .tour img {
    width: 100%; /* Fill the container horizontally */
    height: 200px; /* Set a fixed height for all images */
    border-radius: 8px;
    margin-top: 10px;
    object-fit: cover; /* Maintain aspect ratio and cover container */
}
.news .flex-container {
    display: flex;
    flex-wrap: wrap;
}

.news .news-item {
    flex: 0 0 calc(33.33% - 20px); /* Độ rộng của mỗi tin tức (33.33% - khoảng cách) */
    margin: 10px; /* Khoảng cách giữa các tin tức */
    border: 1px solid #ccc; /* Đường viền cho từng tin tức */
    padding: 15px;
    box-sizing: border-box;
    text-align: center; /* Căn giữa nội dung */
    overflow: hidden; /* Ẩn phần tử vượt quá kích thước */
}

.news .news-item img {
    max-width: 100%; /* Tối đa chiều rộng là 100% của phần tử cha */
    max-height: 200px; /* Tối đa chiều cao là 200px, thay đổi theo nhu cầu */
    width: auto;
    height: auto;
    margin-bottom: 10px; /* Khoảng cách giữa hình ảnh và nội dung */
}


</style>


<?php
include "./header.php";


// if(is_array($listsanpham)){
//    var_dump($listsanpham);
//    }
include "./config/pdo.php";
                 if(isset($_POST['search_name'])){
                    $nd_timkiem=$_POST['nd_name'];
                   $sql=" SELECT * FROM tour
                    WHERE ten_tour LIKE '".$nd_timkiem."%'";
              
                         $listsanpham = pdo_query($sql);
                       
                  }
                  
?>

<body>
    <h2>Danh sách Tour</h2>
    <div class="tour-container">
    <div class="tour-row">
        <?php

if(is_array($listsanpham)){
    foreach ($listsanpham as $listsp) {
        $img_path="uploads";
        extract($listsp);
        $img="$img_path/$url_hinh";
           $tr= '<div class="tour"><img src="'.$img.'"
alt="Tour Hạ Long long" title="Mô tả về Tour Hạ Long"><strong>'.$ten_tour.'</strong>
           <br>Địa điểm: '.$dia_diem.'<br>Ngày khởi hành: '.$ngay_khoi_hanh.'<br>Ngày kết thúc: '.$ngay_ket_thuc.'<br>
           <div class="tour-details">Giá: <span class="tour-price">'. number_format($gia_tour, 2, '.', ',') . ' VND</span><br>
           <button class="book-button" onclick="bookTour(null)">Đặt Tour</button></div></div>
           '; echo $tr;
       
    }
        
                     
}
            
        
        ?>

     
    </div>
    </div>
</body>
<?php
include "./footer.php";
?>