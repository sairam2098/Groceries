<html>

<head>
    <link rel="stylesheet" href="myStyle.css">
    <style>
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="myStyle.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
            <li><a class="active" href="Home.php">Home</a></li>
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
                <li><a href="Cart.php"> <i class="fa fa-shopping-cart"></i>Cart</a></li>
            </div>
        </ul>
    </div>

    <div class="bodypage">
        <div class="bodypagechild-side">
            <img src="Images/home1.jpg" width="400" height="400">
            <h2 id="time"></h2>
            <script>displayTime()</script>
        </div>

        <div class="bodypagechild-main">
            <div class="home1">
                <div class="frh-image">
                    <a href="Freshproducts.php"><img src="Images/freshproducts.png" width="150" height="130"></a>
                    <p>Fresh Products</p>
                </div>

                <div class="fro-image">
                    <a href="Frozen.php"><img src="Images/Frozen.jpg" width="150" height="130"></a>
                    <p>Frozen Products</p>
                </div>

                <div class="brh-image">
                    <a href="Breakfast.php"><img src="Images/breakfast.jpeg" width="150" height="130"></a>
                    <p>Breakfast Products</p>
                </div>
            </div>

            <div class="home2">
                <div class="frh-image">
                    <a href="Baking.php"><img src="Images/baking.jpg" width="150" height="130"></a>
                    <p>Baking Products</p>
                </div>

                <div class="fro-image">
                    <a href="Snacks.php"><img src="Images/snacks.webp" width="150" height="130"></a>
                    <p>Snacks</p>
                </div>

                <div class="brh-image">
                    <a href="Candy.php"><img src="Images/candy.webp" width="150" height="130"></a>
                    <p>Candies</p>
                </div>
            </div>

            <div class="home3">
                <div class="frh-image">
                    <a href="Specialty.php"><img src="Images/special.webp" width="150" height="130"></a>
                    <p>Specialities</p>
                </div>

                <div class="fro-image">
                    <a href="Deals.php"><img src="Images/deals.jpg" width="150" height="130"></a>
                    <p>Deals</p>
                </div>

                <div class="brh-image">
                    <a href="Contact.php"><img src="Images/contact.webp" width="150" height="130"></a>
                    <p>Contact Us</p>
                </div>
            </div>

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