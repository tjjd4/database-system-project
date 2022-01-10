<?php
function create_title($id,$NickName)
{
    if ($id != "guest")
    {
        echo"<a href='main.php'class='btn btn-outline-info text-info my-2 my-sm-0'  >會員中心</a> ";
    };
    echo"<a href='cart.php'class='btn btn-outline-info text-info my-2 my-sm-0'  >購物車</a> ";
    echo"<a href='checkout.php'class='btn btn-outline-info text-info my-2 my-sm-0'  >去結帳</a> ";
    if ($id != "guest"){ echo"<a href='logout.php' class='btn btn-outline-danger text-danger '>登出</a>";}
    else
        {
            echo"<a href='login.html' class='btn btn-outline-danger text-danger'>登入</a>";
        }
}
function create_top_left()
{
    echo '
    
    <ul class="nav justify-content-center">
    <li class="nav-item ">
        <a class="navbar-brand" href="index.php">首頁</a>
    </li>
    <li class="nav-item ">
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
</ul>';
}


?>
<!-- <a class="navbar-brand" href="index.php">
                <img id="logo1" src="./images/logo.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->