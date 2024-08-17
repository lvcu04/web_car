<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('home_css.php'); ?>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <div class="container_cart">
            <div class="title_cart">
                <h4 class="title_item_cart">Đơn xe đã cọc</h4>
                <hr>
                
            </div>
            <div class="brand">
                <i class="fa fa-car" aria-hidden="true"></i> 
                <span>Vinfast</span>
                <div class="group_infor">
                    <span>Đơn giá</span>
                    <span>Số lượng</span>
                    <span>Số tiền</span>
                </div>
                
            </div>
            <div class="content_car">
                <div class="content_car_img"><img src="../img/vf-3.jpg" alt="vf3"></div>
                <div class="content_car_name"><span>VF3</span></div>
                <div class="content_car_color"><span>Màu:vàng</span></div>
                <div class="content_car_price"><b><sup>đ</sup>240.000.000</b></div>
                <div class="content_car_number"><span>1</span></div>
                <div class="content_car_deposit"><b><sup>đ</sup>15.000.000</b></div>
            </div>
            
        </div>
       
    </div>
    <?php include('../client/footer.php') ?>
</body>
</html>