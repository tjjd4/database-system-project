<?php
    require_once("dbtools.inc.php");
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
            <div class="collapse navbar-collapse " id="navbarNav">
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
    
    <!-- 折價券/start -->
    <section class="page-content">
        <div class="container mt-5">
            <!-- 領取折價券/start -->
            <div class="col-12 d-none d-md-block mb-5">
                <h2>領取你的折價券</h2>
                <div class="row">
                    <?php
                        include_once("function.php");
                        $data = getCoupon('1', $id); 
                    ?>   
                    
                    <?php
                        include_once("function.php");
                        $data = getCoupon('2', $id); 
                    ?>                                

                    <?php
                        include_once("function.php");
                        $data = getCoupon('3', $id); 
                    ?>                                
                </div>
            </div>
            <!-- 領取折價券/end -->

            <div class="col-12 d-none d-md-block mb-5">
                <a href="shop.php" class="btn btn-outline-info btn-lg float-right">前往商城使用折價券吧!!</a>
            </div>
        </div>
    </section>
    <!-- 折價券/end -->
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