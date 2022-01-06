<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ((isset($_POST['checkout']) || isset($_POST['shopping_cart'])) && isset($_POST['currentProductID']))
        {
            include_once("shopcart.inc.php");
            $ProductID = $_POST['currentProductID'];
            $Quantity = (isset($_POST['quantity']) ? $_POST['quantity'] : 1);
            add_shopping_cart($ProductID, $Quantity);
            if(isset($_POST['checkout']))
            {
                echo "<script type='text/javascript'>";
                echo "location.replace('checkout');  ";
                echo "</script>";
            }
            if(isset($_POST['shopping_cart']))
            {
                echo "<script type='text/javascript'>";
                echo "location.replace('cart.php');  ";
                echo "</script>";
            }
        }
    }?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    </head>
    <body>
        <form method="post">
            <input type="hidden" name="currentProductID" value="<?php echo $Product_ID?>">
        </form>
        <?php
        echo "<script type='text/javascript'>";
        echo "alert('對不起， 有問題發現．');";
        echo "location.replace('javascript:history.go(-1)');  ";
        echo "</script>";
?>
</body>
</html>