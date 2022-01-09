<?php
    require_once("dbtools.inc.php");
    function getProuctFromId($id){
        $link = create_connection();
        $sql = "SELECT * FROM `Product` Where Product_ID = $id";
        $result = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result);
        mysqli_free_result($result);
        return $data;
    }

    function getCategoryFromId($id){
        $link = create_connection();
        $sql = "SELECT * FROM `Category` Where Product_ID = $id";
        $result = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result);
        mysqli_free_result($result);
        return $data;
    }

    function getImagesFromProductId($id){
        $link = create_connection();
        $sql = "SELECT * FROM `Product_Image` Where Product_ID = $id";
        $result = execute_sql($link, "DBS_project", $sql);
        $data = array();
        while ($rs = mysqli_fetch_array($result)){
            array_push($data, $rs["Image_path"]);
        }
        return $data;
    }


    function createProductBox($id){
        $link = create_connection(); 
        $sql = "SELECT * 
                FROM `Product`as P, `Product_Image`as PI 
                Where P.Product_ID = $id and P.Product_ID = PI.Product_ID and PI.Image_ID = $id;";
        $result = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result);
        mysqli_free_result($result);
        $txt = '<div class="col-12 col-sm-6 col-md-3 ">
                <div href="#" class="card h-100 mb-3">
                    <!-- <img class="card-img-top" src='.$data["Image_path"].' alt="LTG-BY-0001"> -->
                    <img class="card-img-top" src='.$data["Image_path"].' width="250" height="130" alt="LTG-BY-0001">
                    <div class="card-body">
                        <h4 class="card-title">'.$data["Product_name"].'</h4>
                        <p class="card-text">'.$data["Product_description"].'</p>
                        <h5 class="card-text text-danger">
                            NT$&nbsp;'.$data["Price"].'
                        </h5>
                        <form method="post" name="myForm" action="product_page.php">
                            <input type="hidden" name="currentProductID" value='.$id.'>
                            <input class="btn btn-outline-secondary btn-block" type="submit" value="查看商品">
                        </form>
                        <form method="post" name="add_shoping_cart">
                        <input class="btn btn-outline-primary btn-block mt-2" type="submit" name="add_shopping_cart" value="加入購物車">
                        <input type="hidden" name="currentProductID" value='.$id.'>
                      </form>
                    </div>
                </div>
            </div>';
        echo $txt;
    }

    function createProductList($id){
        $link = create_connection(); 
        $sql = "SELECT * 
                FROM `Product`as P, `Product_Image`as PI 
                Where P.Product_ID = $id and P.Product_ID = PI.Product_ID and PI.Image_ID = $id;";
        $result = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result);
        mysqli_free_result($result);
        $txt = '<tr>
                    <td>'.$data["Product_ID"].'</td>
                    <td>'.$data["Product_name"].'</td>
                    <td>'.$data["Product_description"].'</td>
                    <td>'.$data["Price"].'</td>
                    <td>'.$data["Stock"].'</td>
                    <td>standerd</td>
                    <td><button class="btn btn-outline-info text-info my-2 my-sm-0" data-toggle="modal" data-target="#editProductModal">編輯</button></td>
                </tr>';
        echo $txt;
    }

    function createProductBoxForProductPage($id){ 
        $link = create_connection();  
        $sql = "SELECT * 
                FROM `Product`as P, `Product_Image`as PI 
                Where P.Product_ID = $id and P.Product_ID = PI.Product_ID ;";
        $result = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result);
        mysqli_free_result($result);
        $txt = '<div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <img class="card-img-top" src='.$data["Image_path"].' width="250" height="130" alt="LTG-BY-0001">
                        <div class="card-body">
                        <h4 class="card-title">'.$data["Product_name"].'</h4>
                        <p class="card-text">'.$data["Product_description"].'</p>
                        <h5 class="card-text text-danger">
                            NT$&nbsp;'.$data["Price"].'
                        </h5>
                        <form method="post" name="myForm" action="product_page.php">
                            <input type="hidden" name="currentProductID" value='.$id.'>
                            <input class="btn btn-outline-secondary btn-block" type="submit" value="查看商品">
                        </form>
                        <form method="post" name="myForm">
                            <input class="btn btn-outline-primary btn-block mt-2" type="submit" name="add_shopping_cart" value="加入購物車">
                            <input type="hidden" name="currentProductID" value='.$id.'>
                        </form>
                    </div>
                    </div>
                </div>';
        echo $txt;
    }
    
    function getSameCategoryProduct($category){ 
        $link = create_connection();  
        $sql = 'SELECT C.Product_ID
                FROM `Category` as C 
                Where C.Category_name = "'.$category.'";';
        $result = execute_sql($link, "DBS_project", $sql);
        $full_data = array();
        while($single_data = mysqli_fetch_array($result)) {
            //will output all data on each loop.
            array_push($full_data, $single_data); 
        };
        $num = count($full_data);
        $txt = "";
        mysqli_free_result($result);
        for($i=0;$i<$num;$i++){
            $txt .= createProductBoxForProductPage($full_data[$i][0]);
        };

        return $txt;
    }

    function getTotalProductDisplayed($page, $category)
    {
        $link = create_connection();  
        if($category != 'all')
        {
            $sql = 'SELECT count(*)
                    FROM `category` as P
                    WHERE Category_name = "'.$category.'";';
        }
        else
        {
            $sql = 'SELECT count(*)
                    FROM `category` as P;';
        }
    }
    
    function getSortedProductByPriceASC($page, $category){ 
        $link = create_connection();
        if ($category == 'all')
        {
            $sql = 'SELECT P.Product_ID
                FROM `Product` as P 
                order by P.Price ASC;';
        }
        else
        {
            $sql = 'SELECT P.Product_ID
            FROM `product` as P, `category` as C
            WHERE P.Product_ID = C.Product_ID AND C.Category_name = "'.$category.'"
            order by P.Price ASC;';
        }
        $result = execute_sql($link, "DBS_project", $sql);
        $full_data = array();
        while($single_data = mysqli_fetch_array($result)) {
            //will output all data on each loop.
            array_push($full_data, $single_data); 
        };
        $num = count($full_data);
        $txt = "";
        $product_num_each_page = 9;
        $first_index = ($page-1)*$product_num_each_page;
        if($first_index + $product_num_each_page > $num){
            $last_index = $num;
        }else{
            $last_index = $first_index + $product_num_each_page;
        }
        mysqli_free_result($result);
        for($i  = $first_index;$i < $last_index;$i++){
            $txt .= createProductBoxForProductPage($full_data[$i][0]);
        };
        return $txt;
    }

    function getSortedProductByPriceDESC($page, $category){ 
        $link = create_connection();  
        if ($category == 'all')
        {
            $sql = 'SELECT P.Product_ID
                FROM `Product` as P 
                order by P.Price DESC;';
        }
        else
        {
            $sql = 'SELECT P.Product_ID
            FROM `product` as P, `category` as C
            WHERE P.Product_ID = C.Product_ID AND C.Category_name = "'.$category.'"
            order by P.Price DESC;';
        }
        $result = execute_sql($link, "DBS_project", $sql);
        $full_data = array();
        while($single_data = mysqli_fetch_array($result)) {
            //will output all data on each loop.
            array_push($full_data, $single_data); 
        };
        $num = count($full_data);
        $txt = "";
        $product_num_each_page = 9;
        $first_index = ($page-1)*$product_num_each_page;
        if($first_index + $product_num_each_page > $num){
            $last_index = $num;
        }else{
            $last_index = $first_index + $product_num_each_page;
        }
        mysqli_free_result($result);
        for($i  = $first_index;$i < $last_index;$i++){
            $txt .= createProductBoxForProductPage($full_data[$i][0]);
        };
        return $txt;
    }
    function SearchToGetSortedProductByPriceASC($search_product,$page){ 
        $link = create_connection();  
        $sql = 'SELECT P.Product_ID 
                FROM `Product` as P 
                WHERE P.Product_Name LIKE "%'.$search_product.'%" AND LENGTH("%'.$search_product.'%")-Length(P.Product_Name)!=0;';

        $result = execute_sql($link, "DBS_project", $sql)or die( mysqli_error($link));
        $full_data = array();
        while($single_data = mysqli_fetch_array($result)) {
            //will output all data on each loop.
            array_push($full_data, $single_data);
        };
        
        $num = count($full_data);
        $txt = "";
        $product_num_each_page = $num;
        $first_index = ($page-1)*$product_num_each_page;
        $last_index = $first_index + $product_num_each_page;
        mysqli_free_result($result);
        
        for($i  = $first_index;$i < $last_index;$i++){
            
            createProductBox(($full_data[$i][0]));
        };
    }
    function getSortedProductByPublishDateASC($page, $category){ 
        $link = create_connection();  
        if ($category == 'all')
        {
            $sql = 'SELECT P.Product_ID
                FROM `Product` as P 
                order by P.Publish_date ASC;';
        }
        else
        {
            $sql = 'SELECT P.Product_ID
            FROM `product` as P, `category` as C
            WHERE P.Product_ID = C.Product_ID AND C.Category_name = "'.$category.'"
            order by P.Publish_date ASC;';
        }
        $result = execute_sql($link, "DBS_project", $sql);
        $full_data = array();
        while($single_data = mysqli_fetch_array($result)) {
            //will output all data on each loop.
            array_push($full_data, $single_data); 
        };
        $num = count($full_data);
        $txt = "";
        $product_num_each_page = 9;
        $first_index = ($page-1)*$product_num_each_page;
        if($first_index + $product_num_each_page > $num){
            $last_index = $num;
        }else{
            $last_index = $first_index + $product_num_each_page;
        }
        mysqli_free_result($result);
        for($i  = $first_index;$i < $last_index;$i++){
            $txt .= createProductBoxForProductPage($full_data[$i][0]);
        };
        return $txt;

    }
    function getSortedProductByPublishDateDESC($page, $category){ 
            $link = create_connection();  
            if ($category == 'all')
            {
                $sql = 'SELECT P.Product_ID
                    FROM `Product` as P 
                    order by P.Publish_date DESC;';
            }
            else
            {
                $sql = 'SELECT P.Product_ID
                FROM `product` as P, `category` as C
                WHERE P.Product_ID = C.Product_ID AND C.Category_name = "'.$category.'"
                order by P.Publish_date DESC;';
            }
            $result = execute_sql($link, "DBS_project", $sql);
            $full_data = array();
            while($single_data = mysqli_fetch_array($result)) {
                //will output all data on each loop.
                array_push($full_data, $single_data); 
            };
            $num = count($full_data);
            $txt = "";
            $product_num_each_page = 9;
            $first_index = ($page-1)*$product_num_each_page;
            if($first_index + $product_num_each_page > $num){
                $last_index = $num;
            }else{
                $last_index = $first_index + $product_num_each_page;
            }
            mysqli_free_result($result);
            for($i  = $first_index;$i < $last_index;$i++){
                $txt .= createProductBoxForProductPage($full_data[$i][0]);
            };
            return $txt;  
    }

    function createProduct($name,$description,$price,$stock,$standerd){ 
        $link = create_connection();  
        $sql = 'SELECT P.Product_ID
                FROM `Product` as P
                order by P.Publish_date DESC;';
        $result = execute_sql($link, "DBS_project", $sql);
        $full_data = array();
        while($single_data = mysqli_fetch_array($result)) {
            //will output all data on each loop.
            array_push($full_data, $single_data); 
        };
        $num = count($full_data);
        $txt = "";
        $product_num_each_page = 9;
        $first_index = ($page-1)*$product_num_each_page;
        if($first_index + $product_num_each_page > $num){
            $last_index = $num;
        }else{
            $last_index = $first_index + $product_num_each_page;
        }
        mysqli_free_result($result);
        for($i  = $first_index;$i < $last_index;$i++){
            $txt .= createProductBoxForProductPage($full_data[$i][0]);
        };
        return $txt;
    }

    function getSortedProductListByIdASC($page){ 
        $link = create_connection();  
        $sql = 'SELECT P.Product_ID
                FROM `Product` as P 
                order by P.Product_ID ASC;';
        $result = execute_sql($link, "DBS_project", $sql);
        $full_data = array();
        while($single_data = mysqli_fetch_array($result)) {
            //will output all data on each loop.
            array_push($full_data, $single_data);
        };

        if($page == null){
            $page = 1;
        }
        $num = count($full_data);
        $txt = "";
        $product_num_each_page = 9;
        $first_index = ($page-1)*$product_num_each_page;
        if($first_index + $product_num_each_page > $num){
            $last_index = $num;
        }else{
            $last_index = $first_index + $product_num_each_page;
        }
        mysqli_free_result($result);
        for($i = $first_index;$i < $last_index;$i++){
            if($full_data[$i][0] != null){
                $txt .= createProductList($full_data[$i][0]);
            }
        };
        return $txt;  
}

    function getCoupon($CouponID, $MemberID){ 
        $link = create_connection();  
        $sql = "SELECT *, DATE(EndDate) AS ED
                FROM `Coupon`
                Where Coupon_ID = $CouponID;";
        $result = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result);
        mysqli_free_result($result);

        if ($MemberID == "guest") 
        {           
            $txt = '<div class="col-4">
                        <div class="card h-100 mb-3">
                            <img class="card-img-top" src='.$data["Image_Path"].'width="250" height="130" alt="TG-B-0001" class="img-fluid">
                            <div class="card-body">
                                <h4 class="card-title">'.$data["Coupon_Name"].'</h4>
                                <p class="card-text text-danger">領取期限 :' .$data["ED"].'</p>
                                <a href="login.html" class="btn btn-outline-info text-info btn-block">登入以領取</a>
                            </div>
                        </div>
                    </div>';
        } else
        {  
            $sql2 = "SELECT *
                     FROM CouponList
                     Where Member_ID = $MemberID and Coupon_ID = $CouponID;";
            $result2 = execute_sql($link, "DBS_project", $sql2);
            $data2 = mysqli_fetch_array($result2);
            mysqli_free_result($result2);

            
            if ($data2 && $data2["Member_ID"]==$MemberID and $data2["Coupon_ID"]==$CouponID)
            {
                $txt = '<div class="col-4">
                            <div class="card h-100 mb-3">
                                <img class="card-img-top" src='.$data["Image_Path"].' width="250" height="130" alt="TG-B-0001" class="img-fluid">
                                <div class="card-body">
                                    <h4 class="card-title">'.$data["Coupon_Name"].'</h4>
                                    <p class="card-text text-danger">領取期限 :' .$data["ED"].'</p>
                                    <button type="button" disabled>已領取</button>
                                </div>
                            </div>
                        </div>';

            } 
            else
            {
                $txt = '<div class="col-4">
                            <div class="card h-100 mb-3">
                                <img class="card-img-top" src='.$data["Image_Path"].' alt="TG-B-0001" width="250" height="130" class="img-fluid">
                                <div class="card-body">
                                    <h4 class="card-title">'.$data["Coupon_Name"].'</h4>
                                    <p class="card-text text-danger">領取期限 :' .$data["ED"].'</p>
                                    <form method="post" name="myForm" action="getCoupon.php">
                                        <input type="hidden" name="currentCouponID" value='.$CouponID.'>
                                        <input type="hidden" name="currentMemberID" value='.$MemberID.'>
                                        <input class="btn btn-outline-secondary btn-block" type="submit" value="點擊領取">
                                    </form>
                                </div>
                            </div>
                        </div>';
                
            }
        }       
        echo $txt;
    }

    function chooseCoupon($MemberID){ 
        if ($MemberID == "guest") 
        {           
            $txt = '<select>
                        <option selected>沒有您可以使用的折價券</option>
                    </select>
                    <a href="checkout.php" class="btn btn-outline-info btn-lg float-right">前往結帳</a>';
        }
        else
        {
            $link = create_connection();  
            $sql = "SELECT Coupon_ID
                    FROM `CouponList`
                    Where Member_ID = $MemberID and Used = 'No'              
                    Order by Coupon_ID DESC;";
            $result = execute_sql($link, "DBS_project", $sql);
            $full_data = array();
            while($single_data = mysqli_fetch_array($result)) {
                //will output all data on each loop.
                array_push($full_data, $single_data); 
            };
            $num = count($full_data);
            mysqli_free_result($result);

            $txt = '<form method="post" action="checkout.php">
                    <select name="couponDiscount">
                        <option value=0 selected>請選擇你要使用的折價券</option>';
            for ($i=0; $i<$num; $i++) 
            {
                $CouponID = $full_data[$i]["Coupon_ID"];
                $sql = "SELECT *
                        FROM `Coupon`
                        Where Coupon_ID = $CouponID;";
                $result = execute_sql($link, "DBS_project", $sql);
                $data = mysqli_fetch_array($result);
                mysqli_free_result($result);

                $txt .= '   <option value='.$CouponID.'>'.$data["Coupon_Name"].'</option>';
            }
            $txt .= '</select>
                     <input type="hidden" name="currentMemberID" value='.$MemberID.'>
                     <input type="submit" class="btn btn-outline-info btn-lg float-right" value="前往結帳">
                     </form>';
        }
        echo $txt;
    }

    function getNumberOfProduct($page, $category){
        $link = create_connection();
        if ($category == 'all')
        {
            $sql = 'SELECT COUNT(*) as Num
                    FROM `Product` as P';
        }
        else
        {
            $sql = 'SELECT COUNT(*) as Num
                    FROM `category` as P
                    WHERE Category_name = "'.$category.'";';
        }
        $result = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result);
        //釋放 $result 佔用的記憶體
        mysqli_free_result($result);
        //關閉資料連接	
        mysqli_close($link);
        $num = $data[0];
        $product_num_each_page = 9;
        $num_of_pages = intval(ceil($num/$product_num_each_page));
        $first_index = ($page-1)*$product_num_each_page;
        if($first_index + $product_num_each_page > $num){
            $last_index = $num;
        }else{
            $last_index = $first_index + $product_num_each_page;
        }
        $num_of_data =
            '共'.$num_of_pages.'頁&nbsp;&nbsp;&nbsp;&nbsp;顯示'.$num.'筆結果中的'.($first_index+1).'-'.$last_index.'筆';
        echo $num_of_data;
    }

    function getPageLink($page, $category){
        $link = create_connection();
        if ($category == 'all')
        {
            $sql = 'SELECT COUNT(*) as Num
                    FROM `Product` as P';
        }
        else
        {
            $sql = 'SELECT COUNT(*) as Num
                    FROM `category` as P
                    WHERE Category_name = "'.$category.'";';
        }
        $result = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result);
        //釋放 $result 佔用的記憶體
        mysqli_free_result($result);
        //關閉資料連接	
        mysqli_close($link);
        $num = $data[0];
        $product_num_each_page = 9;
        $num_of_pages = intval(ceil($num/$product_num_each_page));
        if ($page == 1){
            $first_page = $page;
            $second_page = $page + 1;
            $third_page = $page + 2;
        }elseif ($page == $num_of_pages) {
            $first_page = $page - 2;
            $second_page = $page - 1;
            $third_page = $page;
        }else{
            $first_page = $page - 1;
            $second_page = $page;
            $third_page = $page + 1;
        }
        $page_link =
            '<div class="col-12 mt-3 mb-5">
                <nav aria-label="Page navigation product">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href=?page=1 aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                            </a>
                        </li>';
        if ($first_page > 1)
        {
            $page_link .=
                '<li class="page-item">
                    <p class="page-link" href="#">...</p>
                </li>';
        }

        if($first_page > 0 && $first_page <= $num_of_pages)
        {
            $page_link .=
                '<li class="page-item">
                    <a class="page-link" href=?page='.$first_page.'>'.$first_page.'</a>
                </li>';
        }

        if($second_page > 0 && $second_page <= $num_of_pages)
        {
            $page_link .=
                '<li class="page-item">
                    <a class="page-link" href=?page='.$second_page.'>'.$second_page.'</a>
                </li>';
        }

        if($third_page > 0 && $third_page <= $num_of_pages)
        {
            $page_link .=
                '<li class="page-item">
                    <a class="page-link" href=?page='.$third_page.'>'.$third_page.'</a>
                </li>';
        }

        if($third_page < $num_of_pages)
        {
            $page_link .=
                '<li class="page-item">
                    <p class="page-link" href="#">...</p>
                </li>';
        }

        $page_link .=
                        '<li class="page-item">
                            <a class="page-link" href=?page='.$num_of_pages.' aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>';
        echo $page_link;
    }

    function createOrderList($id){
        $link = create_connection(); 
        $sql = "SELECT * 
                FROM `Order`as O 
                Where O.Order_ID = $id;";
        $result = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result);
        mysqli_free_result($result);
        if($data["Order_status"] == 0){
            $status = '尚未出貨' ;
        } elseif($data["Order_status"] == 1){
            $status = '出貨中' ;
        } elseif($data["Order_status"] == 2){
            $status = '已送達' ;
        } else{
            $status = '發生錯誤' ;
        };
        $txt = '<tr>
                    <td>'.$data[0].'</td>
                    <td>'.$data["Order_date"].'</td>
                    <td>'.$data["Total_price"].'</td>
                    <td><button class="btn btn-outline-info text-info my-2 my-sm-0" data-toggle="modal" data-target="#OrderReceiverModal">查看</button></td>
                    <td><button class="btn btn-outline-info text-info my-2 my-sm-0" data-toggle="modal" data-target="#OrderProductModal">查看</button></td>
                    <td>'.$status.'</td>
                    </tr>';
        echo $txt;
    }

    function getOrderListByIdDESC($page,$id){ 
        $link = create_connection();  
        $sql = "SELECT O.Order_ID
                FROM `Order` as O
                Where O.Member_ID = $id
                order by O.Order_ID DESC;";
        $result = execute_sql($link, "DBS_project", $sql);
        $full_data = array();
        while($single_data = mysqli_fetch_array($result)) {
            //will output all data on each loop.
            array_push($full_data, $single_data);
        };

        if($page == null){
            $page = 1;
        }
        $num = count($full_data);
        $txt = "";
        $product_num_each_page = 9;
        $first_index = ($page-1)*$product_num_each_page;
        if($first_index + $product_num_each_page > $num){
            $last_index = $num;
        }else{
            $last_index = $first_index + $product_num_each_page;
        }
        mysqli_free_result($result);
        for($i = $first_index;$i < $last_index;$i++){
            if($full_data[$i][0] != null){
                $txt .= createOrderList($full_data[$i][0]);
            }
        };
        return $txt;  
    }
?>