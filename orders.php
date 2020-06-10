<?php include './apps/config.php';  ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<form method="post">
    <div class="main-shopping">
        <p class="cart_info"><?php if($_SESSION['cart'] != NULL) {echo "Thông tin chi tiết giỏ hàng!";} else{echo"Hiện tại bạn chưa có sản phẩm nào!";} ?></p>
        <?php
        //echo $_SESSION['username'];
        $khachhang = mysqli_query($conn,"SELECT * FROM user WHERE username ='".$_SESSION['username']."'");
        $items = mysqli_fetch_array($khachhang);
        if (!$khachhang) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }
        ?>
        <?php
        if(isset($_POST['btDathang']) && isset($_SESSION['username']) && isset($_SESSION['cart']) )
        {

            $hoten=$items['fullname'];
            $sum_all = 0;
            $sum_sp = 0;
            $now = getdate();
            $currentDate =$now["year"] . "-" . $now["mon"] . "-" . $now["mday"] ;
            if($_SESSION['cart'] != NULL)
            {
                foreach($_SESSION['cart'] as $id =>$prd)
                {
                    $arr_id[] = $id;
                }
                $str_id = implode(',',$arr_id);
                $item_query = mysqli_query($conn,"SELECT * FROM  giaodich WHERE id_product IN ($str_id) ORDER BY id_product ASC");
                // $item_result = mysqli_query($conn,$item_query) or die ('Cannot select table!');
                while ($rows = mysqli_fetch_array($item_query))
                {
                    $insert = mysqli_query($conn,"INSERT INTO don_hang (ho_ten,id_product,so_luong,tong_tien,ngay_dat_hang) VALUES (N'".$hoten."',N'".$rows['id_product']."',N'".$_SESSION['cart'][$rows['id_product']]."',N'".$rows['price_product']*$_SESSION['cart'][$rows['id_product']]."',N'".$currentDate."')");

                }
                echo '<span class="sc_infor">Đặt hàng thành công.Nhân viên của chúng tôi sẽ liên lạc với quý khách trong vòng 24h tới!</span><br/><br/><span class="sc_inforr">Thắc mắc xin vui lòng liên hệ:0984114827</span>';
                unset($_SESSION['cart']);
                echo '<span class="sc_inforr">Ấn vào <strong><a href="../index.php" class="day">đây</a></strong> để quay lại trang chủ!</span>';

            }
        }
        ?>
</form>
</div><!--end main shopping-->
<div class="clear10px"></div>
<div class="clear50px"></div>