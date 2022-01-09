<?php
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
    $shoppingCart = retrieve_shopping_cart();
    $total = array(0);

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ((isset($_POST['remove_from_shopping_cart']) || (isset($_POST['modify_from_shopping_cart']) && isset($_POST['quantity']))) && isset($_POST['currentProductID']))
        {
            $productId = $_POST['currentProductID'];
            if(isset($_POST['remove_from_shopping_cart']))
            {
                remove_item_from_shopping_cart($productId);
            }
            if((isset($_POST['modify_from_shopping_cart']) && isset($_POST['quantity'])))
            {
                if ($_POST['quantity'] == 0)
                {
                    remove_item_from_shopping_cart($productId);
                }
                else
                {
                    $new_quantity = $_POST['quantity'];
                    update_shopping_cart($productId, $new_quantity);
                }
            }
        }

        if(isset($_POST['clear_shopping_cart']))
        {
            clear_shopping_cart();
        }
        header("Refresh:0");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<<<<<<< HEAD
    <title>台灣名產商城</title>
=======
<title>台灣名產商城</title>
>>>>>>> b34a7deccf0b2fb58f0ace0a3edf3952fd7dc671
    <link rel="shortcut icon" type="image/png" href="./images/logo.png"/>
    <!-- CSS文件載入 -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/color.css">
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
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">首頁</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">關於我們</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="shop.php">買名產囉</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.ntut.edu.tw/">實體店面介紹</a>
                    </li>
                    <li class="nav-item">
                        <input name="search_product" type="text" class="form-control" id="search_product" placeholder="搜尋...">
                    </li>
                </ul>

                <div class="ml-auto">
                    <?php
                            if ($id == "guest")
                            {
                              echo"<a href='login.html' class='btn btn-outline-info text-info my-2 my-sm-0'>登入</a>";	
                            }
                            else
                            {
                                echo"<a href='main.php'>$NickName</a> 你好";
                                echo"<a href='logout.php' class='btn btn-outline-danger text-danger my-2 my-sm-0'>登出</a>";
                            }
                    ?>

                    <a href="cart.php" class="btn btn-outline-info text-info my-2 my-sm-0">購物車</a>
                    <a href="checkout.php" class="btn btn-outline-info text-info my-2 my-sm-0">結帳</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- header/end -->
    <!-- 購物車/start -->
    <section class="page-content">
        <div class="container pt-5 pb-5">
            <div class="row">
                <!-- 產品清單/start -->
                <div class="col-12 mb-3">
                    <h2 class="mb-3">購物車</h2>
                    <div class="table-responsive-sm table-middle">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="product-remove">&nbsp;</th>
                                    <th scope="col" class="product-thumbnail">圖片</th>
                                    <th scope="col" class="product-name">名稱</th>
                                    <th scope="col" class="product-price">價格</th>
                                    <th scope="col" class="product-quantity">數量</th>
                                    <th scope="col" class="product-subtotal">總計</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($shoppingCart != 0)
                                    {
                                        for($i=0;$i<sizeof($shoppingCart);$i++)
                                    {
                                        $productId = $shoppingCart[$i][0];
                                        $Product_name = $shoppingCart[$i][1];
                                        $Price = $shoppingCart[$i][2];
                                        $Quantity = $shoppingCart[$i][3];

                                        $image_path = retrieve_image_path_from_db($productId);
                                        $subTotal = $Price * $Quantity;
                                        array_push($total, $subTotal);
                                        echo"
                                        <tr>
                                            <form method='post' name='remove_from_shopping_cart'>
                                                <td class='product-remove'>
                                                    <input class='btn btn-success pull-left' type='submit' data-toggle='tooltip' data-placement='top' name='modify_from_shopping_cart' title='是否確定要改訂單' value='O'>
                                                    <input class='btn btn-danger pull-right' type='submit' data-toggle='tooltip' data-placement='top' name='remove_from_shopping_cart' title='是否確定要移除' value='x'>
                                                    <input type='hidden' name='currentProductID' value='$productId'>
                                                </td>
                                                <td class='product-thumbnail'>
                                                    <a href='product_page.php?currentProductID=$productId'>
                                                        <img src='$image_path' alt='$productId' class='img-fluid'>
                                                    </a>
                                                </td>
                                                <td class='product-name'>
                                                    <a href='product_page.php?currentProductID=$productId'>$Product_name</a>
                                                </td>
                                                <td class='product-price'>NT$&nbsp;$Price</td>
                                                <td class='product-quantity'>
                                                    <input type='number' min='0' name='quantity' value='$Quantity'>
                                                </td>
                                                <td class='product-subtotal'>NT$&nbsp;$subTotal</td>
                                            </form>
                                        </tr>
                                        ";
                                    }
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <form method="post" name="myForm">
                        <input class='btn btn-danger pull-right' style="float: right" type='submit' data-toggle='tooltip' data-placement='top' name='clear_shopping_cart' <?php echo(($shoppingCart != 0) ? "enabled" : "disabled") ?> title='是否確定要清除購物車' value='清除購物車'>
                    </form>
                </div>
                <!-- 產品清單/end -->
                <!-- 感興趣產品/start -->
                <div class="col-12 col-md-6 d-none d-md-block mb-5">
                    <h2>您可能對此有興趣...</h2>
                    <div class="row">
                        <div class="col-6">
                            <div class="card mb-3">
                                <img class="card-img-top" src="./images/tea_drink_images/4.jpg" alt="TG-B-0001" class="img-fluid">
                                <div class="card-body">
                                    <h4 class="card-title">小茶栽堂 - 紅雙禮盒</h4>
                                    <p class="card-text">紅雙禮盒(古典罐2入-黑烏龍茶X古早味紅茶)</p>
                                    <h5 class="card-text text-danger">NT$&nbsp;1300</h5>
                                    <a href="product.html" class="btn btn-outline-secondary btn-block">查看商品</a>
                                    <a href="cart.php" class="btn btn-outline-primary btn-block">加入購物車</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-3">
                                <img class="card-img-top" src="./images/food_dessert_images/11.jpg" alt="TG-B-0001" class="img-fluid">
                                <div class="card-body">
                                    <h4 class="card-title">老媽拌麵 - 蔥油開洋拌麵</h4>
                                    <p class="card-text">蔥油開洋拌麵(一袋4包)</p>
                                    <h5 class="card-text text-danger">NT$&nbsp;987</h5>
                                    <a href="product.html" class="btn btn-outline-secondary btn-block">查看商品</a>
                                    <a href="cart.php" class="btn btn-outline-primary btn-block">加入購物車</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 感興趣產品/end -->
                <!-- 產品統計/start -->
                <div class="col-12 col-md-6 mb-5">
                    <h2>購物車總計</h2>
                    <div class="table-responsive-sm">
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="bg-info">
                                    <td>總計</td>
                                    <td>NT$&nbsp;<?php echo (array_sum($total)) ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">
                                        <?php
                                            include_once("function.php");
                                            $data = chooseCoupon($id); 
                                        ?>
                                        <!-- <a href="checkout.php" class="btn btn-outline-info btn-lg float-right">前往結帳</a> -->
                                    </td>
                                </tr>
                                <tr>
                                    <form method="post" name="myForm" action="clear.php">                                        
                                        <input class="btn btn-outline-primary btn-block mt-2" type='submit' value='一鍵清空'>
                                    </form>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- 產品統計/end -->
            </div>
        </div>
    </section>
    <!-- 購物車/end -->
    <!-- 頁腳/start -->
    <footer class="bg-pekoradark">
        <div class="container pt-3 pb-3">
            <div class="row">
                <!-- 選單連結/start -->
                <div class="col-12 col-md-6 mb-3">
                    <ul class="footer-menu">
                        <li><a href="index.php">首頁</a></li>
                        <li><a href="about.php">HOLOLIVE</a></li>
                        <li><a href="shop.php">台灣名產商城</a></li>
                        <li><a href="job.php">成員簡介</a></li>
                        <li><a href="https://schedule.hololive.tv/">直播時間</a></li>
                        <li><a href="login.html">登入</a></li>
                        <li><a href="cart.php">購物車</a></li>
                        <li><a href="checkout.php">結帳</a></li>
                    </ul>
                </div>
                <!-- 選單連結/end -->
                <!-- 訂閱/start -->
                <div class="col-12 col-md-6 mb-3">
                    <h6 class="text-white">留下 E-mail，訂閱hololive，可搶先獲得最新的資訊喔！</h6>
                    <form action="addemail.php" method="post" name="myForm">
                        <input name="email" type="email" class="form-control mt-2 mb-2" placeholder="請輸入e-mail">
                        <button type="submit" class="btn btn-primary float-right send-btn">傳送</button>
                    </form>
                </div>
                <!-- 訂閱/end -->
                <!-- 版權所有/start -->
                <div class="col-12 mt-3">
                    <p class="text-white text-center">© Copyright 2021 hololive</p>
                </div>
                <!-- 版權所有/end -->
            </div>
        </div>
    </footer>
    <!-- 頁腳/end -->
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({trigger: "click"});
        })
    </script>
</body>
</html>