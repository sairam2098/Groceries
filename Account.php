<html>

<head>
    <link rel="stylesheet" href="myStyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="myStyle.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="display.js"></script>
    <script src="cart.js"></script>
    <script src="readFile.js"></script>
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
            <li><a class="active" href="Account.php">My-Account</a></li>
            <li><a href="About.php">About-us</a></li>
            <li><a href="Contact.php">Contact-us</a></li>
            <div class="navbar-right">
                <li><a href="Cart.php"> <i class="fa fa-shopping-cart"></i>Cart</a></li>
            </div>
        </ul>
    </div>

    <div class="bodypage">
        <div class="bodypagechild-side">
            <img src="Images/account.jpg" width="400" height="400">
            <h3>
                <p>Your personal account</p>
            </h3>
            <h2 id="time"></h2>
            <script>displayTime()</script>
        </div>

        <div class="bodypagechild-main">
            <div style="display:none;" class="admin" id="admin">
                <input type="file" id="fileInput">
                <select id="dropdown">
                    <option value="XML">XML file</option>
                    <option value="JSON">JSON file</option>
                </select>
                <button onclick="readFile()">Read File</button>
                <br>
                <br>
                <table>
                    <tr>
                        <th>ItemNo</th>
                        <th>Name</th>
                        <th>UnitPrice</th>
                        <th>Quantity</th>
                    </tr>
                    <?php
                    include 'config.php';

                    $stmt = $conn->prepare('SELECT ItemNo, Name, UnitPrice, Quantity FROM inventory
                                                WHERE Quantity<3');
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()):
                        $itemno = $row['ItemNo'];
                        $name = $row['Name'];
                        $unitprice = $row['UnitPrice'];
                        $quantity = $row['Quantity'];
                        ?>
                        <tr>
                            <td>
                                <?= $itemno ?>
                            </td>
                            <td>
                                <?= $name ?>
                            </td>
                            <td>
                                <?= $unitprice ?>
                            </td>
                            <td>
                                <?= $quantity ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
                <br>
                <br>
                <input type="text" id="itemno" placeholder="ItemNo">
                <input type="text" id="quantity" placeholder="Quantity">
                <input type="text" id="unitprice" placeholder="UnitPrice">
                <button class="updateBtn">Update</button>
                <br>
                <br>
                <input type="text" id="date" placeholder="YYYY-MM-DD">
                <button class="custBtn">GetCustomers</button>
                <br>
                <br>
                <input type="text" id="zipcode" placeholder="zipcode">
                <input type="text" id="monthT" placeholder="month">
                <button class="custZipBtn">GetCustomers</button>
                <br>
                <br>
                <button class="cust20Btn">OlderThan20</button>
                <br>
                <br>
                <div id="message"></div>
            </div>
            <div style="display:none;" class="general" id="general">
                <button class="dataBtn">Three Months</button>
                <br>
                <br>
                <input type="text" id="years">
                <button class="yearBtn">Year</button>
                <br>
                <br>
                <input type="text" id="months">
                <button class="monthsBtn">Month</button>
                <br>
                <br>
                <div id="message1"></div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $(".dataBtn").click(function (e) {
                            var timespan = '3months'
                            $.ajax({
                                url: 'display.php',
                                method: 'get',
                                data: { timespan: timespan },
                                success: function (response) {
                                    $("#message1").html(response);
                                }
                            })
                        })
                        $(".yearBtn").click(function (e) {
                            var timespan = 'years';
                            var val = document.getElementById("years").value;
                            $.ajax({
                                url: 'display.php',
                                method: 'get',
                                data: { timespan: timespan, value: val },
                                success: function (response) {
                                    $("#message1").html(response);
                                }
                            })
                        })
                        $(".monthsBtn").click(function (e) {
                            var timespan = 'months';
                            var val = document.getElementById("months").value;
                            $.ajax({
                                url: 'display.php',
                                method: 'get',
                                data: { timespan: timespan, value: val },
                                success: function (response) {
                                    $("#message1").html(response);
                                }
                            })
                        })
                        $(".custBtn").click(function (e) {
                            var date = document.getElementById("date").value;
                            $.ajax({
                                url: 'display.php',
                                method: 'get',
                                data: { date: date },
                                success: function (response) {
                                    $("#message").html(response);
                                }
                            })
                        })
                        $(".custZipBtn").click(function (e) {
                            var zipcode = document.getElementById("zipcode").value;
                            var month = document.getElementById("monthT").value;
                            $.ajax({
                                url: 'display.php',
                                method: 'get',
                                data: { zipcode: zipcode, month: month },
                                success: function (response) {
                                    $("#message").html(response);
                                }
                            })
                        })
                        $(".cust20Btn").click(function (e) {
                            var olderthan20 = 'olderthan20';
                            $.ajax({
                                url: 'display.php',
                                method: 'get',
                                data: { olderthan20: olderthan20 },
                                success: function (response) {
                                    $("#message").html(response);
                                }
                            })
                        })
                        $(".updateBtn").click(function (e) {
                            var itemno = document.getElementById("itemno").value;
                            var quantity = document.getElementById("quantity").value;
                            var unitprice = document.getElementById("unitprice").value;
                            $.ajax({
                                url: 'display.php',
                                method: 'post',
                                data: { itemno: itemno, quantity: quantity, unitprice:unitprice },
                                success: function (response) {
                                    alert(response);
                                    location.reload();
                                }
                            })
                        })
                    })
                </script>
            </div>
            <script>displayScreen()</script>
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