<?php
    require_once("dbtools.inc.php");
    function getProuctFomId($id){
        //建立資料連接
        $link = create_connection();
        $sql = "SELECT * FROM `Product` Where Product_ID = $id";
        $result = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result);
        mysqli_free_result($result);
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
                            <input class="btn btn-outline-primary btn-block mt-2" type="submit" value="加入購物車">
                        </form>
                    </div>
                </div>
            </div>';
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
                            <input class="btn btn-outline-primary btn-block mt-2" type="submit" value="加入購物車">
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
    
?>