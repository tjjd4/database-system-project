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
    if (!isset($_REQUEST["currentProductID"]))
    {
        echo "<script type='text/javascript'>";
        echo "location.replace('index.php');  ";
        echo "</script>";
    }
    $Product_ID = $_REQUEST["currentProductID"];
    include("function.php");
    $data = getProuctFromId($Product_ID);
    $images = getImagesFromProductId($Product_ID);
    $img_num = count($images);
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
                <!-- 產品說明/start -->
                <div class="col-12 col-md-9">
                <h4 class="title-color" style="text-align: center"><?= $data["Product_name"]?></h4>
                    <div class="row">
                        <!-- 商品照片/start -->
                        <div class="col-12 col-md-6">
                            <img src=<?= $images[0] ?> alt="eva1" class="img-fluid w-100">
                        </div>
                        <!-- 商品照片/end -->
                        <!-- 商品介紹/start -->
                        <div class="col-12 col-md-6">
                            <h5 class="text-danger">NT$&nbsp;<?=$data["Price"]?></h5>
                            <form method="post" action="product_page_transition.php" class="d-inline-block">
                            <label class="text-dark" style="float: left"><h5>數量：</h5></label>
                            <input type="number" class="form-control w-25" name="quantity" min="1" value="1">
                            <p>
                            <h5 class="text-secondary"><?=$data["Product_description"] ?></h5>
                            <!-- <p class="mt-4">台中太陽堂傳統太陽餅 30入</p> -->
                            
                            <div class="d-block mb-3">
                                
                            </div>
                            <div class="mb-3"> 
                                    <input type="submit" class="btn btn-primary text-white mr-1" name="shopping_cart" value="加入購物車">
                                    <input type="submit" class="btn btn-secondary text-white" name="checkout" value="直接結帳">
                                    <input type="hidden" name="currentProductID" value="<?php echo($Product_ID)?>">
                                
                            </div>
                            </form>
                            <p class="d-block text-secondary">產品分類：<span>食品/點心類</span></p>
                        </div>
                        <!-- 商品介紹/end -->
                        <!-- 詳細資料/start -->
                        <div class="col-12 mt-1 mb-1">
                            <ul class="nav nav-tabs bg-pekoralight" id="ProductTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">商品說明</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="specification-tab" data-toggle="tab" href="#specification" role="tab" aria-controls="specification" aria-selected="false">產品規格</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="ProductTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                    <div id="carouselBanner" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <?php
                                            for ($i = 0; $i < $img_num; $i++)
                                            {
                                                echo("<li data-target='#carouselBanner' data-slide-to='$i'");
                                                if ($i == 0)
                                                {
                                                    echo("  class='active'");
                                                }
                                                echo("></li>");
                                            }
                                            ?>
                                        </ol>
                                        <div class="carousel-inner">
                                            <?php
                                                for ($i = 0; $i < $img_num; $i++)
                                                {
                                                    $image = $images[$i];
                                                    $slide_numb = $i + 1;
                                                    echo("<div class='carousel-item");
                                                    if ($i == 0)
                                                    {
                                                        echo(" active");
                                                    }
                                                    echo("'><img class='d-block w-100' src='$image' alt='Slide $slide_numb'>
                                                    <div class='carousel-caption d-none d-md-block text-dark'>
                                                        <h3></h3>
                                                        <p></p>
                                                    </div>
                                                </div>");
                                                }
                                            ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselBanner" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselBanner" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="specification" role="tabpanel" aria-labelledby="specification-tab">
                                    <p class="p-2">
                                        <?=$data["Product_standerd"]?>
                                        </p>
                                        <!-- 品 名:太陽堂-太陽餅<br>
                                        成 份: 高級麵粉、糖、酥油、麥芽、奶粉、蜂蜜<br>
                                        淨 重:200g/盒X6盒<br>
                                        保存期限:2個月<br>
                                        保存溫度:請置於陰涼處，勿冰存以保風味<br>
                                        廠商名稱:太禓創意行銷有限公司<br>
                                        廠商地址：新北市汐止區忠孝東路487-1號1樓<br>
                                        投保產品責任險字號：0527第20AML0000061<br>
                                        食品業者登錄字號：F-145917082-00001-0</p> -->
                                </div>
                            </div>
                        </div>
                        <!-- 詳細資料/end -->
                    </div>
                </div>
                <!-- 產品說明/end -->
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
                        <div class="col-12 mb-5 ml-5">
                            <h4 class="title-color">產品分類</h4>
                            <div class="card-deck mt-2 product-categories" style="overflow-y: auto; overflow-x: hidden">
                                <div class="row">
                                    <a href="food_dessert.php" class="card">
                                        <!-- <img class="card-img-top" src="./images/slider_1.png" alt="套組"> -->
                                        <img class="card-img-top" src="./images/product_class/3.jpg" alt="食物">
                                        <div class="card-body bg-dark card-title text-white text-center">
                                            <h5>食品/</h5>
                                            <h5>點心類</h5>
                                        </div>
                                    </a>
                                    <a href="tea_drink.php" class="card">
                                        <!-- <img class="card-img-top" src="./images/service_2.png" alt="卡套"> -->
                                        <img class="card-img-top" src="./images/product_class/2.jpg" alt="飲料">
                                        <div class="card-body bg-dark card-title text-white text-center">
                                            <h5>茶葉/</h5>
                                            <h5>飲品類</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="row">
                                    <a href="acc.php" class="card">
                                        <!-- <img class="card-img-top" src="./images/service_3.png" alt="衣服"> -->
                                        <img class="card-img-top" src="./images/product_class/4.jpg" alt="裝飾">
                                        <div class="card-body bg-dark card-title text-white text-center">
                                            <h5>裝飾/</h5>
                                            <h5>飾品類</h5>
                                        </div>
                                    </a>
                                    <a href="fruit.php" class="card">
                                        <!-- <img class="card-img-top" src="./images/service_4.png" alt="滑鼠墊"> -->
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
                <!-- 訂閱/start -->
                <!-- <div class="col-12 col-md-6 mb-3">
                    <h6 class="text-white">留下 E-mail，訂閱hololive，可搶先獲得最新的資訊喔！</h6>
                    <form action="addemail.php" method="post" name="myForm">
                        <input name="email" type="email" class="form-control mt-2 mb-2" placeholder="請輸入e-mail">
                        <button type="submit" class="btn btn-primary float-right send-btn">傳送</button>
                    </form>
                </div> -->
                <!-- 訂閱/end -->
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