<?php
require 'config.php';
if (isset($_POST['itemNo'])) {
    $itemno = $_POST['itemNo'];
    $date = $_POST['date'];
    $customerid = $_POST['customerid'];
    $quantity = $_POST['quantity'] ?? 1;
    $cartstatus = 'incart';
    $status = 'incart';

    $stmt = $conn->prepare('SELECT UnitPrice, Quantity FROM inventory WHERE ItemNo=?');
    $stmt->bind_param('i', $itemno);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();

    $unitprice = $r['UnitPrice'];
    $available = $r['Quantity'];

    if ($available === 0) {
        echo 'Limit reached';
        exit;
    }

    $available = $available - $quantity;
    $query = $conn->prepare("UPDATE inventory SET Quantity = ? 
            WHERE ItemNo = ?");
    $query->bind_param("ii", $available, $itemno);
    $query->execute();

    $stmt = $conn->prepare('SELECT TransactionID, TotalPrice FROM transactions WHERE TransactionStatus=?');
    $stmt->bind_param('s', $status);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $transactionid = $r['TransactionID'] ?? '';
    $totalprice = $r['TotalPrice'] ?? 0;
    $totalprice = $totalprice + $unitprice;

    if (!$transactionid) {
        $transactionStatus = 'incart';
        $query = $conn->prepare("INSERT INTO transactions (
            TransactionStatus, TransactionDate, TotalPrice) VALUES (?,?,?)");
        $query->bind_param("ssi", $transactionStatus, $date, $totalprice);
        $query->execute();
    } else {
        $query = $conn->prepare("UPDATE transactions SET TotalPrice = ? 
            WHERE TransactionID = ?");
        $query->bind_param("ii", $totalprice, $transactionid);
        $query->execute();
    }

    $stmt = $conn->prepare('SELECT TransactionID FROM transactions WHERE TransactionStatus=?');
    $stmt->bind_param('s', $status);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $newtransactionid = $r['TransactionID'];

    $query = $conn->prepare("INSERT INTO carts (
        CustomerID, TransactionID, ItemNo, Quantity, CartStatus) VALUES (?,?,?,?,?)");
    $query->bind_param("ssiis", $customerid, $newtransactionid, $itemno, $quantity, $cartstatus);
    $query->execute();

    echo 'Item added to cart';
}

if (isset($_POST['image'])) {
    $image = $_POST['image'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];

    $query = $conn->prepare("INSERT INTO inventory (
        Name, Category, SubCategory, UnitPrice, Quantity, Image) VALUES (?,?,?,?,?,?)");
    $query->bind_param("ssssis", $name, $category, $subcategory, $price, $quantity, $image);
    $query->execute();

    echo 'Successfully added to the cart';
}

if (isset($_GET['operation'])) {
    $operation = $_GET['operation'];

    if ($operation == 'removeAll') {
        $status = 'canceled';
        $query = $conn->prepare("UPDATE inventory SET Quantity = DEFAULT");
        $query->execute();
    } else {
        $status = 'shopped';
    }
    $incart = 'incart';

    $query = $conn->prepare("UPDATE carts SET CartStatus = ? 
                WHERE CartStatus = ?");
    $query->bind_param("ss", $status, $incart);
    $query->execute();

    $query = $conn->prepare("UPDATE transactions SET TransactionStatus = ? 
        WHERE TransactionStatus = ?");
    $query->bind_param("ss", $status, $incart);
    $query->execute();

    echo 'Successfully removed from the cart';
}

if (isset($_GET['removeItem'])) {
    $itemno = $_GET['removeItem'];
    $status = 'canceled';
    $cartstatus = 'incart';

    $query = $conn->prepare("UPDATE carts SET CartStatus = ? 
        WHERE ItemNo = ? AND CartStatus = ? LIMIT 1");
    $query->bind_param("sis", $status, $itemno, $cartstatus);
    $query->execute();

    $query = $conn->prepare("UPDATE inventory SET Quantity = Quantity + 1 
        WHERE ItemNo = ?");
    $query->bind_param("i", $itemno);
    $query->execute();

    echo 'Successfully removed from the cart';
}

if (isset($_GET['date'])) {
    $table = '<table>
                <tr>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>TransactionDate</th>
                    <th>Address</th>
                </tr><tr>';
    $date = $_GET['date'];
    $stmt = $conn->prepare('SELECT c.FirstName, c.LastName, t.TransactionDate, c.Address
                                FROM transactions t
                                INNER JOIN carts ca ON t.transactionID = ca.transactionID
                                INNER JOIN customers c ON ca.customerID = c.customerID
                                WHERE t.TransactionDate = ?
                                GROUP BY c.customerID
                                HAVING COUNT(*) > 2');
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()):
        $firstname = $row['FirstName'];
        $lastname = $row['LastName'];
        $transactiondate = $row['TransactionDate'];
        $address = $row['Address'];

        $table .= '<td>';
        $table .= $firstname;
        $table .= '</td>';
        $table .= '<td>';
        $table .= $lastname;
        $table .= '</td>';
        $table .= '<td>';
        $table .= $transactiondate;
        $table .= '</td>';
        $table .= '<td>';
        $table .= $address;
        $table .= '</td>';
        $table .= '</tr>';
    endwhile;
    $table .= '</table>';

    echo $table;
}


if (isset($_GET['zipcode'])) {
    $table = '<table>
                <tr>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>TransactionMonth</th>
                    <th>Address</th>
                </tr><tr>';
    $zipcode = $_GET['zipcode'];
    $month = $_GET['month'];
    $stmt = $conn->prepare('SELECT c.FirstName, c.LastName, t.TransactionDate, c.Address
                                FROM transactions t
                                INNER JOIN carts ca ON t.transactionID = ca.transactionID
                                INNER JOIN customers c ON ca.customerID = c.customerID
                                WHERE c.Address = ?
                                AND MONTHNAME(t.TransactionDate) = ?
                                GROUP BY c.customerID, c.Address
                                HAVING COUNT(*) > 2');
    $stmt->bind_param("ss", $zipcode, $month);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()):
        $firstname = $row['FirstName'];
        $lastname = $row['LastName'];
        $transactiondate = $month;
        $address = $row['Address'];

        $table .= '<td>';
        $table .= $firstname;
        $table .= '</td>';
        $table .= '<td>';
        $table .= $lastname;
        $table .= '</td>';
        $table .= '<td>';
        $table .= $transactiondate;
        $table .= '</td>';
        $table .= '<td>';
        $table .= $address;
        $table .= '</td>';
        $table .= '</tr>';
    endwhile;
    $table .= '</table>';

    echo $table;
}


if (isset($_GET['olderthan20'])) {
    $table = '<table>
                <tr>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>TransactionDate</th>
                    <th>Address</th>
                </tr><tr>';
    $stmt = $conn->prepare('SELECT c.FirstName, c.LastName, t.TransactionDate, c.Address
                                FROM customers c
                                INNER JOIN carts ca ON c.customerID = ca.customerID
                                INNER JOIN transactions t ON ca.transactionID = t.transactionID
                                GROUP BY c.customerID, c.age
                                HAVING c.age > 20 AND COUNT(*) > 3');
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()):
        $firstname = $row['FirstName'];
        $lastname = $row['LastName'];
        $transactiondate = $row['TransactionDate'];
        $address = $row['Address'];

        $table .= '<td>';
        $table .= $firstname;
        $table .= '</td>';
        $table .= '<td>';
        $table .= $lastname;
        $table .= '</td>';
        $table .= '<td>';
        $table .= $transactiondate;
        $table .= '</td>';
        $table .= '<td>';
        $table .= $address;
        $table .= '</td>';
        $table .= '</tr>';
    endwhile;
    $table .= '</table>';

    echo $table;
}


if (isset($_POST['unitprice'])) {
    $itemno = $_POST['itemno'];
    $quantity = $_POST['quantity'] ?? '';
    $unitprice = $_POST['unitprice'] ?? '';

    if($quantity !== "") {
        $query = $conn->prepare("UPDATE inventory SET Quantity = ?
            WHERE ItemNo = ?");
        $query->bind_param("ii", $quantity, $itemno);
        $query->execute();
    }

    if($unitprice !== "") {
        $query = $conn->prepare("UPDATE inventory SET UnitPrice = ?
            WHERE ItemNo = ?");
        $query->bind_param("ii", $unitprice, $itemno);
        $query->execute();
    }

    echo 'Successfully updated the inventory';
}


if (isset($_GET['timespan'])) {
    $table = '<table>
                <tr>
                    <th>TransactionID</th>
                    <th>TransactionStatus</th>
                    <th>TransactionDate</th>
                    <th>Cart</th>
                    <th>TotalPrice</th>
                    <th>Cancel</th>
                </tr><tr>';
    $timespan = $_GET['timespan'];
    
    if ($timespan === '3months') {
        $stmt = $conn->prepare('SELECT TransactionID, TransactionStatus, TransactionDate, TotalPrice
                                                     FROM transactions WHERE TransactionDate >= DATE_SUB(NOW(), INTERVAL 3 MONTH) ');
    } else if ($timespan === 'years') {
        $value = $_GET['value'];
        $stmt = $conn->prepare('SELECT TransactionID, TransactionStatus, TransactionDate, TotalPrice
                                                     FROM transactions WHERE YEAR(TransactionDate) = ?');
        $stmt->bind_param("s", $value);
    } else if ($timespan === 'months') {
        $value = $_GET['value'];
        $stmt = $conn->prepare('SELECT TransactionID, TransactionStatus, TransactionDate, TotalPrice
                                                     FROM transactions WHERE MONTHNAME(TransactionDate) = ?');
        $stmt->bind_param("s", $value);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()):
        $transactionid = $row['TransactionID'];
        $transactionstatus = $row['TransactionStatus'];
        $transactiondate = $row['TransactionDate'];
        $totalprice = $row['TotalPrice'];
        $table .= '<td>';
        $table .= $transactionid;
        $table .= '</td>';
        $table .= '<td>';
        $table .= $transactionstatus;
        $table .= '</td>';
        $table .= '<td>';
        $table .= $transactiondate;
        $table .= '</td>';
        $table .= '<td>';

        $stmt1 = $conn->prepare('SELECT SUM(C.Quantity) as qua, I.Name as nm
                                FROM carts as C
                                INNER JOIN inventory as I
                                ON C.ItemNo = I.ItemNo
                                WHERE C.TransactionID = ?
                                GROUP BY I.Name');
        $stmt1->bind_param("i", $transactionid);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        while ($row1 = $result1->fetch_assoc()):
            $nm = $row1['nm'];
            $qua = $row1['qua'];
            $table .= $nm;
            $table .= ' : ';
            $table .= $qua;
            $table .= '<br>';
        endwhile;
        $table .= '</td>';
        $table .= '<td>';
        $table .= $totalprice;
        $table .= '</td>';
        $table .= '<td>';
        if ($transactionstatus === 'incart') {
            $table .= '<button onclick="removeAll()">Cancel</button>';
        }
        $table .= '</td>';
        $table .= '</tr>';
    endwhile;
    $table .= '</table>';

    echo $table;
}
?>