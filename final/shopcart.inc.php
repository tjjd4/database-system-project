<?php

    function remove_item_from_shopping_cart($product_id)
    {
        $id = check_login();
        $link = create_connection();
        $product_id = (int) $product_id;
        
        remove_item_from_shopping_cart_in_cookies($product_id);
        remove_item_from_shopping_cart_in_db($link, $id, $product_id);
    }

    function remove_item_from_shopping_cart_in_cookies($product_id)
    {
        $product_id_array = array_map('intval', explode(',', $_COOKIE["num_list"]));
        $product_amount_array = array_map('intval', explode(',', $_COOKIE["quantity_list"]));
        $product_name_array = explode(',', $_COOKIE["name_list"]);
        $product_price_array = array_map('intval', explode(',', $_COOKIE["price_list"]));

        for ($i = 0; $i < count($product_id_array); $i++)
        {
            if ($product_id_array[$i] == $product_id)
            {
                unset($product_id_array[$i]);
                $product_id_array = array_values($product_id_array);
                unset($product_amount_array[$i]);
                $product_amount_array =  array_values($product_amount_array);
                unset($product_name_array[$i]);
                $product_name_array =  array_values($product_name_array);
                unset($product_price_array[$i]);
                $product_price_array =  array_values($product_price_array);
            }
        }

        setcookie("num_list", implode(",", $product_id_array));
        setcookie("quantity_list", implode(",", $product_amount_array));
        setcookie("name_list", implode(",", $product_name_array));
        setcookie("price_list", implode(",", $product_price_array));
    }

    function remove_item_from_shopping_cart_in_db($link, $id, $product_id)
    {
        $sql = "DELETE FROM `shoppingcart` WHERE (Product_ID = $product_id AND Member_ID = $id);";
        $result = execute_sql($link, "DBS_project", $sql);
        // if ($result_insert)
        // {
        // }
        // // 有問題發現
        // else
        // {
        // }
    }

    function update_shopping_cart($product_id, $product_amount)
    {
        $id = check_login();
        $link = create_connection();
        $product_id = (int) $product_id;
        $product_amount = (int) $product_amount;

        update_shopping_cart_cookies($link, $id, $product_id, $product_amount);
        store_shopping_cart_in_db($link, $id, $product_id, $product_amount);
    }

    // Updates the shopping cart stored in the cookies.
    function update_shopping_cart_cookies($link, $id, $product_id, $product_amount)
    {
        $product_id = $product_id;

        $product_id_array = explode(',', $_COOKIE["num_list"]);
        $product_amount_array = explode(',', $_COOKIE["quantity_list"]);
        $product_name_array = explode(',', $_COOKIE["name_list"]);
        $product_price_array = explode(',', $_COOKIE["price_list"]);

        if (in_array("0", $product_id_array))
        {
            $key = array_search('0', $product_id_array);
            unset($product_id_array[$key]);
            $product_id_array = array_values($product_id_array);
            unset($product_amount_array[$key]);
            $product_amount_array =  array_values($product_amount_array);
            unset($product_name_array[$key]);
            $product_name_array =  array_values($product_name_array);
            unset($product_price_array[$key]);
            $product_price_array =  array_values($product_price_array);
        }

        for ($i = 0; $i < count($product_id_array); $i++)
        {
            if ($product_id_array[$i] == $product_id)
            {
                $product_amount_array[$i] = $product_amount;
                setcookie("num_list", implode(",", $product_id_array));
                setcookie("quantity_list", implode(",", $product_amount_array));
                return 0;
            }
        }

        $sql = "SELECT Product_name, Price FROM `product` WHERE (Product_ID = '$product_id');";
        $result = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result);

        array_push($product_id_array, $product_id);
        array_push($product_amount_array, $product_amount);
        array_push($product_name_array, $data['Product_name']);
        array_push($product_price_array, $data['Price']);

        setcookie("num_list", implode(",", $product_id_array));
        setcookie("quantity_list", implode(",", $product_amount_array));
        setcookie("name_list", implode(",", $product_name_array));
        setcookie("price_list", implode(",", $product_price_array));
        mysqli_free_result($result);
    }

    // Dumps a single item that into the DB.
    function store_shopping_cart_in_db($link, $id, $product_id, $product_amount)
    {
        $sql = "SELECT Product_amount FROM `shoppingcart` WHERE (Product_ID = $product_id AND Member_ID = $id);";
        $result_select = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result_select);
        if(mysqli_num_rows($result_select) === 0)
        {
            mysqli_free_result($result_select);
            $sql = "INSERT INTO `shoppingcart` VALUES ($id, $product_id, $product_amount);";
            $result_insert = execute_sql($link, "DBS_project", $sql);
            return 0;
            // if ($result_insert)
            // {
            // }
            // // 有問題發現
            // else
            // {
            // }
        }

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


    // Adds to the cart when an item is added.
    function add_shopping_cart($product_id, $product_amount)
    {
        $id = check_login();
        $link = create_connection();
        $product_id = (int) $product_id;
        $product_amount = (int) $product_amount;

        add_shopping_cart_cookies($link, $id, $product_id, $product_amount);
        add_shopping_cart_in_db($link, $id, $product_id, $product_amount);
    }

    // Updates the shopping cart stored in the cookies.
    function add_shopping_cart_cookies($link, $id, $product_id, $product_amount)
    {
        $product_id = $product_id;

        $product_id_array = explode(',', $_COOKIE["num_list"]);
        $product_amount_array = explode(',', $_COOKIE["quantity_list"]);
        $product_name_array = explode(',', $_COOKIE["name_list"]);
        $product_price_array = explode(',', $_COOKIE["price_list"]);

        if (in_array("0", $product_id_array))
        {
            $key = array_search('0', $product_id_array);
            unset($product_id_array[$key]);
            $product_id_array = array_values($product_id_array);
            unset($product_amount_array[$key]);
            $product_amount_array =  array_values($product_amount_array);
            unset($product_name_array[$key]);
            $product_name_array =  array_values($product_name_array);
            unset($product_price_array[$key]);
            $product_price_array =  array_values($product_price_array);
        }

        for ($i = 0; $i < count($product_id_array); $i++)
        {
            if ($product_id_array[$i] == $product_id)
            {
                $product_amount_array[$i] += $product_amount;
                setcookie("num_list", implode(",", $product_id_array));
                setcookie("quantity_list", implode(",", $product_amount_array));
                return 0;
            }
        }

        $sql = "SELECT Product_name, Price FROM `product` WHERE (Product_ID = '$product_id');";
        $result = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result);

        array_push($product_id_array, $product_id);
        array_push($product_amount_array, $product_amount);
        array_push($product_name_array, $data['Product_name']);
        array_push($product_price_array, $data['Price']);

        setcookie("num_list", implode(",", $product_id_array));
        setcookie("quantity_list", implode(",", $product_amount_array));
        setcookie("name_list", implode(",", $product_name_array));
        setcookie("price_list", implode(",", $product_price_array));
        mysqli_free_result($result);
    }

    // Dumps a single item that into the DB.
    function add_shopping_cart_in_db($link, $id, $product_id, $product_amount)
    {
        $sql = "SELECT Product_amount FROM `shoppingcart` WHERE (Product_ID = $product_id AND Member_ID = $id);";
        $result_select = execute_sql($link, "DBS_project", $sql);
        $data = mysqli_fetch_array($result_select);
        if(mysqli_num_rows($result_select) === 0)
        {
            $sql = "INSERT INTO `shoppingcart` VALUES ($id, $product_id, $product_amount);";
            $result_insert = execute_sql($link, "DBS_project", $sql);
            return 0;
            // if ($result_insert)
            // {
            // }
            // // 有問題發現
            // else
            // {
            // }
        }
        $product_amount = $data['Product_amount'] + $product_amount;
        mysqli_free_result($result_select);

        $sql = "UPDATE `shoppingcart` SET Product_amount = $product_amount WHERE (Product_ID = $product_id AND Member_ID = $id);";
        $result_update = execute_sql($link, "DBS_project", $sql);
        // if ($result)
        // {   
        // }
        // else
        // {                
        // }
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
            setcookie("num_list", 0);
            setcookie("name_list", 0);
            setcookie("price_list", 0);
            setcookie("quantity_list", 0);
            return 0;
        }

        
        $product_id_array = array( );
        $product_amount_array = array( );
        while ($row = mysqli_fetch_row($result)) 
        {
            array_push($product_id_array, $row[0]); // Undefined array key "Product_ID"
            array_push($product_amount_array, $row[1]); // Undefined array key "Product_amount
        }
        mysqli_free_result($result);

        $product_name_array = array();
        $product_price_array = array();
        foreach($product_id_array as &$product_id)
        {
            $sql = "SELECT Product_name, Price FROM `product` WHERE (Product_ID = '$product_id');";
            $result = execute_sql($link, "DBS_project", $sql);
            $data = mysqli_fetch_array($result);
            array_push($product_name_array, $data['Product_name']); // Trying to access array offset on value of type null
            array_push($product_price_array, $data['Price']); // Trying to access array offset on value of type null
            mysqli_free_result($result);
        }
        setcookie("num_list", implode(",", $product_id_array));
        setcookie("quantity_list", implode(",", $product_amount_array));
        setcookie("name_list", implode(",", $product_name_array));
        setcookie("price_list", implode(",", $product_price_array));
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
            store_shopping_cart_in_db($link, $id, $product_id, $product_amount);
        }
    }

    function set_url($url)
    {
        echo("<script>history.replaceState({},'','$url');</script>");
    }
