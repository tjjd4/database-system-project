<?php
	if (empty($_COOKIE["id"]))
    {
      setcookie("id", "guest");	
    }
    else
    {
        $id = $_COOKIE["id"];
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
    <link rel="stylesheet" href="./css/cha.css">
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
                        <a class="nav-link" href="shop.php">台灣名產商城</a>
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
    <section class="page-content">
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col-12">
                    <h2>hololive成員</h2>
                    <div class="table-responsive-sm table-middle">
                        <table class="table table-hover">
                            <thead class="bg-pekoradark">
                                <tr class="c">
                                    <th scope="col" style="color:white">角色名稱</th>
                                    <th scope="col" style="color:white">期數</th>
                                    <th scope="col" style="color:white">簡介</th>
                                    <th scope="col" style="color:white">圖片</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="c">
                                    <th scope="row">Gawr gura</th>
                                    <td>holoEN 第一期</td>
                                    <td >
                                        <ul>
                                            <li>9000歲</li>
                                            <li>鯊魚</li>
                                            <li>a</li>
                                            <li>很可愛</li>
                                        </ul>
                                    </td>
                                    <td>
                                        <img class="tablepic"src="images/gawrgura.png">
                                    </td>
                                </tr>
                                <tr class="c">
                                    <th scope="row">Amelia Watson</th>
                                    <td>holoEN 第一期</td>
                                    <td>
                                        <ul>
                                            <li>偵探</li> 
                                            <li>中之人是地精</li> 
                                        </ul>
                                    </td>
                                    <td>
                                        <img class="tablepic"src="images/ameliawatson.png">
                                    </td>
                                </tr>
                                <tr class="c">
                                    <th scope="row">Haachama 赤井心</th>
                                    <td>jp一期</td>
                                    <td>
                                        <li>哈洽馬洽麻</li> 
                                        <li>食蟲少女</li>
                                    </td>
                                    <td>
                                        <img class="tablepic" src="images/haachama.jfif">
                                    </td>
                                </tr>
                                <tr class="c">
                                    <th scope="row">白上吹雪</th>
                                    <td>jp一期</td>
                                    <td>
                                        <li>是貓咪不是狐狸</li> 
                                        <li>咪</li>
                                    </td>
                                    <td>
                                        <img class="tablepic" src="images/fubuki.jpg">
                                    </td>
                                </tr>
                                <tr class="c">
                                    <th scope="row">潤羽露西亞</th>
                                    <td>jp三期</td>
                                    <td>
                                        <li>初號機</li> 
                                        <li>粽子</li>
                                    </td>
                                    <td>
                                        <img class="tablepic" src="images/rusia.jpg">
                                    </td>
                                </tr>
                                <tr class="c">
                                    <th scope="row">兔田佩克拉</th>
                                    <td>jp三期</td>
                                    <td>
                                        <li>屑兔</li> 
                                        <li>哈哈哈哈</li>
                                    </td>
                                    <td>
                                        <img class="tablepic" src="images/pekora.png">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 人力資源/end -->
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
</body>
</html>