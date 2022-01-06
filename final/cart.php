<?php
	if (empty($_COOKIE["id"]))
    {
      setcookie("id", "guest");	
    }
    else
    {
        $id = $_COOKIE["id"];
    }
    $id = $_COOKIE["id"];

    if (empty($_COOKIE["num_list"]) || empty($_COOKIE["name_list"]) || empty($_COOKIE["price_list"]) || empty($_COOKIE["quantity_list"]))
    {
        setcookie("num_list", "0");
        setcookie("name_list", "0");
        setcookie("price_list", "0");
        setcookie("quantity_list", "0");
      $sum=0;
      $namelen=0;
    }
    else
    {	
        $quantity= $_COOKIE["quantity_list"];
        $num = $_COOKIE["num_list"];
        $name= $_COOKIE["name_list"];
        $price= $_COOKIE["price_list"];	
        if(empty($_COOKIE["num_list"])){
            $namelen=0;
        }
        else{
            $namearray = explode(",",$name);
            $namelen=count($namearray);
        }
       
        $pricearray = array_map('intval', explode(",",$price));
        $numarray=explode(",",$num);	
        $sum=0;
        for($i=0;$i<$namelen;$i++)
        {
            $sum=$sum+$pricearray[$i];
        }
    }

    include("shopcart.inc.php");
    retrieve_shopping_cart();
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_POST['remove_from_shopping_cart'] && $_POST['currentProductID'])
        {
            if($_POST['remove_from_shopping_cart'] == 'X')
            {
                $productId = $_POST['currentProductID'];
                remove_item_from_shopping_cart($productId, 1);
                header("Refresh:0");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOLO商城</title>
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
                <img src="./images/logo.png" alt="logo">
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
                        <a class="nav-link" href="about.php">HOLOLIVE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">HOLO商城</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="job.php">人物介紹</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://schedule.hololive.tv/">直播時間與連結</a>
                    </li>
                </ul>
                <div class="ml-auto">
                    <?php
                            if ($_COOKIE["id"]=="guest")
                            {
                              echo"<a href='login.html' class='btn btn-outline-info text-info my-2 my-sm-0'>登入</a>";	
                            }
                            else
                            {
                                echo"$id 你好";
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
                                    for($i=0;$i<$namelen;$i++)
                                    {
                                        require_once("shopcart.inc.php");
                                        $image_path = retrieve_image_path_from_db($numarray[$i]);
                                        echo"
                                        <tr>
                                            <td class='product-remove' method='post'>
                                                <form method='post' name='remove_from_shopping_cart'>
                                                    <input class='remove text-white' type='submit' data-toggle='tooltip' data-placement='top' name='remove_from_shopping_cart' title='是否確定要移除' value='X'>
                                                    <input type='hidden' name='currentProductID' value='$numarray[$i]'>
                                                </form>
                                            </td>
                                            <td class='product-thumbnail'>
                                                <a href='$numarray[$i].html'>
                                                    <img src='$image_path' alt='$numarray[$i]' class='img-fluid'>
                                                </a>
                                            </td>
                                            <td class='product-name'>
                                                <a href='$numarray[$i].html'>$namearray[$i]</a>
                                            </td>
                                            <td class='product-price'>NT$&nbsp;$pricearray[$i]</td>
                                            <td class='product-quantity'>
                                                <input type='number' value='1'>
                                            </td>
                                            <td class='product-subtotal'>NT$&nbsp;$pricearray[$i]</td>
                                        </tr>
                                        ";
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- 產品清單/end -->
                <!-- 感興趣產品/start -->
                <div class="col-12 col-md-6 d-none d-md-block mb-5">
                    <h2>您可能對此有興趣...</h2>
                    <div class="row">
                        <div class="col-6">
                            <div class="card mb-3">
                                <img class="card-img-top" src="./images/product/eva_1.png" alt="TG-B-0001" class="img-fluid">
                                <div class="card-body">
                                    <h4 class="card-title">Hololive兔田佩克拉 生日套組</h4>
                                    <p class="card-text">附特典</p>
                                    <h5 class="card-text text-danger">NT$&nbsp;5180</h5>
                                    <a href="product.html" class="btn btn-outline-secondary btn-block">查看商品</a>
                                    <a href="cart.php" class="btn btn-outline-primary btn-block">加入購物車</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-3">
                                <img class="card-img-top" src="./images/product/eva_9.png" alt="TG-B-0001" class="img-fluid">
                                <div class="card-body">
                                    <h4 class="card-title">潤羽るしあ 生日紀念套組</h4>
                                    <p class="card-text">附特典</p>
                                    <h5 class="card-text text-danger">NT$&nbsp;4490</h5>
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
                                    <td>NT$&nbsp;<?php echo"$sum" ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">
                                        <a href="checkout.php" class="btn btn-outline-info btn-lg float-right <?php echo(($sum > 0) ? "enabled" : "disabled"); ?>">前往結帳</a>
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
                        <li><a href="shop.php">HOLO商城</a></li>
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