<?php
  function create_connection()
  {
<<<<<<< HEAD
    $link = mysqli_connect("localhost", "root","","dbs_project","3309")
=======
    $link = mysqli_connect("localhost", "root","")
>>>>>>> 3af3d588af7741f86653b6b37a994aa9d501d508
    //, "123456"
      or die("無法建立資料連接: " . mysqli_connect_error());
	  
    mysqli_query($link, "SET NAMES utf8");
			   	
    return $link;
  }
	
  function execute_sql($link, $database, $sql)
  {
    mysqli_select_db($link, $database)
      or die("開啟資料庫失敗: " . mysqli_error($link));
						 
    $result = mysqli_query($link, $sql);
		
    return $result;
  }
?>