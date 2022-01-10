<?php
    include_once("dbtools.inc.php");
    @$Product_ID = $_POST["Product_ID"];

    $link = create_connection();
    $sql = "SELECT * FROM Product WHERE Product_ID = $Product_ID;";
    $sql_category = "SELECT Category_name FROM Category WHERE Product_ID = $Product_ID;";
    $result = execute_sql($link, "DBS_project", $sql);
    $data = mysqli_fetch_array($result);
    mysqli_free_result($result);
    $result = execute_sql($link, "DBS_project", $sql_category);
    $data_category = mysqli_fetch_array($result);
    mysqli_free_result($result);
    mysqli_close($link);

    switch ($data_category[0]) {
        case "food_dessert":
          $Category = 1;
          break;
        case "tea_drink":
          $Category = 2;
          break;
        case "acc":
          $Category = 3;
          break;
        case "fruit":
          $Category = 4;
          break;
        case "else":
          $Category = 5;
          break;
        default:
          $Category = 5;
          break;
      }


    echo json_encode(array(
        'Product_ID' => $data['Product_ID'],
        'Product_name' => $data['Product_name'],
        'Product_description' => $data['Product_description'],
        'Category_name' => $Category,
        'Price' => $data['Price'],
        'Stock' => $data['Stock'],
        'Product_detail' => $data['Product_detail'],
        'Product_standerd' => $data['Product_standerd']
    ));
?>