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
        $sum=0;
        for($i=0;$i<$namelen;$i++)
        {
            $sum=$sum+$pricearray[$i];
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
                                echo"$NickName 你好";
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
                            <img src="./images/acc.jpg" alt="Shop Banner" class="img-fluid">
                        </div>
                        <!-- 排序/start -->
                        <div class="col-12 mt-3 mb-3">
                            <p class="d-inline-block">搜尋結果:13筆</p>
                            <form action="" class="d-inline-block float-right">
                                <select id="ProductSelect" class="form-control">
                                    <option>依上架時間</option>
                                    <option>依熱銷度</option>
                                    <option>依價格排序:低至高</option>
                                    <option>依價格排序:高至低</option>
                                </select>
                            </form>
                        </div>
                        <!-- 排序/end -->
                        <!-- 商品/start -->
                        <?php
                        include_once("function.php");
                        $data = getSameCategoryProduct("acc");//get all products which category == acc
                        ?>                 
                        <!-- 商品/end -->
                        <!-- 分頁/start -->
                        <div class="col-12 mt-3 mb-5">
                            <nav aria-label="Page navigation product">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                   
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- 分頁/end -->
                    </div>
                </div>
                <!-- 商品區/end -->
                <!-- 側邊欄/start -->
                <div class="col-12 col-md-3">
                    <div class="row">
                        <!-- 搜尋/start -->
                        <!-- <div class="col-12 mb-5">
                            <form action="">
                                <input type="test" class="form-control" id="PorductSearch" placeholder="搜尋...">
                            </form>
                        </div> -->
                        <!-- 搜尋/end -->
                        <!-- 購物清單/start -->
                        <!-- <div class="col-12 mb-5">
                            <h4 class="title-color">購物車</h4>
                            <div class="d-block sidebar-product-list">
                                <a class="text-white remove" data-toggle="tooltip" data-placement="top" title="是否確定要移除">X</a>
                                <a href="z1.html" class="d-inline-block">
                                    <img src="./images/product/eva_1.png" alt="eva1" class="productpic">
                                    <h6 class="d-inline-block">Hololive兔田佩克拉 生日套組</h6>
                                </a>
                                <p class="d-block text-secondary pl-4">
                                    <span class="text-warning">1</span>&nbsp;X&nbsp;NT$500
                                </p>
                            </div>
                            <div class="d-block sidebar-product-list">
                                <a class="text-white remove" data-toggle="tooltip" data-placement="top" title="是否確定要移除">X</a>
                                <a href="z9.html" class="d-inline-block">
                                    <img src="./images/product/eva_9.png" alt="eva9" class="productpic">
                                    <h6 class="d-inline-block">潤羽るしあ 生日紀念套組</h6>
                                </a>
                                <p class="d-block text-secondary pl-4">
                                    <span class="text-warning">1</span>&nbsp;X&nbsp;NT$500
                                </p>
                            </div>
                            <div class="d-block mt-3 mb-3">
                                <h5 class="text-center">小計：NT$&nbsp;1,000</h5>
                            </div>
                            <div class="d-block">
                                <a href="cart.php" class="btn btn-primary btn-block text-white" role="button">查看購物車</a>
                            </div>
                            <div class="d-block mt-1 mb-3">
                                <a href="checkout.php" class="btn btn-secondary btn-block text-white" role="button">結帳</a>
                            </div>
                        </div> -->
                        <!-- 購物清單/end -->
                        <!-- 產品分類/start -->
                        <div class="col-12 mb-5">
                            <h4 class="title-color">產品分類</h4>
                            <ul class="sidebar-product-category">
                                <li>
                                    <a href="food_dessert.php">食品/點心類</a>
                                </li>
                                <li>
                                    <a href="tea_drink.php">茶葉/飲品類</a>
                                </li>
                                <li>
                                    <a href="acc.php">裝飾/飾品類</a>
                                </li>
                                <li>
                                    <a href="fruit.php">水果類</a>
                                </li>
                            </ul>
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