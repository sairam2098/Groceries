<html>

<head>
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
            <li><a class="active" href="About.php">About-us</a></li>
            <li><a href="Contact.php">Contact-us</a></li>
            <div class="navbar-right">
                <li><a href="Cart.php"> <i class="fa fa-shopping-cart"></i>Cart</a></li>
            </div>
        </ul>
    </div>

    <div class="bodypage">
        <div class="bodypagechild-side">
            <img src="Images/about.jpg" width="400" height="400">
            <h3>
                <p>About us</p>
            </h3>
            <h2 id="time"></h2>
            <script>displayTime()</script>
        </div>

        <div id="aboutmain" class="bodypagechild-main">
            <h1 style="font-style: italic;"><strong>About us</strong></h1>
            <p>Welcome to <em>'Groceries.com'</em>, your affordable online one-stop shop offering a wide range of
                products
                across various categories such as groceries, fresh produce, candies, snacks, all conveniently delivered
                to your doorstep.</p>

            <p>Discover over <em>5,000</em> items at prices consistently lower than traditional retail stores every day!
            </p>

            <h4>Our speciality products include:</h4>
            <ul>
                <li>Croissants</li>
                <li>Cup Cakes</li>
                <li>Almond Butter</li>
            </ul>

            <h4>Our deals include:</h4>
            <dl>
                <dt>Candies:</dt>
                <dd>Snickers</dd>
                <dt>Specialities:</dt>
                <dd>Croissants</dd>
            </dl>
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