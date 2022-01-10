<?php
	if (empty($_COOKIE["id"]))
    {
      setcookie("id", "guest");
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
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/color.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/about.css">
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
                    <form action="search.php">
                        <li class="nav-item">
                            <input name="search_product" type="text" class="form-control" id="search_product" placeholder="搜尋...">
                        </li>
                    </form>
                </ul>
                <div class="ml-auto">
                    <?php
                            if ($_COOKIE["id"]=="guest")
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
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="col-12 col-md-8">
                    <p id="aboutus">ABOUT US</p>
                </div>
                <div class="col-0 col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="col-12 col-md-8">
                    <img  id="holopic" src="images/school.jpg">
                </div>
                <div class="col-0 col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="col-12 col-md-8"> 
                    <p id="aboutus">台北科技大學 資工系</p>
                </div>
                <div class="col-0 col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="col-12 col-md-8">
                    <p id="introduction">國立臺北科技大學資訊工程系課程設計以「語言與軟體」、「數學與演算」與「計算機系統」等三大基礎領域為主軸，規劃「軟體系統」、「多媒體系統」及「網路系統」等三個專業領域，提供基礎理論與實作應用兼備的訓練與發展環境，並以此三大特色研究領域為核心，發展兼具實用性與前瞻性的資訊科技，以培養能直接投入資訊產業的務實科技人才為教育目標。</p>
                </div>
                <div class="col-0 col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="col-12 col-md-8">
                    <p id="aboutus">Team member</p>
                </div>
                <div class="col-0 col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="col-12 col-md-2">
                    <span class="h2">洪德易</span>
                </div>
                <div class="col-12 col-md-2">
                    <span class="h2">洪子翔</span>
                </div>
                <div class="col-12 col-md-2">
                    <span class="h2">單綿恆</span>
                </div>
                <div class="col-12 col-md-2">
                    <span class="h2">賀國成</span>
                </div>
                <div class="col-0 col-md-2"></div>
                <div class="col-0 col-md-2"></div>
                <div class="col-12 col-md-2">
                    <span class="h4 text-muted">電資三</span>
                </div>
                <div class="col-12 col-md-2">
                    <span class="h4 text-muted">電資三</span>
                </div>
                <div class="col-12 col-md-2">
                    <span class="h4 text-muted">電資三</span>
                </div>
                <div class="col-12 col-md-2">
                    <span class="h4 text-muted">電資三</span>
                </div>
                <div class="col-0 col-md-2"></div>
            </div>
            <br/>
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="col-12 col-md-2">
                    <span class="h2">李以謙</span>
                </div>
                <div class="col-12 col-md-2">
                    <span class="h2">陳韋堯</span>
                </div>
                <div class="col-12 col-md-2">
                    <span class="h2">方文昊</span>
                </div>
                <div class="col-0 col-md-4"></div>
                <div class="col-0 col-md-2"></div>
                <div class="col-12 col-md-2">
                    <span class="h4 text-muted">電資三</span>
                </div>
                <div class="col-12 col-md-2">
                    <span class="h4 text-muted">資財四乙</span>
                </div>
                <div class="col-12 col-md-2">
                    <span class="h4 text-muted">資工三</span>
                </div>
                <div class="col-0 col-md-2"></div>
            </div>
        </div>
        <br/>
        <br/>
    </section>
    <!-- 關於岡南/end -->
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