<?php
  include_once("function.php");
  @$Product_ID = $_POST["Product_ID"];
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
  $sql_update_product =
    'UPDATE Product SET `Product_name`="'.$Product_name.'", `Product_description`="'.$Product_description.'", `Price`='.$Price.', `Stock`='.$Stock.', `Modified_date`="'.date("y-m-d").'", `Product_detail`="'.$Product_detail.'", `Product_standerd`="'.$Product_standerd.'" where Product_ID = '.$Product_ID.';';
  $sql_update_category =
    'UPDATE Category SET `Category_name`="'.$Category_name.'" where Product_ID = '.$Product_ID.';';

  $full_image_path = "./images/addProductImages/'.$Image_path.'";
  $sql_insert_image =
    'INSERT INTO Product_Image(`Product_ID`, `Image_path`)
    Values('.$Product_ID.', "./images/addProductImages/'.$Image_path.'");';

  $result_product = execute_sql($link, "DBS_project", $sql_update_product);
  $result_category = execute_sql($link, "DBS_project", $sql_update_category);
  $result_image = false;
  $image_update = false;
  if($result_product){
    if ($Image_path){
      if (file_exists("./images/addProductImages/$Image_path")){
        $result_image = execute_sql($link, "DBS_project", $sql_insert_image);
        $image_update = true;
      }
    }
  }

//   關閉資料連接	
  mysqli_close($link);
  echo json_encode(array(
    'result_product' => $result_product,
    'result_image' => $result_image,
    'result_category' => $result_category,
    'image_update' => $image_update,
    'Product_name' => $Product_name
  ));
?>