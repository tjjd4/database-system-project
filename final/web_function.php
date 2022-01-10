<?php
function create_title($id,$NickName)
{
    if ($id != "guest")
    {
        echo"<a href='main.php'class='btn  text-info my-2 my-sm-0'  >$NickName 您好</a> ";
        echo"<a href='main.php'class='btn btn-outline-info text-info my-2 my-sm-0'  >會員中心</a> ";
    };
    echo"<a href='cart.php'class='btn btn-outline-info text-info my-2 my-sm-0'  >購物車</a> ";
    echo"<a href='checkout.php'class='btn btn-outline-info text-info my-2 my-sm-0'  >去結帳</a> ";
    if ($id != "guest"){ echo"<a href='logout.php' class='btn btn-outline-danger text-danger '>登出</a>";}
    else
        {
            echo"<a href='logout.php' class='btn btn-danger '>登入</a>";
        }

}
function create_top_left()
{
    echo '<ul class="navbar-nav">
    <li class="nav-item ">
        <a class="nav-link"  style="height:100px width:300px" href="index.php">首頁</a>
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