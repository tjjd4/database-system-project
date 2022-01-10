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
  
  $sql_query = 
    'select last_insert_id();';

  $result_product = execute_sql($link, "DBS_project", $sql_insert_product);
  $result_query = execute_sql($link, "DBS_project", $sql_query);
<<<<<<< HEAD
  $Product_ID = $result_query["Product_ID"];
  mysqli_free_result($result_query);
  $result_image = false;
  $result_category = false;
  $result_delete = false;
=======
  $ID_query = mysqli_fetch_array($result_query);
  $Product_ID = $ID_query[0];
  mysqli_free_result($result_query);

  $sql_insert_category =
    'INSERT INTO Category(`Product_ID`, `Category_name`)
    Values('.$Product_ID.', "'.$Category_name.'");';
  
  $full_image_path = "./images/addProductImages/'.$Image_path.'";

  $sql_insert_image =
    'INSERT INTO Product_Image(`Product_ID`, `Image_path`)
    Values('.$Product_ID.', "./images/addProductImages/'.$Image_path.'");';
  
  $sql_delete_product =
    'DELETE FROM Product where Product_ID = '.$Product_ID.';';
  
  $result_image = false;
  $result_category = false;
  $result_delete = false;
  if ($result_product){
    $result_category = execute_sql($link, "DBS_project", $sql_insert_category);
  }
  if ($result_product){
    if ($result_category){
      if (file_exists("./images/addProductImages/$Image_path")){
        $result_image = execute_sql($link, "DBS_project", $sql_insert_image);
      }else{
        $result_delete = execute_sql($link, "DBS_project", $sql_delete_product);
      }
    }else{
      $result_delete = execute_sql($link, "DBS_project", $sql_delete_product);
    }
  }
>>>>>>> 36ba8ac92673b71b51c56d37df4a669632e51e5e
  mysqli_close($link);

  echo json_encode(array(
    'result_product' => $result_product,
    'Product_ID' => $Product_ID,
<<<<<<< HEAD
=======
    'result_image' => $result_image,
    'result_category' => $result_category,
    'result_delete' => $result_delete,
>>>>>>> 36ba8ac92673b71b51c56d37df4a669632e51e5e
    'Product_name' => $Product_name
  ));
?>