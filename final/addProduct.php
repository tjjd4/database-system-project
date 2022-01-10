<?php
  $Product_name = $_POST["Product_name"];
  $Product_description = $_POST["Product_description"];
  $Price = $_POST["Price"];
  $Stock = $_POST["Stock"];
  $Product_detail = $_POST["Product_detail"];
  $Product_standerd = $_POST["Product_standerd"];

  date_default_timezone_set("Asia/Taipei");
  $link = create_connection();
  $sql =
    "INSERT INTO Product(Product_name, Product_description, Price, Stock, Publish_date, Product_detail, Product_standerd)
    Values($Product_name, $Product_description, $Price, $Stock, ".date().", $Product_detail, $Product_standerd)";
  $result = execute_sql($link, "DBS_project", $sql);
  
  if ($result == true){
      alert("Product created successfully");
  }else{
      alert("Error");
  }
  //釋放 $result 佔用的記憶體
  mysqli_free_result($result);
  //關閉資料連接	
  mysqli_close($link);
  header("Location:main.php");
?>