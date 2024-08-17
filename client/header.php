<?php 
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "carshop";

$data = new mysqli($host, $user, $password, $db);

if (isset($_SESSION['email'])) {
    $email = $data->real_escape_string($_SESSION['email']);
    
    $sql = $data->prepare("SELECT name FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();
    
    $name = '';
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
    }
} else {
    // Chuyển hướng người dùng đến trang đăng nhập nếu chưa đăng nhập
    header("Location: login.php");
    exit();
}


$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('home_css.php'); ?>
    <style>
        .notify {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -7px;
            left: 10px;
            background: red;
            color: white;
            border-radius: 50%;
            width: 14px;
            height: 13px;
            font-size: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="navbar">
            <div class="logo">
                <img alt="VinFast - Thương hiệu xe điện đầu tiên Việt Nam"
                    src="https://vinfastauto.com/themes/porto/img/new-home-page/VinFast-logo.svg">
            </div>
            <nav>
                <ul>
                    <li><a href="home.php">Giới thiệu</a></li>
                    <li><a href="oto.php">Ô tô</a></li>
                    <li><a href="#">Dịch vụ hậu mãi</a></li>
                    <li><a href="#">Pin và trạm sạc</a></li>
                </ul>
            </nav>
            <div class="box-car-head">
                
                <span class="account"><i class="fas fa-user"></i><?php echo htmlspecialchars($name); ?></span>
                <ul class="menu-account">
                    <li class="menu-account-item"><a href="#">Thông tin cá nhân</a></li>
                    <li class="menu-account-item"><a href="logout.php">Đăng xuất</a></li>
                </ul>
            </div>
            <div class="notify">
                <i class="fa fa-car" id="cart_car" aria-hidden="true"></i> 
                <span class="cart-count"><?php echo $cart_count; ?></span>
            </div>
        </div>
    </header>
</body>
<script>
    document.getElementById('cart_car').addEventListener('click',function(){
        window.location.href = '../client/cart_car.php';
    });
</script>
</html>