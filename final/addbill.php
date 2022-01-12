<?php
    require_once("dbtools.inc.php");
    include("shopcart.inc.php");
    if (empty($_COOKIE["id"]))
    {
        setcookie("id", "guest");
        setcookie("NickName", "guest");
        $id = "guest";
        $NickName = "guest";
    }
    else
    {
        $id = $_COOKIE["id"];
        $NickName = $_COOKIE["NickName"];
    }
    //取得表單資料
    $account = $_POST["account"];
    $Lname = $_POST["Lname"];
    $Fname = $_POST["Fname"];  
    $phone = $_POST["phone"]; 
    $email = $_POST["email"]; 
    $address = $_POST["address"];
    $price = $_POST["price"];
    $discountPrice = $_POST["discountPrice"];
    include_once("shopcart.inc.php");
    $shoppingCart = retrieve_shopping_cart();

    if ($price-60 <= 0){
        echo "<script type='text/javascript'>";
        echo "alert('您沒有購買物品');";
        echo "history.back();";
        echo "</script>";
    } 

    $usedCouponID = null;
    if (!empty($_POST['usedCouponID'])) {
        $link = create_connection();
        $usedCouponID = $_POST['usedCouponID'];
        $sql = "UPDATE CouponList
                SET Used = 'Yes'
                WHERE Member_ID=$account and Coupon_ID=$usedCouponID;";
        $result = execute_sql($link, "DBS_project", $sql);
    }



    //建立資料連接   
    $link = create_connection();
            
    $sql = "INSERT INTO `Order` (Member_ID, Payment_method, Payment_Date, Deliver_method, Total_price, Discounted_price, Order_status, Last_name, First_name, phone, email, Deliver_address) 
            VALUES ('$account', '匯款', null, ' 郵寄', '$price', '$discountPrice', 0, '$Lname', '$Fname', '$phone','$email','$address');";
    $result = execute_sql($link, "DBS_project", $sql);

    $sql = "SELECT Max(Order_ID) From `Order`;";
    $result = execute_sql($link, "DBS_project", $sql);
    $data = mysqli_fetch_array($result);
    $Order_ID = $data[0];
    mysqli_free_result($result);

    if($shoppingCart != 0){
        for($i=0;$i<sizeof($shoppingCart);$i++) {
            $productId = $shoppingCart[$i][0];
            $Product_amount = $shoppingCart[$i][3];
            $sql = "INSERT INTO `Order_product` (Order_ID, Product_ID, Product_amount)
                    VALUES ('$Order_ID', '$productId', '$Product_amount');";
            $result = execute_sql($link, "DBS_project", $sql);
        }
    }

    clear_shopping_cart();
    

    //關閉資料連接	
    mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>台灣名產商城</title>
    <link rel="shortcut icon" type="image/png" href="./images/logo.png"/>
    <!-- CSS文件載入 -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/color.css">
    <link rel="stylesheet" href="./css/frame.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <!-- js文件載入 -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- header/start -->
    <header class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <a class="navbar-brand" href="index.php">
                <img id="logo1" src="./images/logo.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <?php
                    include_once("web_function.php");
                    create_top_left();
                    ?>
                
                <div class="ml-auto">
                <?php include_once("web_function.php");
                    create_title($id,$NickName);
                
                ?>
                </div>
            </div>
        </nav>
    </header>
    <!-- header/end -->
    <section class="page-content">
        <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-0 col-md-2"></div>
            <div class="col-12 col-md-8">
            <h1 class="text-success"> 訂單已送出
            <p>Thank you! 感謝你的訂購！</p>
            </h1> 
            </div>
            <div class="col-0 col-md-2"></div>
        </div>
    </section>
    <!-- 頁腳/start -->
    <footer class="bg-pekoradark">
        <div class="container pt-3 pb-3">
            <div class="row">
                <!-- 選單連結/start -->
                <div class="col-12 col-md-6 mb-3">
                    <ul class="footer-menu">
                        <li><a href="index.php">首頁</a></li>
                        <li><a href="#">客服中心</a></li>
                        <li><a href="#">常見問題</a></li>
                        <li><a href="#">隱私條款聲明</a></li>
                    </ul>
                </div>
                <!-- 選單連結/end -->
                <!-- 版權所有/start -->
                <div class="col-12 mt-3">
                    <p class="text-white text-center">© Copyright 2021 NTUT </p>
                </div>
                <!-- 版權所有/end -->
            </div>
        </div>
    </footer>
    <!-- 頁腳/end -->
</body>
</html>