<?php
    session_start();
    include "databaseconnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/home.css">
    <link rel="icon" href="icons/bank.png">
    <title>Home</title>
</head>
<body>
    <nav>
        <a id="dashboard">Dashboard</a>
        <a id="deposit">Deposit</a>
        <a id="transfer">Transfer</a>
        <a id="withdraw">Withdraw</a>
        <a id="account">Account</a>
    </nav>
    <main>
        <?php 
            $first_name = $_SESSION['first-name'];
            $last_name = $_SESSION['last-name'];
            $email = $_SESSION['email'];
            $age = $_SESSION['age'];
            $address = $_SESSION['adress'];
            $password = $_SESSION['password'];
            $account_number = $_SESSION['acc-num'];

            $sql = "SELECT * FROM transactions WHERE `made-by` = '$account_number' ORDER BY `trans-num` DESC LIMIT 15";
            $result = mysqli_query($conn, $sql);
            $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
        ?>
        <section id="Dashboard">
            <h3>Welcome <span id="username"> <?php echo "$first_name"; ?> </span></h3>
            Account-number: <span id="account-number"><?php echo "$account_number"; ?></span> <br>
            balance: <span id="balance">
            <?php
                $sql = "SELECT balance FROM balance WHERE `acc-num` = '$account_number'";
                $result = mysqli_query($conn, $sql);
                $balance = mysqli_fetch_assoc($result);
                if($balance != null){
                    echo "{$balance['balance']}";
                }else{
                    echo "0";
                }
            ?>  
            TND</span> <br>
            Last Transactions: <br><span id="lastTransaction">
            <?php
            if($transactions != null){
                echo "<table>";
                echo "<tr><th>Transaction number</th><th>Type</th><th>Date</th><th>amount</th><th>sent-to</th></tr>";
                foreach ($transactions as $transaction) {
                    echo "<tr><td>" . $transaction['trans-num'] . "</td><td>" . $transaction['type'] . "</td><td>" . $transaction['date'] . "</td><td>" . $transaction['amount'] ."</td><td>" . $transaction['sent-to'] . "</td></tr>"; 
                }
                echo "</table>";
            }else{
                echo "No transactions were made yet.";
            }
            ?>
            </span>
            <form action="home.php" method="post">
                <button type="submit" id="logout" name="logout">Logout</button>
            </form>
            <?php
                if (isset($_POST['logout'])) {
                    session_destroy();
                    header("Location: signin.php");
                }
            ?>
        </section>
        <section id="Deposit">
            <h3>Deposit</h3>
            <form action="home.php" method="post">
                <div class="form-group">
                    <label for="deposit-amount">Amount</label>
                    <input type="number" id="deposit-amount" name="deposit-amount" placeholder="Type in the amount you wish to deposit" required>
                    <div id="deposit-amount-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="deposit-password">Password</label>
                    <input type="password" id="deposit-password" name="deposit-password" placeholder="type in your password" required>
                </div>
                <button type="submit" id="deposit-button" name="deposit-button">Deposit</button>
            </form>
            <?php
                if (isset($_POST['deposit-button'])) {
                    $amount = $_POST['deposit-amount'];
                    $password = $_POST['deposit-password'];
                    $sql = "SELECT * FROM users WHERE `acc-num` = '$account_number' AND password = '$password'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $sql = "INSERT INTO transactions VALUES (null,'deposit',now(),'$amount','$account_number', null)";
                        if ($conn->query($sql) === TRUE) {
                            $sql = "SELECT balance FROM balance WHERE `acc-num` = '$account_number'";
                            $result = mysqli_query($conn, $sql);
                            $balance = mysqli_fetch_assoc($result);
                            if($balance != null){
                                $new_balance = $balance['balance'] + $amount;
                                $sql = "UPDATE balance SET `balance` = $new_balance WHERE `acc-num` = '$account_number'";
                                if ($conn->query($sql) === TRUE) {
                                    $_SESSION['deposit_success'] = true;
                                }else{
                                    echo "<div><p id='php-error-message'>*Deposit Failed: Please Try again later!</p></div>";
                                }
                            }else{
                                $sql = "INSERT INTO balance VALUES ('$account_number', $amount)";
                                if ($conn->query($sql) === TRUE) {
                                    $_SESSION['deposit_success'] = true;
                                }else{
                                    echo "<div><p id='php-error-message'>*Deposit Failed: Please Try again later!</p></div>";
                                }
                            }
                        }else{
                            echo "<div><p id='php-error-message'>*Deposit Failed: Please Try again later!</p></div>";
                        }
                    }else{
                        echo "<div><p id='php-error-message'>*Deposit Failed: wrong password !</p></div>";
                    }
                }
                if (isset($_SESSION['deposit_success']) && $_SESSION['deposit_success'] === true) {
                    unset($_SESSION['deposit_success']); // Unset the session variable
                    echo "<script>window.location = 'home.php';</script>"; // Redirect using JavaScript
                    exit(); // Stop further execution
                }
            ?>
        </section>
        <section id="Transfer">
            <h3>Transfer</h3>
            <form action="home.php" method="post">
                <div class="form-group">
                    <label for="transfer-account-number">account-number</label>
                    <input type="text" id="transfer-account-number" name="transfer-account-number" placeholder="type in the receiver account-number" required>
                    <div id="transfer-account-number-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="transfer-amount">Amount</label>
                    <input type="number" id="transfer-amount" name="transfer-amount" placeholder="Type in the amount you wish to transfer" required>
                    <div id="transfer-amount-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="transfer-password">Password</label>
                    <input type="password" id="transfer-password" name="transfer-password" placeholder="type in your password" required>
                </div>
                <button type="submit" id="transfer-button" name="transfer-button">Transfer</button>
            </form>
            <?php
                if (isset($_POST['transfer-button'])) {
                    $amount = $_POST['transfer-amount'];
                    $password = $_POST['transfer-password'];
                    $sent_to = $_POST['transfer-account-number'];
                    $sql = "SELECT * FROM users WHERE `acc-num` = '$account_number' AND password = '$password'";
                    $check_existance = "SELECT * FROM users WHERE `acc-num` = '$sent_to'";
                    $result = mysqli_query($conn, $check_existance);
                    $second_result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0  && mysqli_num_rows($second_result) > 0){
                        $sql = "SELECT balance FROM balance WHERE `acc-num` = '$account_number'";
                        $result = mysqli_query($conn, $sql);
                        $balance = mysqli_fetch_assoc($result);
                        if($balance != null){
                            if($balance['balance'] >= $amount){
                                $new_balance = $balance['balance'] - $amount;
                                $sql = "UPDATE balance SET `balance` = $new_balance WHERE `acc-num` = '$account_number'";
                                if ($conn->query($sql) === TRUE) {
                                    $sql = "INSERT INTO transactions VALUES (null,'transfer',now(),'$amount','$account_number', '$sent_to')";
                                    if ($conn->query($sql) === TRUE) {
                                        $sql = "SELECT balance FROM balance WHERE `acc-num` = '$sent_to'";
                                        $result = mysqli_query($conn, $sql);
                                        $balance = mysqli_fetch_assoc($result);
                                        if($balance != null){
                                            $new_balance = $balance['balance'] + $amount;
                                            $sql = "UPDATE balance SET `balance` = $new_balance WHERE `acc-num` = '$sent_to'";
                                            if ($conn->query($sql) === TRUE) {
                                                $_SESSION['transfer_success'] = true;
                                            }else{
                                                echo "<div><p id='php-error-message'>*Transfer Failed: Please Try again later!</p></div>";
                                            }
                                        }else{
                                            $sql = "INSERT INTO balance VALUES ('$sent_to', $amount)";
                                            if ($conn->query($sql) === TRUE) {
                                                $_SESSION['transfer_success'] = true;
                                            }else{
                                                echo "<div><p id='php-error-message'>*Transfer Failed: Please Try again later!</p></div>";
                                            }
                                        }
                                    }else{
                                        echo "<div><p id='php-error-message'>*Transfer Failed: Please Try again later!</p></div>";
                                    }
                                }else{
                                    echo "<div><p id='php-error-message'>*Transfer Failed: Please Try again later!</p></div>";
                                }
                            }else{
                                echo "<div><p id='php-error-message'>*Transfer Failed: Insufficient balance!</p></div>";
                            }
                        }else{
                            echo "<div><p id='php-error-message'>*Transfer Failed: You have no money!</p></div>";
                        }
                    }else{
                        echo "<div><p id='php-error-message'>*Transfer Failed: Invalid credentials!</p></div>";
                    }
                }
                if (isset($_SESSION['transfer_success']) && $_SESSION['transfer_success'] === true) {
                    unset($_SESSION['transfer_success']); // Unset the session variable
                    echo "<script>window.location = 'home.php';</script>"; // Redirect using JavaScript
                    exit(); // Stop further execution
                }
            ?>
        </section>
        <section id="Withdraw">
            <h3>Withdraw</h3>
            <form action="home.php" method="post">
                <div class="form-group">
                    <label for="withdraw-amount">Amount</label>
                    <input type="number" id="withdraw-amount" name="withdraw-amount" placeholder="Type in the amount you wish to withdraw" required>
                    <div id="withdraw-amount-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="withdraw-password">Password</label>
                    <input type="password" id="withdraw-password" name="withdraw-password" placeholder="type in your password" required>
                </div>
                <button type="submit" id="withdraw-button" name="withdraw-button">Withdraw</button>
            </form>
            <?php
                if (isset($_POST['withdraw-button'])) {
                    $amount = $_POST['withdraw-amount'];
                    $password = $_POST['withdraw-password'];
                    $sql = "SELECT * FROM users WHERE `acc-num` = '$account_number' AND password = '$password'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $sql = "SELECT balance FROM balance WHERE `acc-num` = '$account_number'";
                        $result = mysqli_query($conn, $sql);
                        $balance = mysqli_fetch_assoc($result);
                        if($balance != null){
                            if($balance['balance'] >= $amount){
                                $new_balance = $balance['balance'] - $amount;
                                $sql = "UPDATE balance SET `balance` = $new_balance WHERE `acc-num` = '$account_number'";
                                if ($conn->query($sql) === TRUE) {
                                    $sql = "INSERT INTO transactions VALUES (null,'withdraw',now(),'$amount','$account_number', null)";
                                    if ($conn->query($sql) === TRUE) {
                                        $_SESSION['withdraw_success'] = true;
                                    }else{
                                        echo "<div><p id='php-error-message'>*Withdraw Failed: Please Try again later!</p></div>";
                                    }
                                }else{
                                    echo "<div><p id='php-error-message'>*Withdraw Failed: Please Try again later!</p></div>";
                                }
                            }else{
                                echo "<div><p id='php-error-message'>*Withdraw Failed: Insufficient balance!</p></div>";
                            }
                        }else{
                            echo "<div><p id='php-error-message'>*Withdraw Failed: You have no money!</p></div>";
                        }
                    }else{
                        echo "<div><p id='php-error-message'>*Withdraw Failed: Wrong paswword!</p></div>";
                    }
                }
                if (isset($_SESSION['withdraw_success']) && $_SESSION['withdraw_success'] === true) {
                    unset($_SESSION['withdraw_success']); // Unset the session variable
                    echo "<script>window.location = 'home.php';</script>"; // Redirect using JavaScript
                    exit(); // Stop further execution
                }
            ?>
        </section>
        <section id="Account">
            <h3>Your Personal Info</h3>
            <form action="home.php" method="post">
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first-name" value="<?php echo $first_name; ?>">
                    <div id="first-name-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last-name" value="<?php echo $last_name; ?>">
                    <div id="last-name-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>">
                    <div id="email-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" value="<?php echo $age; ?>">
                    <div id="age-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" value="<?php echo $address; ?>">
                    <div id="address-error" class="error"></div>
                </div>
                <div class="form-group">
                    <button type="submit" id="account-submit-button" name="account-submit-button">Apply Changes</button>
                </div>
            </form>
            <?php
                if (isset($_POST['account-submit-button'])) {
                    $first_name = $_POST['first-name'];
                    $last_name = $_POST['last-name'];
                    $email = $_POST['email'];
                    $age = $_POST['age'];
                    $address = $_POST['address'];
                    $sql = "UPDATE users SET `first-name` = '$first_name', `last-name` = '$last_name', `email` = '$email', `age` = '$age', `adress` = '$address' WHERE `acc-num` = '$account_number'";
                    if ($conn->query($sql) === TRUE) {
                        $_SESSION['account_success'] = true;
                        $_SESSION['first-name'] = $first_name;
                        $_SESSION['last-name'] = $last_name;
                        $_SESSION['email'] = $email;
                        $_SESSION['age'] = $age;
                        $_SESSION['adress'] = $address;
                    }else{
                        echo "<div><p id='php-error-message'>*Update Failed: Please Try again later!</p></div>";
                    }
                }
                if (isset($_SESSION['account_success']) && $_SESSION['account_success'] === true) {
                    unset($_SESSION['account_success']); // Unset the session variable
                    echo "<script>window.location = 'home.php';</script>"; // Redirect using JavaScript
                    exit(); // Stop further execution
                }
            ?>
        </section>
    </main>
    <footer>
        <hr>
        <div id="footer">
            <div id="left">
                <h3>Follow Us :</h3>
                <a href="https://www.facebook.com/hammemiazyz" target="_blank"><img src="icons/facebook.png" alt="facebook" class="icons"></a>
                <a href="https://twitter.com/MICoRaZoN0" target="_blank"><img src="icons/X.png" alt="X" class="icons"></a>
                <a href="https://www.linkedin.com/in/mohammed-aziz-hammemi-696b78263/" target="_blank"><img src="icons/linkedin.png" alt="LinkedIn" class="icons"></a>
                <p>&copy 2024 <a href="../portfolio/index.php" target="_blank">Azyz</a> Tn, All rights reserved.</p>
            </div>
            <div id="right">
                <h3>Contact Us :</h3>
                <form action="home.php" method="post" id="contact-form">
                    <div class="contact-form-group">
                        <label for="contact-email">Email</label>
                        <input type="email" id="contact-email" name="contact-email" placeholder="Type in your e-mail">
                        <div id="contact-email-error" class="error"></div>
                    </div>
                    <div class="contact-form-group">
                        <label for="subject">Select</label>
                        <select name="subject" id="subject">
                            <option value="">Select a subject</option>
                            <option value="question">Question</option>
                            <option value="complaint">Complaint</option>
                            <option value="suggestion">Suggestion</option>
                            <option value="other">Other</option>
                        </select>
                        <div id="contact-select-error" class="error"></div>
                    </div>
                    <div class="contact-form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" placeholder="type in your message" cols="30" rows="10"></textarea>
                        <div id="contact-message-error" class="error"></div>
                    </div>
                    <div class="contact-form-group">
                        <button type="submit" name="send" id="send-message-button">Send</button>
                        <button type="reset">Reset</button>
                    </div>
                </form>
                <?php
                    if (isset($_POST['send'])) {
                        $email = $_POST['contact-email'];
                        $subject = $_POST['subject'];
                        $message = $_POST['message'];
                        $sql = "INSERT INTO messages VALUES (null,'$email','$subject','$message')";
                        if ($conn->query($sql) === TRUE) {
                            $_SESSION['message_success'] = true;
                        }else{
                            echo "<div><p id='php-error-message'>*Messaging system failed: Please Try again later!</p></div>";
                        }
                    }
                    if (isset($_SESSION['message_success']) && $_SESSION['message_success'] === true) {
                        unset($_SESSION['message_success']); // Unset the session variable
                        echo "<script>window.location = 'home.php';</script>"; // Redirect using JavaScript
                        exit(); // Stop further execution
                    }
                ?>
            </div>
        </div>
    </footer>
    <script src="script/home.js"></script>
</body>
</html>