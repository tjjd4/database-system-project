<?php
  require_once("dbtools.inc.php");
  
  //取得表單資料
  $Username = $_POST["account"];
  $Member_password = $_POST["password"];  
  $Email = $_POST["email"]; 
  $Phone = $_POST["Phone"]; 
  $Member_name = $_POST["NickName"];

  //建立資料連接
  $link = create_connection();
			
  //檢查帳號是否有人申請
  $sql = "SELECT * FROM `Member` Where Username = '$Username'";
  $result = execute_sql($link, "DBS_project", $sql);

  //如果帳號已經有人使用
  if (mysqli_num_rows($result) != 0)
  {
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result);
		
    //顯示訊息要求使用者更換帳號名稱
    echo "<script type='text/javascript'>";
    echo "alert('您所指定的帳號已經有人使用，請使用其它帳號');";
    echo "history.back();";
    echo "</script>";
  }
	
  //如果帳號沒人使用
  else
  {
    //釋放 $result 佔用的記憶體	
    mysqli_free_result($result);
		
    //執行 SQL 命令，新增此帳號

    $sql = "INSERT INTO Member (Username,Member_password,Email,Phone,Member_name) VALUES ('$Username', '$Member_password', '$Email', '$Phone', '$Member_name')";
    $result = execute_sql($link, "DBS_project", $sql);
  }
	
  //關閉資料連接	
  mysqli_close($link);
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
                    <a href="login.html" class="btn btn-outline-info text-info my-2 my-sm-0">登入</a>
                    <a href="cart.php" class="btn btn-outline-info text-info my-2 my-sm-0">購物車</a>
                    <a href="checkout.php" class="btn btn-outline-info text-info my-2 my-sm-0">結帳</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- header/end -->
    
    <div class="container pt-3 pb-3 c">
      <div class="row">
        
        <div class="col-12 col-md-8">
          <img class="f1001 c" src="./images/success.png">
        </div>

        <div class="col-12 col-md-4">
                <div href="#" class="card mb-3">
                    <img class="card-img-top f1001" src="./images/chibiame.gif" alt="LTG-BY-0001">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $Member_name ?>你好</h4>
                        <!-- <p class="card-text">id:<font color="#FF0000"><?php echo $account?></font></p>
                        <p class="card-text">password:<font color="#FF0000"><?php echo $password?></font></p> -->
                    </div>
                </div>
            </div>
      </div>
       
      <div class="row">
            <div class="col-0 col-sm-3 col-md-4"></div>
            
            <div class="col-0 col-sm-3 col-md-4"></div>
      </div>
    </div>
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
                    <form action="">
                        <input type="email" class="form-control mt-2 mb-2" placeholder="請輸入e-mail">
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