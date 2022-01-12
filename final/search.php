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
    
  //取得表單資料
  #$Username = $_POST["account"]; 
  #$Email = $_POST["email"];
  #$show_method = $_POST["show_method"]; 

  #########(project code)
  $search_product=$_GET["search_product"];
  #########
  
  //建立資料連接
  $link = create_connection();

  //檢查查詢的帳號是否存在
  #$sql = "SELECT Member_password, Member_name FROM Member WHERE Username = '$Username' AND Email = '$Email'";
  #$result = execute_sql($link, "DBS_project", $sql);

  ###########project code
  #檢查搜尋是否有結果
  $sql='SELECT P.Product_ID 
        FROM `Product` as P 
        WHERE P.Product_Name LIKE "%'.$search_product.'%" AND LENGTH("'.$search_product.'")>0;';
  $result = execute_sql($link, "DBS_project", $sql);


  //如果帳號不存在
  if (mysqli_num_rows($result) == 0)
  {
    //顯示訊息告知使用者，查詢的商品並不存在
    echo "<script type='text/javascript'>
            alert('您所查詢的資料不存在，請檢查是否輸入錯誤。');
            history.back();
          </script>";
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
        <!-- 產品商城/start -->
        <section class="page-content">
            <div class="container pt-5 pb-5">
                <div class="row">
                    <!-- 商品區/start -->
                    <div class="col-12 col-md-9">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <img src="./images/shop.jpg" alt="Shop Banner" class="img-fluid">
                            </div>
                            <!-- 排序/start -->
                            <div class="col-12 mt-3 mb-3">
                                <?php include_once("function.php");
                                    if (isset($_GET["page"])){
                                        $page = $_GET["page"];
                                    }else{
                                        $page = 1;
                                    }
                                    echo('<p class="d-inline-block">');
                                    getNumberOfSearchedProduct($page, $search_product);
                                    echo('</p>'); ?>
                                <form action="" class="d-inline-block float-right">
                                    <select id="ProductSelect" class="form-control">
                                        <option>依上架時間</option>
                                        <option>依熱銷度</option>
                                        <option>依價格排序:低至高</option>
                                        <option>依價格排序:高至低</option>
                                    </select>
                                </form>
                                <hr>
                            </div>
                            <!-- 排序/end -->
                            <!-- 商品/start -->
                            <?php
                            include_once("function.php");
                            $dataone = SearchToGetSortedProductByPriceASC($search_product,$page, 'all');//get all products which category == fruit
                            
                            ?>      
                            <!-- 商品/end -->
                            <!-- 分頁/start -->
                            <?php getPageLink($page, 'all'); ?>
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
    ";
	<?php
    
  

  //釋放 $result 佔用的記憶體
  mysqli_free_result($result);
		
  //關閉資料連接	
  mysqli_close($link);
?>