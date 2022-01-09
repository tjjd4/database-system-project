<?php

    function remove_item_from_shopping_cart($product_id)
    {
        $id = check_login();
        $link = create_connection();
        $product_id = (int) $product_id;

        remove_item_from_shopping_cart_in_db($link, $id, $product_id);
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

        store_shopping_cart_in_db($link, $id, $product_id, $product_amount);
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

        add_shopping_cart_in_db($link, $id, $product_id, $product_amount);
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

    function clear_shopping_cart()
    {
        $id = check_login();
        $link = create_connection();
        $sql = "SELECT Product_ID FROM `shoppingcart` WHERE (Member_ID = '$id');";
        $result = execute_sql($link, "DBS_project", $sql);
    
        //  購物車沒有東西
        if (mysqli_num_rows($result) === 0)
        {
            return 0;
        }

        $product_id_array = array();
        while ($row = mysqli_fetch_row($result)) 
        {
            array_push($product_id_array, $row[0]);
        }
        mysqli_free_result($result);

        for($i = 0; $i < sizeof($product_id_array); $i++)
        {
            remove_item_from_shopping_cart($product_id_array[$i]);
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
            return 0;
        }

        
        $product_id_array = array( );
        $product_amount_array = array( );
        while ($row = mysqli_fetch_row($result)) 
        {
            array_push($product_id_array, $row[0]);
            array_push($product_amount_array, $row[1]);
        }
        mysqli_free_result($result);

        $shoppingCartArray = array();
        for($i = 0; $i < sizeof($product_id_array); $i++)
        {
            $product_id = $product_id_array[$i];
            $sql = "SELECT Product_name, Price FROM `product` WHERE (Product_ID = '$product_id');";
            $result = execute_sql($link, "DBS_project", $sql);
            $data = mysqli_fetch_array($result);

            $productArray = array($product_id, $data['Product_name'], $data['Price'], $product_amount_array[$i]);
            array_push($shoppingCartArray, $productArray);
            mysqli_free_result($result);
        }

        return $shoppingCartArray;
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

    function set_url($url)
    {
        echo("<script>history.replaceState({},'','$url');</script>");
    }
