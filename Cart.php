<html>

<head>
    <link rel="stylesheet" href="myStyle.css">
    <style>
        ul,
        a {
            color: blue;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="myStyle.css">
    <script src="display.js"></script>
    <script src="cart.js"></script>
</head>

<title>
    Groceries.com
</title>

<body>
    <header>
        <div class="name">
            <h1><img class="logo" src="Images/grocery.svg" style="width:50px; border-radius: 50%;"> Groceries</h1>
        </div>
    </header>
    <div class="navbar">
        <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="Freshproducts.php">Fresh Products</a></li>
            <li><a href="Frozen.php">Frozen</a></li>
            <li><a href="Pantry.php">Pantry</a></li>
            <li><a href="Breakfast.php">Breakfast</a></li>
            <li><a href="Baking.php">Baking</a></li>
            <li><a href="Snacks.php">Snacks</a></li>
            <li><a href="Candy.php">Candy</a></li>
             
            <li><a href="Deals.php">Deals</a></li>
            <li><a href="Account.php">My-Account</a></li>
            <li><a href="About.php">About-us</a></li>
            <li><a href="Contact.php">Contact-us</a></li>
            <div class="navbar-right">
                <li><a class="active" href="Cart.php"> <i class="fa fa-shopping-cart"></i>Cart</a></li>
            </div>
        </ul>
    </div>

    <div class="bodypage">
        <div class="bodypagechild-side">
            <img src="Images/cart.png" width="400" height="400">

            <h3>
                <p>Your cart</p>
            </h3>
            <h2 id="time"></h2>
            <script>displayTime()</script>
        </div>


        <div class="bodypagechild-main" id="bodypagechild-main">

            <?php
            include 'config.php';
            $status = 'incart';
            $sum = 0;

            $stmt = $conn->prepare('SELECT ItemNo, Quantity FROM carts WHERE CartStatus=?');
            $stmt->bind_param('s', $status);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()):
                $itemno = $row['ItemNo'];
                $quantity = $row['Quantity'];

                $stmt = $conn->prepare('SELECT Name, Image, UnitPrice, Category, SubCategory FROM inventory WHERE ItemNo=?');
                $stmt->bind_param('i', $itemno);
                $stmt->execute();
                $res = $stmt->get_result();
                $r = $res->fetch_assoc();

                $unitprice = $r['UnitPrice'];
                $image = $r['Image'];
                $name = $r['Name'];
                $category = $r['Category'];
                $subcategory = $r['SubCategory'];
                $total = $quantity * $unitprice;
                $sum = $sum + $total;
                ?>
                <div class="tomatoes">
                    <div class="cart-1" id="t-image">
                        <img src="<?= 'Images/' . $image ?>" width="150" height="130">
                    </div>
                    <div class="cart-2" id="t-text">
                        <h2>
                            <?= $name ?>
                        </h2>
                    </div>
                    <div class="cart-3" id="t-price">
                        <h2>
                            <?= $quantity ?>
                        </h2>
                    </div>
                    <div class="cart-4">
                        <h2>$
                            <?= $total ?>
                        </h2>
                    </div>
                    <div class="cart-6">
                        <h4>
                            ItemNo: <?= $itemno ?><br>
                            <?= $category ?><br>
                            <?= $subcategory ?>
                        </h4>
                    </div>
                    <div class="cart-5" id="t-image">
                        <button onclick="removeOne(<?= $itemno ?>)">Remove</button>
                    </div>
                </div>

            <?php endwhile; ?>

            <div class="tomatoes" id="tomatoes">
                <div class="sn-checkout" id="t-image">
                    <button onclick="removeAll()">Remove All</button>
                </div>
                <div class="sn-checkout" id="t-text">
                    <button onclick="checkOut()">Check Out</button>
                </div>
                <div class="sn-price" id="t-price">
                    <h2>Total:</h2>
                </div>
                <div class="cart-4">
                    <h2>$
                        <?= $sum ?>
                    </h2>
                </div>
            </div>

            <div class="totalCart">
                <div class="t-image" id="t-image">
                </div>
                <div class="t-text" id="t-text">
                </div>
                <div class="sn-price" id="t-price">
                </div>
                <div class="sn-cart">
                </div>
            </div>

        </div>

        <br>
        <br>


        <div class="footer">
            <p class="message">
                First Name: Veera Venkata Sairam
                <br>
                Last Name: Dasari
                <br>
                NETId: VXD210027
                <br>
                CS 6314 001
            </p>
        </div>

    </div>

</body>

</html>