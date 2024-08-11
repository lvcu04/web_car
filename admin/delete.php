<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db='carshop';


$data = mysqli_connect($host,$user,$password,$db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_GET['transaction_id'])){
    $code = $_GET['transaction_id'];
    
    //bat dau transaction 
    mysqli_begin_transaction($data);
    
    // //xóa bảng location
    // $stmt_locations = mysqli_prepare($data, "DELETE FROM locations WHERE location_id = ?");
    // mysqli_stmt_bind_param($stmt_locations, 'i', $code);
    // $result_locations = mysqli_stmt_execute($stmt_locations);
    // //xóa bảng users
    // $stmt_users = mysqli_prepare($data,"DELETE FROM users WHERE id = ? ");
    // mysqli_stmt_bind_param($stmt_users,'i',$code);
    // $result_users = mysqli_stmt_execute($stmt_users);

    // //xóa bảng product
    // $stmt_product = mysqli_prepare($data,"DELETE FROM product where product_id = ?");
    // mysqli_stmt_bind_param($stmt_product , 'i' , $code);
    // $result_product = mysqli_stmt_execute($stmt_product);
    
    //xóa bảng transactions
    $stmt_transactions = mysqli_prepare($data,"DELETE FROM transactions where transaction_id = ?");
    mysqli_stmt_bind_param($stmt_transactions , 'i' , $code);
    $result_transactions = mysqli_stmt_execute($stmt_transactions);
    
    if( $result_transactions ){
        mysqli_commit($data);
        header("Location:../admin/ad_home.php");
        exit();
    }
    else{
        mysqli_rollback($data);
        echo "Lỗi khi xóa dữ liệu ";
    }
    // Đóng câu lệnh prepared statement
    mysqli_stmt_close($stmt_transactions);
    
}
else{
    echo "Không tìm thấy mã giao dịch phù hợp !";
}

?>