<?php

    // TODO: add a function that removes items from the cart, both from cookies and DB.

    // Update the cart when an item is added.
    function update_shopping_cart($product_id, $product_amount)
    {
        $id = check_login();
        $link = create_connection();

        update_shopping_cart_cookies($link, $id, $product_id, $product_amount);
        store_shopping_cart_individually($link, $id, $product_id, $product_amount);
    }

    // Dumps all of the shopping cart, previously stored in cookies, into the DB.
    function store_shopping_cart_all()
    {
        $id = check_login();
        $link = create_connection();

        $product_id_array = array_map('intval', explode(',', $_COOKIE["num_list"]));
        $product_amount_array = array_map('intval', explode(',', $_COOKIE["quantity_list"]));

        for ($i = 0; $i < count($product_id_array); $i++)
        {
            $product_id = $product_id_array[$i];
            $product_amount = $product_amount_array[$i];
            store_shopping_cart_individually($link, $id, $product_id, $product_amount);
        }
    }

    // Updates the shopping cart stored in the cookies.
    function update_shopping_cart_cookies($link, $id, $product_id, $product_amount)
    {
        $isInCookies = false;

        $product_id_array = array_map('intval', explode(',', $_COOKIE["num_list"]));
        $product_amount_array = array_map('intval', explode(',', $_COOKIE["quantity_list"]));

        for ($i = 0; $i < count($product_id_array); $i++)
        {
            if ($product_id_array[$i] == 0)
            {
                array_splice($product_id_array, $i, 1);
                array_splice($product_amount_array, $i, 1);
            }

            if ($product_id_array[$i] == $product_id)
            {
                $product_amount_array[$i] = $product_amount;
                $isInCookies = true;
                setcookie("num_list", implode(",", $product_id_array));
                setcookie("quantity_list", implode(",", $product_amount_array));
            }
        }

        if (!$isInCookies)
        {
            $id = check_login();
            $link = create_connection();
            $sql = "SELECT Product_name, Price FROM `product` WHERE (Product_ID = '$product_id');";
            $result = execute_sql($link, "DBS_project", $sql);
            $data = mysqli_fetch_array($result);

            $product_name_array = explode(',', $_COOKIE["name_list"]);
            $product_price_array = array_map('intval', explode(',', $_COOKIE["price_list"]));

            $product_id_array[] = $product_id;
            $product_amount_array[] = $product_amount;
            $product_name_array[] = $data['Product_name'];
            $product_price_array[] = $data['Price'];

            setcookie("num_list", implode(",", $product_id_array));
            setcookie("quantity_list", implode(",", $product_amount_array));
            setcookie("name_list", implode(",", $product_name_array));
            setcookie("price_list", implode(",", $product_price_array));
            mysqli_free_result($result);   
        }
    }

    // Dumps a single item that into the DB.
    function store_shopping_cart_individually($link, $id, $product_id, $product_amount)
    {
        $sql = "SELECT Product_amount FROM `shoppingcart` WHERE (Product_ID = $product_id AND Member_ID = $id);";
        $result_select = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result_select);
        if(mysqli_num_rows($result_select) === 0)
        {
            $sql = "INSERT INTO `shoppingcart` VALUES ($id, $product_id, $product_amount);";
            $result_insert = execute_sql($link, "DBS_project", $sql);
            // if ($result_insert)
            // {
            // }
            // // 有問題發現
            // else
            // {
            // }
        }
        mysqli_free_result($result_select);

        if ($data['Product_amount'] !== $product_amount)
        {
            $sql = "UPDATE `shoppingcart` SET Product_amount = $product_amount WHERE (Product_ID = $product_id AND Member_ID = $id);";
            $result_update = execute_sql($link, "DBS_project", $sql);
            // if ($result)
            // {   
            // }
            // else
            // {                
            // }
        }
    }

    // Retrieves the shopping cart from the DB and stores it in Cookies
    function retrieve_shopping_cart()
    {
        
        $id = check_login();
        
        $link = create_connection();
        $sql = "SELECT Product_ID, Product_amount FROM `shoppingcart` WHERE (Member_ID = '$id');";
        $result = execute_sql($link, "DBS_project", $sql);
    
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

    // Checks login to give $id.
    function check_login()
    {
        require_once("dbtools.inc.php");
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
    
    function retrieve_image_path_from_db($product_id)
    {
        if (empty($_COOKIE["id"]))
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

        require_once("dbtools.inc.php");
        $link = create_connection();
        $sql = "SELECT Image_path FROM `product_image` WHERE (Product_id = '$product_id') ORDER BY Image_ID ASC LIMIT 1;";
        $result = execute_sql($link, "DBS_project", $sql);
        if (mysqli_num_rows($result) === 0)
        {
            return "./images/product/".$product_id.".png";
        }
        $data = mysqli_fetch_array($result);
        return $data['Image_path'];
    }
