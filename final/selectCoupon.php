<?php
    require_once("dbtools.inc.php");
    $Coupon_ID = $_POST["couponDiscount"];
    $Member_ID = $_POST["currentMemberID"];
    $link = create_connection();
    $sql = "UPDATE CouponList
            SET Used = 'Yes'
            WHERE Member_ID=$Member_ID and Coupon_ID=$Coupon_ID;";
    $result = execute_sql($link, "DBS_project", $sql);
?>