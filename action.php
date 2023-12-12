<?php
require 'config.php';

if (isset($_POST['username'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $pno = 9452162379;

    // Check if username already exists
    $stmt = $conn->prepare('SELECT CustomerID FROM users WHERE UserName=?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $customer = $r['CustomerID'] ?? '';

    if(!$customer) {
        $query = $conn->prepare("INSERT INTO customers (
            FirstName, LastName, Age, PhoneNumber, Address) VALUES (?,?,?,?,?)");
        $query->bind_param("ssiis", $firstname, $lastname, $age, $pno, $email);
        $query->execute();
        
        $query = $conn->prepare("INSERT INTO users (
            UserName, Password) VALUES (?,?)");
        $query->bind_param("ss", $username, $password);
        $query->execute();
    
        echo '<div class="alert alert-success alert-dismissible mt-2">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <strong>User registered!</strong>
                            </div>';
    } else {
        echo '<div class="alert alert-success alert-dismissible mt-2">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <strong>Username already present!</strong>
                            </div>';
    }
    
}

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];

    $stmt = $conn->prepare('SELECT Password, CustomerID FROM users WHERE UserName=?');
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    
    $pass = $r['Password'] ??'';
    $customerid = $r['CustomerID'] ?? 0;

    if($password === $pass) {
        $response = array(
            'status' => 'success',
            'message'=> '<div class="alert alert-success alert-dismissible mt-2">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Login successful!</strong>
                        </div>',
            'customerid' => $customerid
        );
        header('Content-Type: application/json');

        echo json_encode($response);    
    } else {
        $response = array(
            'status' => 'failure',
            'message' => '<div class="alert alert-success alert-dismissible mt-2">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Invalid Username or Password!</strong>
                            </div>'
        );
        header('Content-Type: application/json');

        echo json_encode($response);    
    }
}

?>