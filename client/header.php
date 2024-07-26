<?php 
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "carshop";

$data = new mysqli($host, $user, $password, $db);

if ($data->connect_error) {
    die("Connection failed: " . $data->connect_error);
}

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$email = $data->real_escape_string($email);

$sql = $data->prepare("SELECT name FROM users WHERE email = ?");
$sql->bind_param("s", $email);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = htmlspecialchars($row['name']);
} else {
    $username = "Tài khoản";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('home_css.php'); ?>
</head>
<body>
<header class="header">
        <div class="navbar">
            <div class="logo">
                <img alt="VinFast - Thương hiệu xe điện đầu tiên Việt Nam" src="https://vinfastauto.com/themes/porto/img/new-home-page/VinFast-logo.svg">
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
                
            <?php if ($username != "Tài khoản") { ?>
            <span class="account"><i class="fas fa-user"></i><?php echo htmlspecialchars($username); ?></span>
            <ul class="menu-account">
                <li class="menu-account-item"><a href="#">Thông tin cá nhân</a></li>
                <li class="menu-account-item"><a href="logout.php">Đăng xuất</a></li>
            </ul>
        <?php } else { ?>
            <a class="account" href="login.php"><i class="fas fa-user"></i><?php echo htmlspecialchars($username); ?></a>
        <?php } ?>

                
                <div class="register-drive"><button><a href="#">Đăng ký lái thử</a></button></div>
                <div class="main-menu"><i class="fa fa-bars" aria-hidden="true"></i></div>
            </div>
        </div>
    </header>
</body>
</html>