<?php
    require_once("dbtools.inc.php");
    $Coupon_ID = $_POST["currentCouponID"];
    $Member_ID = $_POST["currentMemberID"];
    $link = create_connection();
    $sql = "insert into CouponList(Coupon_ID, `Member_ID`, Used)
            value($Coupon_ID, $Member_ID, 'No');";
    $result = execute_sql($link, "DBS_project", $sql);
    mysqli_close($link);
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
    <!-- 領取成功/start -->
    <section class="page-content">
        <div class="container mt-5">
            <div class="col-12 col-md-3 mb-3">
                <h1 class="text-success"> 領 取 成 功 ! !</h1>
                <a href="coupon.php" class="btn btn-outline-info text-info float-right">確認</a>
            </div>
        </div>
    </section>
    <!-- 領取成功/end -->
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({trigger: "click"});
        })
    </script>
</body>
</html>