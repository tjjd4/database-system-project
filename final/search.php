<?php
  require_once("dbtools.inc.php");
  header("Content-type: text/html; charset=utf-8");
  
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
        WHERE P.Product_Name LIKE "%'.$search_product.'%" AND ABS(LENGTH("%'.$search_product.'%")-Length(P.Product_Name))!=0;';
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
//   else  //如果帳號存在
//   {
    #$row = mysqli_fetch_assoc($result);
    #echo $row["Product_Name"];
    #echo $row["Price"];
    
    #$Product_Name = $row["Product_Name"];
    #$Price = $row["Price"];
    ?>
    $msg2="<!DOCTYPE html>
    
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <title>HOLO商城</title>
        <link rel='shortcut icon' type='image/png' href='./images/logo.png'/>
        <!-- CSS文件載入 -->
        <link rel='stylesheet' href='./css/bootstrap.min.css'>
        <link rel='stylesheet' href='./css/color.css'>
        <link rel='stylesheet' href='./css/frame.css'>
        <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
        <link rel='stylesheet' href='./css/style.css'>
        <!-- js文件載入 -->
        <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
        <script src='./js/bootstrap.bundle.min.js'></script>
    </head>
    <body>
        <!-- header/start -->
        <header class='container'>
            <nav class='navbar navbar-expand-lg navbar-light bg-white'>
                <a class='navbar-brand' href='index.php'>
                    <img src='./images/logo.png' alt='logo'>
                </a>
                <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false'
                    aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav'>
                        <li class='nav-item active'>
                            <a class='nav-link' href='index.php'>首頁</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='about.php'>HOLOLIVE</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='shop.php'>HOLO商城</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='job.php'>人物介紹</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='https://schedule.hololive.tv/'>直播時間與連結</a>
                        </li>
                    </ul>
                    <div class='ml-auto'>
                        <a href='login.html' class='btn btn-outline-info text-info my-2 my-sm-0'>登入</a>
                        <a href='cart.php' class='btn btn-outline-info text-info my-2 my-sm-0'>購物車</a>
                        <a href='checkout.php' class='btn btn-outline-info text-info my-2 my-sm-0'>結帳</a>
                    </div>
                </div>
            </nav>
        </header>
        <!-- header/end -->
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
                            <p class="d-inline-block">顯示 27 筆結果中的 1–9 筆</p>
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
                        SearchToGetSortedProductByPriceASC($search_product,1);
                        ?>
        <div class='container pt-3 pb-3 mt-5'>
            <div class='row'>
                <div class='col-12 col-md12 '>
                    <p align-middle>查詢結果</p>
                </div>
            </div>
            <div class='row '>
                <div class='col-12 col-md12'>
                    <img class='f1001'src='./images/understructure.png'>
                </div>
            </div>
            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 頁腳/start -->
        <footer class='bg-pekoradark'>
            <div class='container pt-3 pb-3'>
                <div class='row'>
                    <!-- 選單連結/start -->
                    <div class='col-12 col-md-6 mb-3'>
                        <ul class='footer-menu'>
                            <li><a href='index.php'>首頁</a></li>
                            <li><a href='about.php'>HOLOLIVE</a></li>
                            <li><a href='shop.php'>HOLO商城</a></li>
                            <li><a href='job.php'>成員簡介</a></li>
                            <li><a href='https://schedule.hololive.tv/'>直播時間</a></li>
                            <li><a href='login.html'>登入</a></li>
                            <li><a href='cart.php'>購物車</a></li>
                            <li><a href='checkout.php'>結帳</a></li>
                        </ul>
                    </div>
                    <!-- 選單連結/end -->
                    <!-- 訂閱/start -->
                    <div class='col-12 col-md-6 mb-3'>
                        <h6 class='text-white'>留下 E-mail，訂閱hololive，可搶先獲得最新的資訊喔！</h6>
                        <form action='addemail.php' method='post' name='myForm'>
                            <input name='email' type='email' class='form-control mt-2 mb-2' placeholder='請輸入e-mail'>
                            <button type='submit' class='btn btn-primary float-right send-btn'>傳送</button>
                        </form>
                    </div>
                    <!-- 訂閱/end -->
                    <!-- 版權所有/start -->
                    <div class='col-12 mt-3'>
                        <p class='text-white text-center'>© Copyright 2021 hololive</p>
                    </div>
                    <!-- 版權所有/end -->
                </div>
            </div>
        </footer>
        <!-- 頁腳/end -->
    </body>
    </html>";
    $message = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <title>HOLO商城</title>
        <link rel='shortcut icon' type='image/png' href='./images/logo.png'/>
        <!-- CSS文件載入 -->
        <link rel='stylesheet' href='./css/bootstrap.min.css'>
        <link rel='stylesheet' href='./css/color.css'>
        <link rel='stylesheet' href='./css/frame.css'>
        <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
        <link rel='stylesheet' href='./css/style.css'>
        <!-- js文件載入 -->
        <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
        <script src='./js/bootstrap.bundle.min.js'></script>
    </head>
    <body>
        <!-- header/start -->
        <header class='container'>
            <nav class='navbar navbar-expand-lg navbar-light bg-white'>
                <a class='navbar-brand' href='index.php'>
                    <img src='./images/logo.png' alt='logo'>
                </a>
                <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false'
                    aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav'>
                        <li class='nav-item active'>
                            <a class='nav-link' href='index.php'>首頁</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='about.php'>HOLOLIVE</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='shop.php'>HOLO商城</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='job.php'>人物介紹</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='https://schedule.hololive.tv/'>直播時間與連結</a>
                        </li>
                    </ul>
                    <div class='ml-auto'>
                        <a href='login.html' class='btn btn-outline-info text-info my-2 my-sm-0'>登入</a>
                        <a href='cart.php' class='btn btn-outline-info text-info my-2 my-sm-0'>購物車</a>
                        <a href='checkout.php' class='btn btn-outline-info text-info my-2 my-sm-0'>結帳</a>
                    </div>
                </div>
            </nav>
        </header>
        <!-- header/end -->
        
        <div class='container pt-3 pb-3 mt-5'>
            <div class='row'>
                <div class='col-12 col-md12 '>
                    <p align-middle>$NickName 您好，您的帳號資料如下：<br><br>
                        　　帳號：$Username<br>
                        　　密碼：$password<br><br>
                          <a href='http://localhost/Final/login.html'>按此登入本站</a></p>
                </div>
            </div>
            <div class='row '>
                <div class='col-12 col-md12'>
                    <img class='f1001'src='./images/re.png'>
                </div>
            </div>
            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 頁腳/start -->
        <footer class='bg-pekoradark'>
            <div class='container pt-3 pb-3'>
                <div class='row'>
                    <!-- 選單連結/start -->
                    <div class='col-12 col-md-6 mb-3'>
                        <ul class='footer-menu'>
                            <li><a href='index.php'>首頁</a></li>
                            <li><a href='about.php'>HOLOLIVE</a></li>
                            <li><a href='shop.php'>HOLO商城</a></li>
                            <li><a href='job.php'>成員簡介</a></li>
                            <li><a href='https://schedule.hololive.tv/'>直播時間</a></li>
                            <li><a href='login.html'>登入</a></li>
                            <li><a href='cart.php'>購物車</a></li>
                            <li><a href='checkout.php'>結帳</a></li>
                        </ul>
                    </div>
                    <!-- 選單連結/end -->
                    <!-- 訂閱/start -->
                    <div class='col-12 col-md-6 mb-3'>
                        <h6 class='text-white'>留下 E-mail，訂閱hololive，可搶先獲得最新的資訊喔！</h6>
                        <form action='addemail.php' method='post' name='myForm'>
                            <input name='email' type='email' class='form-control mt-2 mb-2' placeholder='請輸入e-mail'>
                            <button type='submit' class='btn btn-primary float-right send-btn'>傳送</button>
                        </form>
                    </div>
                    <!-- 訂閱/end -->
                    <!-- 版權所有/start -->
                    <div class='col-12 mt-3'>
                        <p class='text-white text-center'>© Copyright 2021 hololive</p>
                    </div>
                    <!-- 版權所有/end -->
                </div>
            </div>
        </footer>
        <!-- 頁腳/end -->
    </body>
    </html>
    ";
	<?php
    if ($show_method == "網頁顯示")
    {
      echo $message;   //顯示訊息告知使用者帳號密碼
    }
    else
    {
      
      echo $msg2;				
    }
  

  //釋放 $result 佔用的記憶體
  mysqli_free_result($result);
		
  //關閉資料連接	
  mysqli_close($link);
?>