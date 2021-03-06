<?php
/**
 * Including header file.
 * Contains Navbar.
 */
require_once 'header.php';
if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $wasFound = false;
    $i = 0;
    /**
     * If the cart session variable is not set or cart array is empty.
     */
    if(!isset($_SESSION['cart']) || count($_SESSION['cart']) < 1) {
        // Run if cart is empty or not set
        $_SESSION['cart'] = array(0 => array('id' => $id, 'quantity' => 1));
    } else {
        // Run if cart has at least item in it.
        foreach($_SESSION['cart'] as $eachItem) {
            $i++;
            while(list($key, $value) = each($eachItem)) {
                if($key == 'id' && $value == $id) {
                    array_splice($_SESSION['cart'], $i-1, 1, array(array('id' => $id, 'quantity' => $eachItem['quantity'] + 1)));
                    $wasFound = true;
                }
            }
        }
        if($wasFound == false) {
            array_push($_SESSION['cart'], array('id' => $id, 'quantity' => 1));
        }
    }
}

/**
 * to empty the shopping cart
 */
if(isset($_GET['emptycart']) && $_GET['emptycart'] == "true") {
    unset($_SESSION['cart']);
}

/**
 * to change item quantity
 */
if(isset($_POST['itemIndex']) && $_POST['itemIndex'] != "") {

    $itemIndex = $_POST['itemIndex'];
    $quantity = preg_replace('#[^0-9]#i','',$_POST['quantity']);
    if($quantity < 1) { $quantity = 1; }
    if($quantity == "") { $quantity = 1; }
    $i = 0;
    foreach($_SESSION['cart'] as $eachItem) {
        $i++;
        while(list($key, $value) = each($eachItem)) {
            if($key == 'id' && $value == $itemIndex) {
                array_splice($_SESSION['cart'], $i-1, 1, array(array('id' => $itemIndex, 'quantity' => $quantity)));
            }
        }
    }
}

/**
 * removing item/s from cart
 */
if(isset($_POST['arrayIndex']) && $_POST['arrayIndex']!= "") {
    $arrayIndex = $_POST['arrayIndex'];
    if(count($_SESSION['cart']) <= 1) {
        unset($_SESSION['cart']);
    } else {
        unset($_SESSION['cart']["$arrayIndex"]);
        sort($_SESSION['cart']);
        echo count($_SESSION['cart']);
    }
}

/**
 * render cart for the user to view
 */
$cartOutput = "";
$totalCart = "";
if(!isset($_SESSION['cart']) || count($_SESSION['cart']) < 1) {
    $cartOutput = '<h2 align = "center">Your shopping cart is Empty.</h2>';
} else {
    $i = 0;
    $cartOutput .= "<div class='row'>";
    $cartOutput .= "<table class='table table-bordered table-hover'>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>&nbsp;</th>
                    </tr>";
    foreach($_SESSION['cart'] as $eachItem) {
        $db = DB::getInstance();
        $item = $db->get('ss_item', array('id', '=', $eachItem['id']))->results();

        $totalPrice = $item[0]->price * $eachItem['quantity'];
        $totalCart = $totalPrice + $totalCart;

        /*setlocale(LC_MONETARY, "en_US");
        $totalPrice = money_format("%10.2n", $totalPrice);*/
        $cartOutput .= "<tr>
                            <td><img src='product-images/" . $item[0]->image ."' width='80px'></td>
                            <td><a href='item.php?id=" . $item[0]->id . "'>" . $item[0]->name ."</a></td>
                            <td>" . $item[0]->description ."</td>
                            <td>Rs. " . $item[0]->price ."</td>
                            <td>
                                <form action='cart.php' method='post'>
                                    <input type='text' onchange='this.form.submit()' name='quantity' value='" . $eachItem['quantity'] . "' maxlength='2' class='form-control'>
                                    <input type='hidden' name='itemIndex' value='" . $item[0]->id . "'>
                                </form>
                            </td>
                            <td>Rs. " . $totalPrice ."</td>
                            <td>
                                <form action='cart.php' method='post'>
                                    <input type='hidden' name='arrayIndex' value='" . $i . "'>
                                    <button type='submit' name='remove" . $item[0]->id . "' class='btn btn-danger btn-sm'>Remove</button>
                                </form>
                            </td>
                        </tr>";
        $i++;
        /*while(list($key, $value) = each($eachItem)) {$eachItem['quantity']
            $cartOutput .= "$key : $value <br>";
        }*/
    }
    $totalCart = "Rs." . $totalCart;
    $cartOutput .= "<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>" . $totalCart . "</b></td>
                            <td></td>
                        </tr>";
    $cartOutput .= "</table>";
    $cartOutput .= "</div>";
}
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8">
                <?=$cartOutput; ?>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3 col-lg-offset-1 col-md-offset-1">
                <a href='?emptycart=true' class='btn btn-sm btn-default'><span class='glyphicon glyphicon-inbox'></span> Empty Cart</a>
            </div>
        </div>
    </div>
<?php
/**
 * Include Footer file
 */
require_once 'footer.php';