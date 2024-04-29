<?php
    session_start();
    include "databaseconnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/signup.css">
    <link rel="icon" href="icons/signup.png">
    <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <form action="signup.php" method="post" >
            <div class="form-group">
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first-name" placeholder="Type in your first-name">
                <div class="error" id="first-name-error"></div>
            </div>
            <div class="form-group">
                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last-name" placeholder="Type in your last-name">
                <div class="error" id="last-name-error"></div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="Type in your e-mail">
                <div class="error" id="email-error"></div>
            </div>
            <div class="form-group">
                <label for="birthday">Age:</label>
                <input type="number" id="age" name="age">
                <div class="error" id="age-error"></div>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" placeholder="Type in your phone number">
                <div class="error" id="phone-error"></div>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Type in your address">
                <div class="error" id="address-error"></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="type in your password">
                <div class="error" id="password-error"></div>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="confirm your password">
                <div class="error" id="confirm-password-error"></div>
            </div>
            <div class="form-group">
                <button type="submit" name="signup" id="sign-up">Sign Up</button>
                <button type="reset">Reset</button>
            </div>
            <div class="form-group">
                <p>Already have an account? <a href="signin.php">Sign In</a></p>
            </div>
        </form>
    </div>
    <?php 
        if (isset($_POST['signup'])) {
            $first_name = $_POST['first-name'];
            $last_name = $_POST['last-name'];
            $email = $_POST['email'];
            $age = $_POST['age'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $password = $_POST['password'];
            $sql = "INSERT INTO users VALUES (null,'$first_name','$last_name', '$email', $age, '$phone', '$address', '$password')"; 
            if ($conn->query($sql) === TRUE){
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
                header("Location: home.php");}
            }else{
                echo "<div id='php-error'><p id='php-error-message'>Error Lors l'insertion des données</p></div>";
            }
            }
    ?>
    <script src="script/signup.js"></script>
</body>
</html>