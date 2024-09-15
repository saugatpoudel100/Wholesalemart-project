<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("location: ./index.php");
}
if (isset($_GET['error'])) {
    $error = $_GET['error'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WHOLESALE-MART</title>
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/assets/css/register_login.css">
    <script src="https://kit.fontawesome.com/7b39153ed3.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container" id="container">


        <!-- sign Up form section start-->
        <div class="form sign_up">
            <div class="title d-flex justify-content-center mx-0">
                <h2><a href="./register_login.php">WHOLESALE-MART</a></h2>
            </div>
            <div class="sign-up-form">
                <form action="./Controller/register.php" method="post" enctype="multipart/form-data"
                    onsubmit=" return passCheck()">
                    <!-- heading -->
                    <h1>Create An Account</h1>

                    <!-- input fields start -->
                    <input type="text" placeholder="First Name" name="f_name" required>
                    <input type="text" placeholder="Last Name" name="l_name" required>
                    <input type="email" placeholder="Email" name="email" required>
                    <input type="tel" placeholder="Phone" pattern="[0-9]{10}" name="phone_no" required>
                    <input type="password" placeholder="Password" name="password" id="Password" required value="">
                    <span id="message" style="color: red;"></span>
                    <input type="password" placeholder="Confirm password" name="Re-Password" id="Re-Password" required
                        value="">
                    <div class="selec d-flex">
                        <div class="d-flex col-md-4 offset-1">
                            <label id="acc_type">Account Type</label>
                        </div>
                        <div class="d-flex col-md-5 offset-3">
                            <input type="radio" id="Dealer" value="Dealer" name="acc_type">
                            <label for="Dealer">Dealer</label>
                        </div>
                        <div class="d-flex col-md-5 offset-3">
                            <input type="radio" id="Retailer" value="Retailer" name="acc_type">
                            <label for="Retailer">Retailer</label>
                        </div>
                    </div>
                    <input type="text" placeholder="Address" name="address" required>
                    <input type="text" placeholder="Store Name" name="store_name" required>
                    <input type="file" name="image" accept="image/*" required>
                    <button type="submit">Create Account</button>

                    <!-- input fields end -->
                </form>
            </div>
        </div>
        <!-- sign Up form section end-->

        <!-- sign in form section start-->
        <div class="form sign_in">
            <div class="title d-flex justify-content-center mx-0">
                <h2><a href="./register_login.php">WHOLESALE-MART</a></h2>
            </div>
            <div class="sign-in-form justify-content-center">
                <?php if (isset($_SESSION['msg'])) { ?>
                    <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible fade show" role="alert"
                        style="z-index:999; ">
                        <?= $_SESSION['msg'] ?>
                    </div>
                    <?php
                    unset($_SESSION['msg']);
                    unset($_SESSION['msg_type']);
                }

                ?>
                <form action="./Controller/login.php" method="post">
                    <!-- heading -->
                    <h1>Login</h1>
                    <span>Login In with your Account</span>

                    <!-- input fields start -->
                    <input type="email" placeholder="Email" name="email">
                    <input type="password" placeholder="Password" name="password">
                    <span>Forgot your <span class="forgot">password?</span></span>
                    <button type="submit">Login</button>
                    <!-- input fields end -->
                </form>
            </div>
        </div>
        <!-- sign in form section end-->

        <!-- overlay section start-->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-pannel overlay-left">
                    <h1>Already have an account?</h1>
                    <p>Please Login</p>
                    <button id="signIn" class="overBtn">Login</button>
                </div>
                <div class="overlay-pannel overlay-right">
                    <h1>Create Account</h1>
                    <p>Start Your Journey with Us</p>
                    <button id="signUp" class="overBtn">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const signUpBUtton = document.getElementById("signUp");
        const signInBUtton = document.getElementById("signIn");
        const container = document.getElementById("container");

        // switch between login and signup

        signUpBUtton.addEventListener("click", () => {
            container.classList.add("right-panel-active");
        });

        signInBUtton.addEventListener("click", () => [
            container.classList.remove("right-panel-active")
        ]);

        function passCheck() {
            let password = document.getElementById("Password").value;
            let confirmPassword = document.getElementById("Re-Password").value;

            if (password != confirmPassword) {
                document.getElementById("message").innerHTML = "Passwords do not match!";
                return false;
            } else if (password == confirmPassword) {
                document.getElementById("message").innerHTML = "";
                return true;
            }


        }
    </script>
</body>

</html>