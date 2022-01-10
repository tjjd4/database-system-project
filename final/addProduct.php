<?php
  include_once("function.php");
  @$Product_name = $_POST["Product_name"];
  @$Product_description = $_POST["Product_description"];
  @$Price = intval($_POST["Price"]);
  @$Stock = intval($_POST["Stock"]);
  @$Product_detail ? "詳細資訊" : $_POST["Product_detail"];
  @$Product_standerd ? "產品規格" : $_POST["Product_standerd"];
  @$Image_path = $_POST["Image_path"];

  date_default_timezone_set("Asia/Taipei");
  $link = create_connection();
  $sql_insert_product =
    'INSERT INTO Product(`Product_name`, `Product_description`, `Price`, `Stock`, `Publish_date`, `Product_detail`, `Product_standerd`)
    Values("'.$Product_name.'", "'.$Product_description.'", '.$Price.', '.$Stock.', "'.date("Y-m-d").'", "'.$Product_detail.'", "'.$Product_standerd.'");';
  $sql_insert_image =
    'INSERT INTO Product_Image(`Product_ID`, `Image_path`)
    Values((select last_insert_id()), "'.$Image_path.'");';
  $sql_delete_product =
    'DELETE FROM Product where Product_ID = (select last_insert_id())';
  $result_product = execute_sql($link, "DBS_project", $sql_insert_product);
  $result_image = false;
  $result_delete = false;
  if ($result_product){
    $result_image = execute_sql($link, "DBS_project", $sql_insert_image);
  }
  if ($result_image){
    $result_delete = execute_sql($link, "DBS_project", $sql_delete_product);
  }
  //關閉資料連接	
  mysqli_close($link);
  echo json_encode(array(
    'result_product' => $result_product,
    'result_image' => $result_image,
    'result_delete' => $result_delete,
    'Product_name' => $Product_name
  ));
?>