<?php
// Kết nối CSDL
$pdo = new PDO('mysql:host=127.0.0.1;dbname=duan1', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Truy vấn SQL để lấy số lượng đặt tour cho mỗi tour
$query = "

    SELECT t.ten_tour, COUNT(dt.id_dattuor) AS so_luong_dat_tour
    FROM dattour dt
    LEFT JOIN tour t ON dt.id_tour = t.id_tour
    GROUP BY dt.id_tour

";

$statement = $pdo->prepare($query);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

// Dữ liệu cho biểu đồ hình tròn
$data = [];
foreach ($results as $row) {
    $data[] = [
        'label' => $row['ten_tour'],
        'value' => (int)$row['so_luong_dat_tour']
    ];
}

// Chuyển dữ liệu sang JSON
$dataJSON = json_encode($data);
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <title>My Web Page</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
    }

    #piechart {
      width: 1000px;
      height: 700px;
      margin: 20px auto;
    }
  </style>
</head>
<body>

<h1>Thống Kê</h1>

<div id="piechart"></div>

<script type="text/javascript">
  // Load google charts
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  // Draw the chart and set the chart values
  function drawChart() {
    var tourData = <?php echo $dataJSON; ?>;

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Tour');
    data.addColumn('number', 'Số lượng đặt tour');
    tourData.forEach(function(item) {
        data.addRow([item.label, item.value]);
    });

    var options = {
        'title': 'Số lượng đặt tour cho mỗi tour'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
</script>

</body>
</html>
