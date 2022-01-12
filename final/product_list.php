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
            <div class="collapse navbar-collapse" id="navbarNav">
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
    <!-- 商品列表/start -->
    <section class="page-content">
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col-0 col-md-1 bg"></div>
                
                <div class="col-12 col-md-12 mb-5">
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
                                <th>分類</th>
                                <th>價格</th>
                                <th>存貨</th>
                                <th>詳細資訊</th>
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
                                getSortedProductListByIdASC($page, 'all');
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
                echo('<p class="col-12 mt-3 mb-3 d-inline-block">');
                getNumberOfProduct($page, 'all');
                echo('</p>');
                getPageLink($page, 'all');
                ?>
                <!-- 分頁/end -->
            </div>
        </div>

        <!-- 新增商品Modal/start -->
        <div class="modal fade modal-xl" id="addProductModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header/start -->
                    <div class="modal-header">
                        <h4 class="modal-title">新增商品</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Header/end -->
                
                    <form method="post" name="myForm">
                        <!-- Modal body/start -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Product_name_add">商品名稱
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="Product_name_add" type="text" required="required" class="form-control" placeholder="必填，商品名稱">
                            </div>
                            
                            <div class="form-group">
                                <label for="Product_description_add">敘述
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="Product_description_add" type="text" required="required" class="form-control" placeholder="必填，敘述">
                            </div>
                            
                            <div class="form-group">
                                <label for="Product_description_add">分類
                                    <span class="text-danger">*</span>
                                </label>
                                <select id="Category_add" class="form-control" aria-label="Disabled select example">
                                    <option value="1">食品/點心類</option>
                                    <option value="2">茶葉/飲品類</option>
                                    <option value="3">裝飾/飾品類</option>
                                    <option value="4">水果類</option>
                                    <option value="5">其他</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Price_add">價格
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="Price_add" type="number" class="form-control" required="required" placeholder="必填，價格">
                            </div>
                            
                            <div class="form-group">
                                <label for="Stock_add">存貨
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="Stock_add" type="number" class="form-control" required="required" placeholder="必填，存貨">
                            </div>

                            <div class="form-group">
                                <label for="Product_detail_add">詳細資訊</label>
                                <input id="Product_detail_add" type="text" class="form-control" placeholder="詳細資訊">
                            </div>

                            <div class="form-group">
                                <label for="Product_standerd_add">產品規格</label>
                                <input id="Product_standerd_add" type="text" class="form-control" placeholder="產品規格">
                            </div>

                            <div class="form-group">
                                <label for="Image_path_add">圖片檔案名稱
                                <span class="text-danger">* 必須將檔案放在 "final/added_product_images/"</span>
                                </label>
                                <input id="Image_path_add" type="text" class="form-control" required="required" placeholder="必填，ex: abc.jpeg">
                            </div>
                        </div>
                        <!-- Modal body/end -->
                        <!-- Modal footer/start -->
                        <div class="modal-footer">
                            <input id="addButton" type="submit" class="btn btn-info" value="新增">
                            <input type="button" class="btn btn-danger" data-dismiss="modal" value="關閉">
                        </div>
                        <!-- Modal footer/end -->
                    </form>
                </div>
            </div>
        </div>
        <!-- 新增商品Modal/end -->

        <!-- 新增商品jquery/start -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){	
                $('#addButton').click(function(){
                    $.ajax({
                        type: "POST", //傳送方式
                        url: "addProduct.php", //傳送目的地
                        dataType: "JSON",
                        data: {
                            Product_name: $("#Product_name_add").val(),
                            Product_description: $("#Product_description_add").val(),
                            Category: $("#Category_add").val(),
                            Price: $("#Price_add").val(),
                            Stock: $("#Stock_add").val(),
                            Product_detail: $("#Product_detail_add").val(),
                            Product_standerd: $("#Product_standerd_add").val(),
                            Image_path: $("#Image_path_add").val()
                        },
                        success: function(data) {
                            if (data.result_product) {
                                if (data.result_delete){
                                    alert("Product "+data.Product_name+" added failed! (image error)");
                                }else {
                                    alert("Product and Image added successfully!");
                                }
                            }else {
                                alert("Product "+data.Product_name+" added failed!");
                            }
                        },
                        error: function() {
                            alert("Connect error!");
                        }
                    })
                })
            });
        </script>
        <!-- 新增商品jquery/end -->

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
                    <form method="post" name="myForm">
                        <!-- Modal body/start -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label id="modify-data-id" data-id="" for="Product_name">商品名稱
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="Product_name" type="text" class="form-control" required="required" placeholder="必填，商品名稱">
                            </div>
                            
                            <div class="form-group">
                                <label for="Product_description">敘述
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="Product_description" type="text" class="form-control" required="required" placeholder="必填，敘述">
                            </div>

                            <div class="form-group">
                                <label for="Product_description_add">分類
                                    <span class="text-danger">*</span>
                                </label>
                                <select id="Category" class="form-control" aria-label="Disabled select example">
                                    <option value="1">食品/點心類</option>
                                    <option value="2">茶葉/飲品類</option>
                                    <option value="3">裝飾/飾品類</option>
                                    <option value="4">水果類</option>
                                    <option value="5">其他</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Price">價格
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="Price" type="number" class="form-control" required="required" placeholder="必填，價格">
                            </div>
                            
                            <div class="form-group">
                                <label for="Stock">存貨
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="Stock" type="number" class="form-control" required="required" placeholder="必填，存貨">
                            </div>

                            <div class="form-group">
                                <label for="Product_detail">詳細資訊</label>
                                <input id="Product_detail" type="text" class="form-control" placeholder="詳細資訊">
                            </div>

                            <div class="form-group">
                                <label for="Product_standerd">產品規格</label>
                                <input id="Product_standerd" type="text" class="form-control" placeholder="產品規格">
                            </div>

                            <div class="form-group">
                                <label for="Image_path">圖片檔案名稱
                                <span class="text-danger">必須將檔案放在 "final/added_product_images"</span>
                                </label>
                                <input id="Image_path" type="text" class="form-control" placeholder="ex: abc.jpeg">
                            </div>
                        </div>
                        <!-- Modal body/end -->
                        <!-- Modal footer/start -->
                        <div class="modal-footer">
                            <input id="modifyButton" type="submit" class="btn btn-info" value="修改">
                            <input type="button" class="btn btn-danger" data-dismiss="modal" value="關閉">
                        </div>
                        <!-- Modal footer/end -->
                    </form>
                    <!-- Modal footer/end -->
                </div>
            </div>
        </div>
        <!-- 編輯商品Modal/end -->
        
        <script>
        $(function () {
            $('button[name="modify"]').on('click', function () {
                var id = $(this).data("id");
                $.ajax({
                    type: "POST", //傳送方式
                    url: "queryProductData.php", //傳送目的地
                    dataType: "JSON",
                    data: {
                        Product_ID: id
                    },
                    success: function (data) {
                        $('#Product_name').val(data.Product_name);
                        $('#Product_description').val(data.Product_description);
                        $('#Category').val(data.Category_name);
                        $('#Price').val(data.Price);
                        $('#Stock').val(data.Stock);
                        $('#Product_detail').val(data.Product_detail);
                        $('#Product_standerd').val(data.Product_standerd);
                        $('#modify-data-id').attr("data-id", data.Product_ID);
                    },
                    error: function(){
                        alert('data loading error...');
                    }
                })
            })
        });   
        </script>

        <!-- 編輯商品jquery/start -->
        <script>
            $(document).ready(function(){	
                $('#modifyButton').click(function(){
                    $.ajax({
                        type: "POST", //傳送方式
                        url: "modifyProduct.php", //傳送目的地
                        dataType: "JSON",
                        data: {
                            Product_ID: $("#modify-data-id").attr("data-id"),
                            Product_name: $("#Product_name").val(),
                            Product_description: $("#Product_description").val(),
                            Category: $("#Category").val(),
                            Price: $("#Price").val(),
                            Stock: $("#Stock").val(),
                            Product_detail: $("#Product_detail").val(),
                            Product_standerd: $("#Product_standerd").val(),
                            Image_path: $("#Image_path").val()
                        },
                        success: function(modify_data){
                            if (modify_data.result_product){
                                if (modify_data.image_update){
                                    if(!modify_data.result_image){
                                        alert("Product update successful, but image not found...");
                                    }else{
                                        alert("Update successfully!!!(product and image)");
                                    }
                                }else{
                                    alert("Update successfully!!!");
                                }
                            }else{
                                alert("Update error...");
                            }
                        },
                        error: function() {
                            alert("Connect error!");
                        }
                    })
                })
            });
        </script>
        <!-- 編輯商品jquery/end -->

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