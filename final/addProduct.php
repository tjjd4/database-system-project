<?php
  include_once("function.php");
  @$Product_name = $_POST["Product_name"];
  @$Product_description = $_POST["Product_description"];
  @$Category = intval($_POST["Category"]);
  @$Price = intval($_POST["Price"]);
  @$Stock = intval($_POST["Stock"]);
  @$Product_detail = $_POST["Product_detail"] ? $_POST["Product_detail"] : "詳細資訊";
  @$Product_standerd = $_POST["Product_standerd"] ? $_POST["Product_standerd"] : "產品規格";
  @$Image_path = $_POST["Image_path"];

  date_default_timezone_set("Asia/Taipei");
  require_once("dbtools.inc.php");

  switch ($Category) {
    case 1:
      $Category_name = "food_dessert";
      break;
    case 2:
      $Category_name = "tea_drink";
      break;
    case 3:
      $Category_name = "acc";
      break;
    case 4:
      $Category_name = "fruit";
      break;
    case 5:
      $Category_name = "else";
      break;
    default:
      $Category_name = "else";
      break;
  }

  $link = create_connection();
  $sql_insert_product =
    'INSERT INTO Product(`Product_name`, `Product_description`, `Price`, `Stock`, `Publish_date`, `Product_detail`, `Product_standerd`)
    Values("'.$Product_name.'", "'.$Product_description.'", '.$Price.', '.$Stock.', "'.date("Y-m-d").'", "'.$Product_detail.'", "'.$Product_standerd.'");';
  
  $sql_query = 'SELECT Product_ID from Product where Product_ID = (select last_insert_id());';

  $result_product = execute_sql($link, "DBS_project", $sql_insert_product);
  $result_query = execute_sql($link, "DBS_project", $sql_query);
  $Product_ID = $result_query["Product_ID"];
  mysqli_free_result($result_query);
  $result_image = false;
  $result_category = false;
  $result_delete = false;
  mysqli_close($link);

  echo json_encode(array(
    'result_product' => $result_product,
    'Product_ID' => $Product_ID,
    'Product_name' => $Product_name
  ));
?>