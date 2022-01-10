<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];
  $id = $_COOKIE["id"]; 
  $NickName = $_COOKIE["NickName"]; 

  /*  如果 cookie 中的 passed 變數不等於 TRUE
      表示尚未登入網站，將使用者導向首頁 index.php	*/
  if ($passed != "TRUE")
  {
    header("location:index.php");
    exit();
  }
  else
  {
    include_once("shopcart.inc.php");
    retrieve_shopping_cart();
  }

  $link = create_connection();	
  $sql = "SELECT Permission FROM `Member` Where Member_ID = $id";
  $result = execute_sql($link, "DBS_project", $sql);
  $data = mysqli_fetch_array($result);
  mysqli_free_result($result);
  mysqli_close($link);
  $permission = $data["Permission"]
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
    <!-- header/end -->
    
    <div class="container pt-3 pb-3 mt-5">
        <div class="row">
            <div class="col-12 col-md12 ">
                <p align-middle><?php echo $NickName?> 你好，歡迎來到會員中心</p>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-md12">
                <img class="f1001"src="./images/center.png">
            </div>
        </div>
        <?php if ($permission == 1):?>
            <div class="row mt-5">
                <div class="col-12 col-md-4">
                    <div href="#" class="card h-100 mb-3">
                        <img class="card-img-top" src="./images/chibiame-modify.gif" alt="LG-GP-0001">
                        <div class="card-body">
                        <a href="modify.php" class="btn btn-outline-secondary btn-block">修改會員資料</a>
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div href="#" class="card h-100 mb-3">
                        <img class="card-img-top" src="./images/chibiame-product_list.gif" alt="LG-GP-0001">
                        <div class="card-body">
                            <a href="product_list.php" class="btn btn-outline-secondary btn-block">管理商品</a>                      
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div href="#" class="card mb-3 h-100">
                        <img class="card-img-top" src="./images/chibiame-index.gif" alt="LG-GP-0001">
                        <div class="card-body">
                            <a href="order_list.php" class="btn btn-outline-secondary btn-block">管理訂單</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else:?>
            <div class="row mt-5">
                <div class="col-12 col-md-6">
                    <div href="#" class="card h-100 mb-3">
                        <img class="card-img-top" src="./images/chibiame-modify.gif" alt="LG-GP-0001">
                        <div class="card-body">
                        <a href="modify.php" class="btn btn-outline-secondary btn-block">修改會員資料</a>
                            
                        </div>
                    </div>
                </div>

            <div class="col-12 col-md-6">
                <div href="#" class="card mb-3 h-100">
                    <img class="card-img-top" src="./images/chibiame-index.gif" alt="LG-GP-0001">
                    <div class="card-body">
                        <a href="order_list.php" class="btn btn-outline-secondary btn-block">查看訂單</a>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
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