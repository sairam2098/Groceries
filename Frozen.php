<html>

<head>
    <link rel="stylesheet" href="myStyle.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="myStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script> 
    <style>
        ul,
        a {
            color: blue;
        }
    </style>
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
            <li><a class="active" href="Frozen.php">Frozen</a></li>
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
                <li><a href="Cart.php"> <i class="fa fa-shopping-cart"></i>Cart</a></li>
            </div>
        </ul>
    </div>

    <div class="bodypage">
        <div class="bodypagechild-side">
            <img src="Images/Frozen.jpg" width="400" height="400">
            <h3>
                <p>Easy to cook products</p>
            </h3>
            <h2 id="time"></h2>
            <script>displayTime()</script>
        </div>

        
        <div class="bodypagechild-Frozen" id="bodypagechild-Frozen">
        </div>

        
        <div class="bodypagechild-bf" id="bodypagechild-bf">
        <?php
                include 'config.php';
                $category = 'Frozen Product';
                $subcategory = 'Frozen BF';

                $stmt = $conn->prepare('SELECT ItemNo, Name, UnitPrice, Quantity, Image FROM inventory WHERE Category=? AND SubCategory=?');
                $stmt->bind_param('ss', $category, $subcategory);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()):
            ?>

            <div class="tomatoes" id="prod-0">
                <div class="t-image" id="t-image">
                    <img src="<?= 'Images/'.$row['Image'] ?>" width="150" height="130">
                </div>
                <div class="t-text" id="t-text">
                    <h2><?=$row['Name']?></h2>
                </div>
                <div class="sn-price" id="t-price">
                    <h2>$<?=$row['UnitPrice']?></h2>
                </div>
                <div class="sn-cart">
                    <button onclick="addOnceToCart(<?=$row['ItemNo']?>)" style="display: inline;" id="tomatoes-qua-AddToCart">Add to cart</button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <div class="bodypagechild-dessert" id="bodypagechild-dessert">
        <?php
                include 'config.php';
                $category = 'Frozen Product';
                $subcategory = 'Frozen Dessert';

                $stmt = $conn->prepare('SELECT ItemNo, Name, UnitPrice, Quantity, Image FROM inventory WHERE Category=? AND SubCategory=?');
                $stmt->bind_param('ss', $category, $subcategory);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()):
            ?>

            <div class="tomatoes" id="prod-0">
                <div class="t-image" id="t-image">
                    <img src="<?= 'Images/'.$row['Image'] ?>" width="150" height="130">
                </div>
                <div class="t-text" id="t-text">
                    <h2><?=$row['Name']?></h2>
                </div>
                <div class="sn-price" id="t-price">
                    <h2>$<?=$row['UnitPrice']?></h2>
                </div>
                <div class="sn-cart">
                    <button onclick="addOnceToCart(<?=$row['ItemNo']?>)" style="display: inline;" id="tomatoes-qua-AddToCart">Add to cart</button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
 
        <div class="bodypagechild-pizza" id="bodypagechild-pizza">
        <?php
                include 'config.php';
                $category = 'Frozen Product';
                $subcategory = 'Frozen Pizza';

                $stmt = $conn->prepare('SELECT ItemNo, Name, UnitPrice, Quantity, Image FROM inventory WHERE Category=? AND SubCategory=?');
                $stmt->bind_param('ss', $category, $subcategory);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()):
            ?>

            <div class="tomatoes" id="prod-0">
                <div class="t-image" id="t-image">
                    <img src="<?= 'Images/'.$row['Image'] ?>" width="150" height="130">
                </div>
                <div class="t-text" id="t-text">
                    <h2><?=$row['Name']?></h2>
                </div>
                <div class="sn-price" id="t-price">
                    <h2>$<?=$row['UnitPrice']?></h2>
                </div>
                <div class="sn-cart">
                    <button onclick="addOnceToCart(<?=$row['ItemNo']?>)" style="display: inline;" id="tomatoes-qua-AddToCart">Add to cart</button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <div class="bodypagechild-snacks" id="bodypagechild-snacks">
        <?php
                include 'config.php';
                $category = 'Frozen Product';
                $subcategory = 'Frozen Snacks';

                $stmt = $conn->prepare('SELECT ItemNo, Name, UnitPrice, Quantity, Image FROM inventory WHERE Category=? AND SubCategory=?');
                $stmt->bind_param('ss', $category, $subcategory);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()):
            ?>

            <div class="tomatoes" id="prod-0">
                <div class="t-image" id="t-image">
                    <img src="<?= 'Images/'.$row['Image'] ?>" width="150" height="130">
                </div>
                <div class="t-text" id="t-text">
                    <h2><?=$row['Name']?></h2>
                </div>
                <div class="sn-price" id="t-price">
                    <h2>$<?=$row['UnitPrice']?></h2>
                </div>
                <div class="sn-cart">
                    <button onclick="addOnceToCart(<?=$row['ItemNo']?>)" style="display: inline;" id="tomatoes-qua-AddToCart">Add to cart</button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>



        <div class="bodypagechild-main" id="bodypagechild-main">
            <a href="#" onclick="javascript:displayAllItems('.bodypagechild-Frozen', '.bodypagechild-bf', '.bodypagechild-dessert', '.bodypagechild-pizza', '.bodypagechild-snacks')">
                <div class="tomatoes">
                    <div class="t-image">
                        <img src="Images/Frozen.jpg" width="150" height="130">
                    </div>
                    <div class="t-text">
                        <h2>All Breakfast</h2>
                    </div>
                </div>
            </a>

            <a href="#" onclick="javascript:displayBF()">
                <div class="tomatoes">
                    <div class="t-image">
                        <img src="Images/frozenbf.webp" width="150" height="130">
                    </div>
                    <div class="t-text">
                        <h2>Frozen Breakfast</h2>
                    </div>
                </div>
            </a>

            <a href="#" onclick="javascript:displayDessert()">
                <div class="potatoes">
                    <div class="p-image">
                        <img src="Images/frozendessert.webp" width="150" height="130">
                    </div>
                    <div class="p-text">
                        <h2>Fresh Desserts</h2>
                    </div>
                </div>
            </a>

            <a href="#" onclick="javascript:displayPizza()">
                <div class="cilantro">
                    <div class="c-image">
                        <img src="Images/frozenpizza.jpg" width="150" height="130">
                    </div>
                    <div class="c-text">
                        <h2>Frozen Pizza</h2>
                    </div>
                </div>
            </a>

            <a href="#" onclick="javascript:displaySnacks()">
                <div class="cilantro">
                    <div class="c-image">
                        <img src="Images/frozensnacks.png" width="150" height="130">
                    </div>
                    <div class="c-text">
                        <h2>Frozen Snacks</h2>
                    </div>
                </div>
            </a>
        </div>

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