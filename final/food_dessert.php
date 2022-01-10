<?php
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

    include_once("shopcart.inc.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {  
            if (isset($_POST['add_shopping_cart']) && isset($_POST['currentProductID']))
            {
                if($_POST['add_shopping_cart'] == '加入購物車')
                {
                    $productId = $_POST['currentProductID'];
                    add_shopping_cart($productId, 1);
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
<title>台灣名產商城</title>
    <link rel="shortcut icon" type="image/png" href="./images/logo.png" />
    <!-- CSS文件載入 -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/color.css">
    <link rel="stylesheet" href="./css/product.css">
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
    <!-- 產品商城/start -->
    <section class="page-content">
        <div class="container pt-5 pb-5">
            <div class="row">
                <!-- 商品區/start -->
                <div class="col-12 col-md-9">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <img src="./images/food_dessert.jpg" alt="Shop Banner" class="img-fluid">
                        </div>
                        <!-- 排序/start -->
                        <div class="col-12 mt-3 mb-3">
                        <?php include_once("function.php");
                                if (isset($_GET["page"])){
                                    $page = $_GET["page"];
                                }else{
                                    $page = 1;
                                }
                                if (isset($_GET["sortBy"])){
                                    $sortBy = $_GET["sortBy"];
                                    setcookie("sortBy", $sortBy);
                                }else{
                                    $sortBy = "DateASC";
                                }
                                echo('<p class="d-inline-block">');
                                getNumberOfProduct($page, 'all');
                                echo('</p>'); ?>
                            <form action="" class="d-inline-block float-right">
                                <?php
                                    if($page==1){
                                        dropDownSelect($sortBy);
                                    }else{
                                        dropDownSelect($_COOKIE["sortBy"]);
                                    }
                                ?>
                            </form>
                            <hr>
                        </div>  
                        <script>
                            window.onload=initForm;
                            function initForm(){
                                var osel=document.getElementById("ProductSelect");
                                // osel.selectedIndex=0;
                                osel.onchange=jumpPage;
                            }
                            function jumpPage(){
                                var osel=document.getElementById("ProductSelect");
                                var newURL=osel.options [osel.selectedIndex].value;
                                if(newURL!=""){
                                    window.location.href=newURL;
                                }
                            }
                        </script>
                        <!-- 排序/end -->
                        <!-- 商品/start -->
                        <?php
                        include_once("function.php");
                        getSortedProduct($sortBy, $page, 'food_dessert')
                        
                        ?>                
                        <!-- 商品/end -->
                        <!-- 分頁/start -->
                        <?php getPageLink($page, 'food_dessert'); ?>
                        <!-- 分頁/end -->
                    </div>
                </div>
                <!-- 商品區/end -->
                <!-- 側邊欄/start -->
                <div class="col-12 col-md-3">
                    <div class="row">
                        <!-- 產品分類/start -->
                        <div class="col-12 mb-5 ml-5">
                            <h4 class="title-color">產品分類</h4>
                            <div class="card-deck mt-2 product-categories" style="overflow-y: auto; overflow-x: hidden">
                                <div class="row">
                                    <a href="food_dessert.php" class="card">
                                        <img class="card-img-top" src="./images/product_class/3.jpg" alt="食物">
                                        <div class="card-body bg-dark card-title text-white text-center">
                                            <h5>食品/</h5>
                                            <h5>點心類</h5>
                                        </div>
                                    </a>
                                    <a href="tea_drink.php" class="card">
                                        <img class="card-img-top" src="./images/product_class/2.jpg" alt="飲料">
                                        <div class="card-body bg-dark card-title text-white text-center">
                                            <h5>茶葉/</h5>
                                            <h5>飲品類</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="row">
                                    <a href="acc.php" class="card">
                                        <img class="card-img-top" src="./images/product_class/4.jpg" alt="裝飾">
                                        <div class="card-body bg-dark card-title text-white text-center">
                                            <h5>裝飾/</h5>
                                            <h5>飾品類</h5>
                                        </div>
                                    </a>
                                    <a href="fruit.php" class="card">
                                        <img class="card-img-top" src="./images/product_class/1.jpg" alt="水果">
                                        <div class="card-body bg-dark card-title text-white text-center">
                                            <h5>水果類</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- 產品分類/end -->
                    </div>
                </div>
                <!-- 側邊欄/end -->
            </div>
        </div>
    </section>
    <!-- 產品商城/end -->
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
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({trigger: "click"});
        })
    </script>
</body>
</html>