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
        ?>
        <section id="Dashboard">
            <h3>Welcome <span id="username"> <?php echo "$first_name"; ?> </span></h3>
            Account-number: <span id="account-number"><?php echo "$account_number"; ?></span> <br>
            balance: <span id="balance">0 TND</span> <br>
            Last Transaction: <br><span id="lastTransaction">no transactions were made!</span>
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
            <form>
                <div class="form-group">
                    <label for="deposit-amount">Amount</label>
                    <input type="number" id="deposit-amount" name="deposit-amount" required>
                    <div id="deposit-amount-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="deposit-password">Password</label>
                    <input type="password" id="deposit-password" name="deposit-password" required>
                </div>
                <button type="submit" id="deposit-button" name="deposit-button">Deposit</button>
            </form>
        </section>
        <section id="Transfer">
            <h3>Transfer</h3>
            <form>
                <div class="form-group">
                    <label for="transfer-account-number">account-number</label>
                    <input type="text" id="transfer-account-number" name="transfer-account-number" required>
                    <div id="transfer-account-number-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="transfer-amount">Amount</label>
                    <input type="number" id="transfer-amount" name="transfer-amount" required>
                    <div id="transfer-amount-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="transfer-password">Password</label>
                    <input type="password" id="transfer-password" name="transfer-password" required>
                </div>
                <button type="submit" id="transfer-button" name="transfer-button">Transfer</button>
            </form>
        </section>
        <section id="Withdraw">
            <h3>Withdraw</h3>
            <form>
                <div class="form-group">
                    <label for="withdraw-amount">Amount</label>
                    <input type="number" id="withdraw-amount" name="withdraw-amount" required>
                    <div id="withdraw-amount-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="withdraw-password">Password</label>
                    <input type="password" id="withdraw-password" name="withdraw-password" required>
                </div>
                <button type="submit" id="withdraw-button" name="withdraw-button">Withdraw</button>
            </form>
        </section>
        <section id="Account">
            <h3>Your Personal Info</h3>
            <form>
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first-name">
                    <div id="first-name-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last-name">
                    <div id="last-name-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                    <div id="email-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age">
                    <div id="age-error" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="password">Address</label>
                    <input type="address" id="address" name="address">
                    <div id="address-error" class="error"></div>
                </div>
                <div class="form-group">
                    <button type="submit" id="account-submit-button">Apply Changes</button>
                </div>
            </form>
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
                <form id="contact-form">
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
                    </div>
                </form>
            </div>
        </div>
    </footer>
    <script src="script/home.js"></script>
</body>
</html>