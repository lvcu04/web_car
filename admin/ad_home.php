<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location:../client/login.php");
}
elseif($_SESSION['usertype'] == 'user'){
    header("Location:../client/login.php");
}
$host = "localhost";
$user = "root";
$password = "";
$db = "carshop";

$data = new mysqli($host, $user, $password, $db);
//sql giao dịch
$sql_transactions= "SELECT users.*, product.*, transactions.*,
        FORMAT(product.product_price,0) as product_price,
        FORMAT(transactions.deposit,0) as deposit
        FROM transactions
        INNER JOIN users ON transactions.customer_id = users.id 
        INNER JOIN product ON transactions.product_id = product.product_id";
//sql sản phẩm
$sql_product = "SELECT * FROM product";


$result_transactions= mysqli_query($data, $sql_transactions);
$result_product=mysqli_query($data,$sql_product);
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
        button a:hover{ text-decoration: none;}
        .modal {
            z-index: 1050;
        }
        .modal-dialog {
            max-width: 100%;
            margin: 1.5rem auto; /* Khoảng cách từ đỉnh màn hình đến modal */
            top: 5%;
        }
        .modal-content {
        width: 100%;
        height: 510px;
        }
        .modal-footer {
            align-items: flex-end!important;
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
                <a class="nav-link active" data-toggle="tab" href="#a">Danh sách xe hiện có</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#b">Thông tin xe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#c">Giao dịch</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="a" class="container-fluid tab-pane active">
            
            </div>
            <div id="b" class="container tab-pane fade">
            <div class="row  py-4 ">
                    <div class="col">
                        <table class="table table-bordered custom-border">
                            <thead>
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Màu</th>
                                    <th>Kích thước</th>
                                    <th>Dung lượng pin</th>
                                    <th>Loại bánh xe</th>
                                    <th>Năng lượng tiêu thụ</th>
                                    <th>Số lượng ghế</th>
                                    <th>Thời gian sạc nhanh</th>
                                    <th>Túi khí</th>
                                    <th>Số lượng sản phẩm</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($info_product = $result_product->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $info_product['product_id']; ?></td>
                                        <td><?php echo $info_product['product_name']; ?></td>
                                        <td><?php echo $info_product['color']; ?></td>
                                        <td><?php echo $info_product['dimensions']; ?></td>
                                        <td><?php echo $info_product['battery_capacity']; ?></td>
                                        <td><?php echo $info_product['wheel_type']; ?></td>
                                        <td><?php echo $info_product['fuel_consumption']; ?></td>
                                        <td><?php echo $info_product['seat_count']; ?></td>
                                        <td><?php echo $info_product['fast_charge_time']; ?></td>
                                        <td><?php echo $info_product['airbags']; ?></td>
                                        <td><?php echo $info_product['product_number']; ?></td>
                                        <td><?php echo $info_product['status']; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr ><td colspan="11" style="text-align: center;"><?php echo "<button class='btn btn-success'><a href='#' class='text-white'>Thêm loại xe</a></button>"; ?></td></tr>
                            </tbody>
                        </table>
                    </div>
            </div>
            </div>
            <div id="c" class="container-fluid tab-pane fade">
            <div class="row  py-4 ">
                    <div class="col">
                        <table class="table table-bordered custom-border">
                            <thead>
                                <tr>
                                    <th>Mã giao dịch</th>
                                    <th>Họ và tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Nơi sinh</th>
                                    <th>Tên xe</th>
                                    <th>Màu</th>
                                    <th>Giá</th>
                                    <th>Tiền cọc</th>
                                    <th>Số lượng mua</th>
                                    <th>Xóa</th>
                                    <th>Cập nhật</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($info_transactions = $result_transactions->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $info_transactions['transaction_id']; ?></td>
                                        <td><?php echo $info_transactions['name']; ?></td>
                                        <td><?php echo $info_transactions['phone']; ?></td>
                                        <td><?php echo $info_transactions['pob']; ?></td>
                                        <td><?php echo $info_transactions['product_name']; ?></td>
                                        <td><?php echo $info_transactions['color']; ?></td>
                                        <td><?php echo $info_transactions['product_price']; ?></td>
                                        <td><?php echo $info_transactions['deposit']; ?></td>
                                        <td><?php echo $info_transactions['transaction_number']; ?></td>
                                        <td><?php echo "<button class='btn btn-danger'><a href='../admin/delete.php?transaction_id={$info_transactions['transaction_id']}' class='text-white'>Xóa</a></button>"; ?></td>
                                        <td><?php echo "<button class='btn btn-info' data-toggle='modal' data-target='#myModal' 
                                            data-id='{$info_transactions['transaction_id']}' 
                                            data-name='{$info_transactions['name']}' 
                                            data-phone='{$info_transactions['phone']}'
                                            data-pob='{$info_transactions['pob']}'
                                            data-product_name='{$info_transactions['product_name']}'
                                            data-color='{$info_transactions['color']}'
                                            data-price='{$info_transactions['product_price']}'
                                            data-deposit='{$info_transactions['deposit']}'
                                            data-number='{$info_transactions['transaction_number']}'>
                                            Cập nhật</button>"; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr ><td colspan="11" style="text-align: center;"><?php echo "<button class='btn btn-success' data-toggle='modal' data-target='#myModal'><a href='#' class='text-white'>Thêm giao dịch</a></button>"; ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- The Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cập nhật giao dịch</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="updateForm" action="../admin/update.php" method="POST">
            <input type="hidden" id="transaction_id" name="transaction_id">
            <table class="table table-bordered">
              <tr>
                <td><label for="name" class="form-label">Họ và tên</label></td>
                <td><input type="text" class="form-control" id="name" name="name"></td>
                <td><label for="phone" class="form-label">Số điện thoại</label></td>
                <td><input type="text" class="form-control" id="phone" name="phone"></td>
              </tr>
               
               <tr>
                <td><label for="pob" class="form-label">Nơi sinh</label></td>
                <td><input type="text" class="form-control" id="pob" name="pob"></td>
                <td><label for="phone" class="form-label">Tên xe</label></td>
                <td><input type="text" class="form-control" id="product_name" name="product_name"></td>
              </tr>

              <tr>
                <td><label for="phone" class="form-label">Màu</label></td>
                <td><input type="text" class="form-control" id="color" name="color"></td>
                <td><label for="phone" class="form-label">Giá</label></td>
                <td><input type="text" class="form-control" id="price" name="price"></td>
              </tr>

              <tr>
                <td><label for="phone" class="form-label">Tiền cọc</label></td>
                <td><input type="text" class="form-control" id="deposit" name="deposit"></td>
                <td><label for="phone" class="form-label">Số lượng mua</label></td>
                <td><input type="text" class="form-control" id="number" name="number"></td>
              </tr>
            </table>
            <div class="mt-3">
              <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>


<script>
    document.addEventListener('DOMContentLoaded', function(){
        //on = addEventListener()
        $('#myModal').on('show.bs.modal',function(event){
            var button = $(event.relatedTarget);
            //data = getAttribute()
            var transactionId = button.data('id');
            var name = button.data('name');
            var phone = button.data('phone');
            var pob = button.data('pob');
            var productName = button.data('product_name');
            var color = button.data('color');
            var price = button.data('price');
            var deposit = button.data('deposit');
            var number = button.data('number');
            //modal push inputs
            var modal = $(this);
            //find = querySelector();
            modal.find('#transaction_id').val(transactionId);
            modal.find('#name').val(name);
            modal.find('#phone').val(phone);
            modal.find('#pob').val(pob);
            modal.find('#product_name').val(productName);
            modal.find('#color').val(color);
            modal.find('#price').val(price);
            modal.find('#deposit').val(deposit);
            modal.find('#number').val(number);
        });
    }); 
</script>

</body>
</html>
