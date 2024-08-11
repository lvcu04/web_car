<?php 


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
<<<<<<< HEAD
                <span class="account"><i class="fas fa-user"></i><?php echo htmlspecialchars($name); ?></span>
=======

                <?php if ($username != "Tài khoản") { ?>
                <span class="account"><i class="fas fa-user"></i><?php echo htmlspecialchars($username); ?></span>
>>>>>>> e6d015700399f50c37851aac9b16a853f79dde7e
                <ul class="menu-account">
                    <li class="menu-account-item"><a href="#">Thông tin cá nhân</a></li>
                    <li class="menu-account-item"><a href="logout.php">Đăng xuất</a></li>
                </ul>
<<<<<<< HEAD
                <div class="register-drive"><button><a href="#">Đăng ký lái thử</a></button></div>
                <div class="main-menu"><i class="fa fa-bars" aria-hidden="true"></i></div>
=======
                <?php } else { ?>
                <a class="account" href="login.php"><i
                        class="fas fa-user"></i><?php echo htmlspecialchars($username); ?></a>
                <?php } ?>


>>>>>>> e6d015700399f50c37851aac9b16a853f79dde7e
            </div>
        </div>
    </header>
</body>

</html>