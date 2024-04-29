<?php
    session_start();
    include "databaseconnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/signin.css">
    <link rel="icon" href="icons/signin.png">
    <title>Sign In</title>
</head>
<body>
    <div class="container">
        <h1>Sign In</h1>
        <form action="signin.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="Enter your Email">
                <div class="error" id="email-error"></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">
                <div class="error" id="password-error"></div>
            </div>
            <div class="form-group">
                <button type="submit" name="signin" id="signin">Sign In</button>
                <button type="reset">Reset</button>
            </div>
            <div class="form-group">
                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            </div>
        </form>
    </div>
    <?php 
        if (isset($_POST['signin'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['acc-num'] = $row['acc-num'];
                $_SESSION['first-name'] = $row['first-name'];
                $_SESSION['last-name'] = $row['last-name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['age'] = $row['age'];
                $_SESSION['phone'] = $row['phone'];
                $_SESSION['adress'] = $row['adress'];
                $_SESSION['password'] = $row['password'];
                header("Location: home.php");
            } else {
                echo "<div id='php-error'><p id='php-error-message'>Invalid email or password!</p></div>";
            }
        }
    ?>
    <script src="script/signin.js"></script>
</body>
</html>