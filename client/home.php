
<?php session_start()  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu Về VinFast | VinFast</title>
    <?php include('home_css.php'); ?>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="home-banner">
        <div class="slider">
            <div class="slides">
                <div class="slide">
                    <img src="https://static-cms-prod.vinfastauto.com/VF5-banner-3060x1406-min_1720268924.png" alt="VinFast Banner" width="100%">
                </div>
                <div class="slide">
                    <img src="https://static-cms-prod.vinfastauto.com/3060x1406-min_1719894616.jpg" alt="VinFast Banner" width="100%">
                </div>
            </div>
            <div class="nav banner-nav">
                <button class="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                <button class="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="title_introduction">
            <span>Giới thiệu về</span>
            <h1>Công ty VinFast</h1><br>
            <p>VinFast là công ty thành viên thuộc tập đoàn Vingroup, một trong những Tập đoàn Kinh tế tư nhân đa ngành lớn nhất<br> Châu Á.
            <br><br> Với triết lý “Đặt khách hàng làm trọng tâm”, VinFast không ngừng sáng tạo để tạo ra các sản phẩm đẳng cấp và trải nghiệm xuất sắc cho mọi người.</p>
        </div>
        <div class="background_car">
            <img src="../img/VF9NeptuneGray.jpg" alt="VF9" width="758px">
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script src="../js/slick.js"></script>
</body>
</html>
