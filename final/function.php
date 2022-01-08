<?php
    require_once("dbtools.inc.php");
    function getProuctFromId($id){
        //建立資料連接
        $link = create_connection();
        $sql = "SELECT * FROM `Product` Where Product_ID = $id";
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
                <div href="#" class="card mb-3">
                    <!-- <img class="card-img-top" src='.$data["Image_path"].' alt="LTG-BY-0001"> -->
                    <img class="card-img-top" src='.$data["Image_path"].' alt="LTG-BY-0001">
                    <div class="card-body">
                        <h4 class="card-title">'.$data["Product_name"].'</h4>
                        <p class="card-text">'.$data["Product_descripition"].'</p>
                        <h5 class="card-text text-danger">
                            NT$&nbsp;'.$data["Price"].'
                        </h5>
                        <form method="post" name="myForm" action="product_page.php">
                            <input type="hidden" name="currentProductID" value='.$id.'>
                            <input class="btn btn-outline-secondary btn-block" type="submit" value="查看商品">
                        </form>
                        <form method="post" name="myForm">
                            <input class="btn btn-outline-primary btn-block mt-2" type="submit" onclick="update_shopping_cart($id, 1)" value="加入購物車">
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
                    <td>'.$data[0].'</td>
                    <td>'.$data[1].'</td>
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
                    <div class="card">
                        <img class="card-img-top" src='.$data["Image_path"].' alt="LTG-BY-0001">
                        <div class="card-body">
                        <h4 class="card-title">'.$data["Product_name"].'</h4>
                        <p class="card-text">'.$data["Product_descripition"].'</p>
                        <h5 class="card-text text-danger">
                            NT$&nbsp;'.$data["Price"].'
                        </h5>
                        <form method="post" name="myForm" action="product_page.php">
                            <input type="hidden" name="currentProductID" value='.$id.'>
                            <input class="btn btn-outline-secondary btn-block" type="submit" value="查看商品">
                        </form>
                        <form method="post" name="myForm">
                            <input class="btn btn-outline-primary btn-block mt-2" type="submit" onclick="update_shopping_cart($id, 1)" value="加入購物車">
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
    
    function getSortedProductByPriceASC($page){ 
        $link = create_connection();  
        $sql = 'SELECT P.Product_ID
                FROM `Product` as P 
                order by P.Price ASC;';
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
        $last_index = $first_index + $product_num_each_page;
        mysqli_free_result($result);
        for($i  = $first_index;$i < $last_index;$i++){
            $txt .= createProductBoxForProductPage($full_data[$i][0]);
        };
        return $txt;
    }

    function getSortedProductByPriceDESC($page){ 
        $link = create_connection();  
        $sql = 'SELECT P.Product_ID
                FROM `Product` as P 
                order by P.Price DESC;';
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
        $last_index = $first_index + $product_num_each_page;
        mysqli_free_result($result);
        for($i  = $first_index;$i < $last_index;$i++){
            $txt .= createProductBoxForProductPage($full_data[$i][0]);
        };
        return $txt;
    }

    function getSortedProductByPublishDateASC($page){ 
        $link = create_connection();  
        $sql = 'SELECT P.Product_ID
                FROM `Product` as P
                order by P.Publish_date ASC;';
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
        $last_index = $first_index + $product_num_each_page;
        mysqli_free_result($result);
        for($i  = $first_index;$i < $last_index;$i++){
            $txt .= createProductBoxForProductPage($full_data[$i][0]);
        };
        return $txt;

    }
    function getSortedProductByPublishDateDESC($page){ 
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
            $last_index = $first_index + $product_num_each_page;
            mysqli_free_result($result);
            for($i  = $first_index;$i < $last_index;$i++){
                $txt .= createProductBoxForProductPage($full_data[$i][0]);
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
                        <div class="card mb-3">
                            <img class="card-img-top" src='.$data["Image_Path"].' alt="TG-B-0001" class="img-fluid">
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
                            <div class="card mb-3">
                                <img class="card-img-top" src='.$data["Image_Path"].' alt="TG-B-0001" class="img-fluid">
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
                            <div class="card mb-3">
                                <img class="card-img-top" src='.$data["Image_Path"].' alt="TG-B-0001" class="img-fluid">
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

    function getSortedProductListByIdASC($page){ 
        $link = create_connection();  
        $sql = 'SELECT P.Product_ID
                FROM `Product` as P 
                order by P.id ASC;';
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
        $last_index = $first_index + $product_num_each_page;
        mysqli_free_result($result);
        for($i  = $first_index;$i < $last_index;$i++){
            $txt .= createProductList($full_data[$i][0]);
        };
        echo $txt;
    }

?>