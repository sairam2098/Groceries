<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }
    </style>
    <script src="login.js"></script>
</head>

<body>

    <div class="container">
        <div id="message"></div>
        <div class="login-container">
            <form id="loginForm" class="form-login">
                <h2 class="text-center mb-4">Login</h2>
                <div class="form-group">
                    <label for="loginUsername">Username</label>
                    <input type="text" class="form-control login-username" id="loginUsername"
                        placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" class="form-control login-password" id="loginPassword"
                        placeholder="Enter password">
                </div>
                <button type="submit" class="btn btn-primary btn-block loginBtn">Login</button>
                <p class="text-center mt-3 mb-0 switch-form">Don't have an account? <a href="#"
                        onclick="toggleForm()">Register</a></p>
            </form>
            <form id="registerForm" class="form-submit" style="display: none;">
                <h2 class="text-center mb-4">Register</h2>
                <div class="form-group">
                    <label for="registerUsername">Username</label>
                    <input type="text" class="form-control register-username" id="registerUsername"
                        placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="registerPassword">Password</label>
                    <input type="password" class="form-control register-password" id="registerPassword"
                        placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="registerPasswordVerify">Password</label>
                    <input type="password" class="form-control register-password-verify" id="registerPasswordVerify"
                        placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="registerFirstname">FirstName</label>
                    <input type="text" class="form-control register-firstname" id="registerFirstname"
                        placeholder="Enter FirstName">
                </div>
                <div class="form-group">
                    <label for="registerLastName">LastName</label>
                    <input type="text" class="form-control register-lastname" id="registerLastName"
                        placeholder="Enter LastName">
                </div>
                <div class="form-group">
                    <label for="registerDateOfBirth">DateOfBirth</label>
                    <input type="text" class="form-control register-dob" id="registerDateOfBirth"
                        placeholder="MM-DD-YYYY">
                </div>
                <div class="form-group">
                    <label for="registerZipCode">ZipCode</label>
                    <input type="text" class="form-control register-zipcode" id="registerZipCode"
                        placeholder="Enter ZipCode">
                </div>
                <div class="form-group">
                    <label for="registerEmail">Email</label>
                    <input type="email" class="form-control register-email" id="registerEmail"
                        placeholder="Enter Email">
                </div>
                <button type="submit" class="btn btn-primary btn-block addItemBtn">Register</button>
                <p class="text-center mt-3 mb-0 switch-form">Already have an account? <a href="#"
                        onclick="toggleForm()">Login</a></p>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="login.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".addItemBtn").click(function (e) {
                e.preventDefault();
                var $form = $(this).closest(".form-submit");
                var username = $form.find(".register-username").val();
                var password = $form.find(".register-password").val();
                var passwordVerify = $form.find(".register-password-verify").val();
                var firstname = $form.find(".register-firstname").val();
                var lastname = $form.find(".register-lastname").val();
                var dob = $form.find(".register-dob").val();
                var email = $form.find(".register-zipcode").val();
                var emailInput = $form.find(".register-email").val();
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

                if (!emailRegex.test(emailInput)) {
                    alert("Email is not valid!");
                    return;
                }

                if (password != passwordVerify) {
                    alert('Passwords must be same!');
                    return;
                }

                if (password.length < 8) {
                    alert('Passwords must be atleast 8 characters!');
                    return;
                }

                if (!testDate(dob)) {
                    alert('Date of birth is in incorrect format!');
                    return;
                }

                var age = calculateAge(dob);

                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: { username: username, password: password, firstname: firstname, lastname: lastname, age: age, email: email },
                    success: function (response) {
                        $("#message").html(response);
                    }
                })
            })

            $(".loginBtn").click(function (e) {
                e.preventDefault();
                var $form = $(this).closest(".form-login");
                var username = $form.find(".login-username").val();
                var password = $form.find(".login-password").val();
                $.ajax({
                    url: 'action.php',
                    method: 'get',
                    data: { username: username, password: password },
                    success: function (response) {
                        if (response['status'] === 'success') {
                            localStorage.setItem('username', username)
                            localStorage.setItem('customerid', response['customerid'])
                            $("#message").html(response['message']);
                            window.location.href = 'Home.php';
                        } else {
                            $("#message").html(response['message']);
                        }
                    }
                })
            })
        })


    </script>

</body>

</html>