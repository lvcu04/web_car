<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $identity = $_POST['identity'];
    $email = $_POST['email'];
    $place = $_POST['place'];
    $showroom = $_POST['showroom'];

    // Lưu vào session hoặc cơ sở dữ liệu
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = [
        'name' => $name,
        'phone' => $phone,
        'identity' => $identity,
        'email' => $email,
        'place' => $place,
        'showroom' => $showroom,
    ];
   
}
header("Location:../client/oto.php")
?>