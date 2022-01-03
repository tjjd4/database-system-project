<?php

    function check_login()
    {
        require("dbtools.inc.php");
        if (empty($_COOKIE["passed"] || empty($_COOKIE["id"])))
        {
            echo "<script type='text/javascript'>";
            echo "alert('請登入');";
            echo "location.replace('login.html');  ";
            echo "</script>";
        }
        else
        {
            $id = (int) $_COOKIE["id"];
        }
        return $id;
    }

    function store_shopping_cart()
    {
        $id = check_login();
        $link = create_connection();

        $product_id_array = array_map('intval', explode(',', $_COOKIE["num_list"]));
        $product_amount_array = array_map('intval', explode(',', $_COOKIE["quantity_list"]));

        for ($i = 0; $i < count($product_id_array); $i++)
        {
            $product_id = $product_id_array[$i];
            $product_amount = $product_amount_array[$i];
            $sql = "UPDATE `shoppingcart` SET Product_amount = '$product_amount' WHERE (Product_ID = '$product_id' AND Member_ID = '$id');";
            $result = execute_sql($link, "DBS_project", $sql);
            if ($result)
            {
                mysqli_free_result($result);
            }
            else
            {
                mysqli_free_result($result);
                $sql = "INSERT INTO `shoppingcart` VALUES ('$id', '$product_id', '$product_amount');";
                $result = execute_sql($link, "DBS_project", $sql);
                if ($result)
                {
                    mysqli_free_result($result);
                }

                // 有問題發現
                else
                {

                }
            }
        }

    }


    function retrieve_shopping_cart() {
        
        $id = check_login();
        
        $link = create_connection();
        $sql = "SELECT Product_ID, Product_amount FROM `shoppingcart` WHERE (Member_ID = '$id');";
        $result = execute_sql($link, "DBS_project", $sql);
    
        echo(mysqli_num_rows($result));
        //  購物車沒有東西
        if (mysqli_num_rows($result) === 0)
        {
            setcookie("num_list", "");
            setcookie("name_list", "");
            setcookie("price_list", "");
            setcookie("quantity_list", "");
        }

        else
        {
            $product_id_array = array();
            $product_amount_array = arrays();
            while ($data = mysqli_fetch_array($result,MYSQLI_NUM))
            {
                $product_id_array[] = $data['Product_ID'];
                $product_amount_array[] = $data['Product_amount'];
            }
            mysqli_free_result($result);

            $product_name_array = array();
            $product_price_array = array();
            foreach($product_id_array as &$product_id)
            {
                $sql = "SELECT Product_name, Price FROM `product` WHERE (Product_ID = '$product_id');";
                $result = execute_sql($link, "DBS_project", $sql);
                $data = mysqli_fetch_array($result);
                $product_name_array[] = $data['Product_name'];
                $product_price_array[] = $data['Price'];
                mysqli_free_result($result);
            }
            setcookie("num_list", implode(",", $product_id_array));
            setcookie("quantity_list", implode(",", $product_amount_array));
            setcookie("name_list", implode(",", $product_name_array));
            setcookie("price_list", implode(",", $product_price_array));
        }
    }
    