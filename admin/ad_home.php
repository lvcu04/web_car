<?php 
$host = "localhost";
$user = "root";
$password = "";
$db = "carshop";

$data = new mysqli($host, $user, $password, $db);

$sql = "SELECT users.*, product.*, transactions.*
        FROM transactions
        INNER JOIN users ON transactions.customer_id = users.id 
        INNER JOIN product ON transactions.product_id = product.product_id";

$result = mysqli_query($data, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <?php include('../admin/ad_home_css.php')?>
    <style>
        .title {
            font-size: 20px;
            font-weight: 700;
        }
        .account {
            font-size: 20px;
            font-weight: 700;
            position: relative;
            display: flex;
            align-items: center; 
        }
        .menu-account {
            display: none;
            position: absolute;
            top: 100%; 
            right: 0; 
            background-color: #ffffff; 
            border: 1px solid #ddd; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            z-index: 1000; 
            padding: 10px;
            list-style: none;
            margin: 0;
            width: max-content; 
            
        }
        .menu-account-item {
            margin: 5px 0;
        }
        .menu-account-item a {
            text-decoration: none;
            color: #000; 
            font-size: 15px;
            font-weight: 400;
        }
        .account:hover .menu-account {
            display: block;
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between">
        <a class="navbar-brand" href="#">
            <img src="https://vinfastauto.com/themes/porto/img/new-home-page/VinFast-logo.svg" alt="VinFast - Thương hiệu xe điện đầu tiên Việt Nam" width="150" height="auto">
        </a>
        <div class="title">Hệ thống quản lý VinFast</div>
        <div class="account">
            <i class="fas fa-user-circle"></i>ADMIN
            <ul class="menu-account">
                <li class="menu-account-item"><a href="../client/logout.php">Đăng xuất</a></li>
            </ul>
        </div>
    </nav>
    <br>
    
    <div class="container-fluid">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#a">Danh sách xe đã cọc</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#b">Thông tin xe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#c">Giao dịch</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="a" class="container tab-pane active">
               <div class="row my-1 py-2 mx-1 px-3" id="show_table">
                 <div class="col">
        <table class="table table-bordered custom-border">
            <thead>
                <tr>
                    <th>Họ và tên</th>
                    <th>Số điện thoại</th>
                    <th>Nơi sinh</th>
                    <th>Tên xe</th>
                    <th>Màu</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($info = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $info['name']; ?></td>
                        <td><?php echo $info['phone']; ?></td>
                        <td><?php echo $info['pob']; ?></td>
                        <td><?php echo $info['product_name']; ?></td>
                        <td><?php echo $info['color']; ?></td>
                        <td><?php echo $info['sale_price']; ?></td>
                        <td><?php echo $info['deposit']; ?></td>
                        <td><?php echo "<button class='btn btn-danger'><a href='delete.php?student_code={$info['code']}' class='text-white'>Delete</a></button>"; ?></td>
                        <td><?php echo "<button class='btn btn-info'><a href='update.php?student_code={$info['code']}' class='text-white'>Update</a></button>"; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
                 </div>
            </div>
            </div>
            <div id="b" class="container tab-pane fade">
                <h1>hi</h1>
            </div>
            <div id="c" class="container tab-pane fade">
                <h1>chao</h1>
            </div>
        </div>
    </div>
    
</body>
</html>
