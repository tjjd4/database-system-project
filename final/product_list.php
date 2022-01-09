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
                        <a class="nav-link" href="about.php">關於我們</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">買名產囉</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.ntut.edu.tw/">實體店面介紹</a>
                    </li>
                </ul>
                <div class="ml-auto">
                    <a href='main.php'><?= $NickName?></a> 你好
                    <a href='logout.php' class='btn btn-outline-danger text-danger my-2 my-sm-0'>登出</a>
                    <a href="cart.php" class="btn btn-outline-info text-info my-2 my-sm-0">購物車</a>
                    <a href="checkout.php" class="btn btn-outline-info text-info my-2 my-sm-0">結帳</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- header/end -->
    <!-- 商品列表/start -->
    <section class="page-content">
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col-0 col-md-1 bg"></div>
                
                <div class="col-12 col-md-10 mb-5">
                    <!-- 新增商品/start -->
                    <div class="float-right">
                        <button class="btn btn-outline-info text-info my-2 my-sm-0" data-toggle="modal" data-target="#addProductModal">新增商品</button>
                    </div>
                    <!-- 新增商品/end -->
                    <br/>
                    <br/>
                    <!-- 商品table/start -->
                    <div>
                        <table class="table table-borderless">
                            <thead class="table-info">
                              <tr>
                                <th>編號</th>
                                <th>商品名稱</th>
                                <th>敘述</th>
                                <th>價格</th>
                                <th>存貨</th>
                                <th>standerd</th>
                                <th>編輯</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                include_once("function.php");
                                if (isset($_GET["page"])){
                                    $page = $_GET["page"];
                                }else{
                                    $page = 1;
                                }
                                getSortedProductListByIdASC($page);
                              ?>
                            </tbody>
                          </table>
                    </div>
                </div>
                <div class="col-0 col-md-3"></div>
                <!-- 商品table/end -->
                <!-- 分頁/start -->
                <?php
                include_once("function.php");
                getNumberOfProduct($page);
                getPageLink($page);
                ?>
                <!-- 分頁/end -->
            </div>
        </div>

        <!-- 新增商品Modal/start -->
        <div class="modal fade" id="addProductModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header/start -->
                    <div class="modal-header">
                        <h4 class="modal-title">新增商品</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Header/end -->
                
                    <form action="addProduct.php" method="post" name="myForm" role="form">
                        <!-- Modal body/start -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Product_name">商品名稱
                                    <span class="text-danger">*</span>
                                </label>
                                <input name="Product_name" type="text" required="required" class="form-control" placeholder="必填，商品名稱" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="Product_description">敘述
                                    <span class="text-danger">*</span>
                                </label>
                                <input name="Product_description" type="text" required="required" class="form-control" placeholder="必填，敘述" required>
                            </div>

                            <div class="form-group">
                                <label for="price">價格
                                    <span class="text-danger">*</span>
                                </label>
                                <input name="price" type="text" class="form-control" required="required" placeholder="必填，價格" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="Stock">存貨
                                    <span class="text-danger">*</span>
                                </label>
                                <input name="Stock" type="text" class="form-control" required="required" placeholder="必填，存貨" required>
                            </div>

                            <div class="form-group">
                                <label for="Product_detail">詳細資訊</label>
                                <input name="Product_description" type="text" class="form-control" placeholder="詳細資訊" required>
                            </div>

                            <div class="form-group">
                                <label for="Product_standerd">standerd</label>
                                <input name="Standerd" type="text" class="form-control" placeholder="standerd" required>
                            </div>
                        </div>
                        <!-- Modal body/end -->
                        <!-- Modal footer/start -->
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-info" data-dismiss="modal" value="新增">
                            <input type="button" class="btn btn-danger" data-dismiss="modal" value="關閉">
                        </div>
                        <!-- Modal footer/end -->
                    </form>
                </div>
            </div>
        </div>
        <script>
$(document).ready(function(){	
	$("#contactForm").submit(function(){
        $("#submitExample").click(function() {
        $.ajax({
            type: "POST", //傳送方式
            url: "service.php", //傳送目的地
            dataType: "json", //資料格式
            data: { //傳送資料
                nickname: $("#nickname").val(), //表單欄位 ID nickname
                gender: $("#gender").val() //表單欄位 ID gender
            },
	});
});
        </script>
        <!-- 新增商品Modal/end -->

        <!-- 編輯商品Modal/start -->
        <div class="modal fade" id="editProductModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header/start -->
                    <div class="modal-header">
                        <h4 class="modal-title">編輯商品</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Header/end -->
                
                    <!-- Modal body/start -->
                    <div class="modal-body">
                        <form action="" method="post" name="myForm">
                            <div class="form-group">
                                <label for="Product_name">商品名稱
                                    <span class="text-danger">*</span>
                                </label>
                                <input name="Product_name" type="text" required="required" class="form-control" placeholder="必填，商品名稱" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="Product_description">敘述
                                    <span class="text-danger">*</span>
                                </label>
                                <input name="Product_description" type="text" required="required" class="form-control" placeholder="必填，敘述" required>
                            </div>

                            <div class="form-group">
                                <label for="price">價格
                                    <span class="text-danger">*</span>
                                </label>
                                <input name="price" type="text" class="form-control" required="required" placeholder="必填，價格" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="Stock">存貨
                                    <span class="text-danger">*</span>
                                </label>
                                <input name="Stock" type="text" class="form-control" required="required" placeholder="必填，存貨" required>
                            </div>

                            <div class="form-group">
                                <label for="Product_detail">詳細資訊</label>
                                <input name="Product_description" type="text" class="form-control" placeholder="詳細資訊" required>
                            </div>

                            <div class="form-group">
                                <label for="Product_standerd">standerd</label>
                                <input name="Standerd" type="text" class="form-control" placeholder="standerd" required>
                            </div>

                            <div class="modal-footer">
                                <input type="submit" class="btn btn-info" data-dismiss="modal" value="新增">
                                <input type="submit" class="btn btn-danger" data-dismiss="modal" value="關閉">
                            </div>
                        </form>
                    </div>
                    <!-- Modal body/end -->
                
                    <!-- Modal footer/start -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">新增</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">關閉</button>
                    </div>
                    <!-- Modal footer/end -->
                </div>
            </div>
        </div>
        <!-- 編輯商品Modal/end -->

    </section>
    <!-- 商品列表/end -->
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
</body>
</html>