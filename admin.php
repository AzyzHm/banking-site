<?php
    session_start();
    include 'databaseconnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin.css">
    <link rel="icon" href="icons/Admin.png">
    <title>Admin Space</title>
</head>
<body>
    <nav>
        <a id="Dashboard">Dashboard</a>
        <a id="Transactions">Transactions</a>
        <a id="Users">Users</a>
        <a id="Messages">Messages</a>
    </nav>
    <main>
        <?php
            $sql = "SELECT COUNT(*) FROM users";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $totalUsers = $row['COUNT(*)'];

            $sql = "SELECT COUNT(*) FROM transactions";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $totalTransactions = $row['COUNT(*)'];

            $sql = "SELECT SUM(amount) FROM transactions WHERE type='deposit'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $totalDeposited = $row['SUM(amount)'];

            $sql = "SELECT SUM(amount) FROM transactions WHERE type='withdraw'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $totalWithdrawn = $row['SUM(amount)'];

            $sql = "SELECT SUM(amount) FROM transactions WHERE type='transfer'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $totalTransferred = $row['SUM(amount)'];

            $sql = "SELECT SUM(balance) from balance";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $profit = $row['SUM(balance)'] * 0.1;
        ?>
        <section id="dashboard">
            <h3>Welcome Admin</h3>
            Total Users:
            <?php echo $totalUsers; ?> User
            <br> <br>
            Number of transactions:
            <?php echo $totalTransactions; ?> Transaction
            <br> <br>
            Total Amount Deposited:
            <?php echo $totalDeposited; ?> TND
            <br> <br>
            Total Amount Withdrawn:
            <?php echo $totalWithdrawn; ?> TND
            <br> <br>
            Total Amount Transferred:
            <?php echo $totalTransferred; ?> TND
             <br> <br>
            Profit made:
            <?php echo $profit; ?> TND
             <br> <br>
        </section>
        <section id="transactions">
            <h3>Transactions</h3>
            <h5>Transactions List:</h5>
            <?php
                $sql = "SELECT * FROM transactions";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Transaction Number</th>";
                    echo "<th>Type</th>";
                    echo "<th>Date</th>";
                    echo "<th>Amount</th>";
                    echo "<th>made-by</th>";
                    echo "<th>sent-to</th>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['trans-num'] . "</td>";
                        echo "<td>" . $row['type'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['amount'] . "</td>";
                        echo "<td>" . $row['made-by'] . "</td>";
                        echo "<td>" . $row['sent-to'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No transactions found.";
                }
            ?>
        </section>
        <section id="users">
            <h3>Users</h3>
            <h5>Users List:</h5>
            <?php
                $sql = "SELECT * FROM users Join balance on users.`acc-num` = balance.`acc-num`";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Account Number</th>";
                    echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>Email</th>";
                    echo "<th>Age</th>";
                    echo "<th>Phone</th>";
                    echo "<th>Phone</th>";
                    echo "<th>Password</th>";
                    echo "<th>Balance</th>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['acc-num'] . "</td>";
                        echo "<td>" . $row['first-name'] . "</td>";
                        echo "<td>" . $row['last-name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['adress'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        echo "<td>" . $row['balance'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No users found.";
                }
            ?>
            <h5>Delete a User:</h5>
            <form action="admin.php" method="post">
                <label for="acc-num">Account Number:</label>
                <input type="text" name="acc-num" id="acc-num" required>
                <button type="submit" id="submit" name="submit">Delete</button>
                <?php
                    if (isset($_POST['submit'])) {
                        $accNum = $_POST['acc-num'];
                        $sql = "DELETE FROM users WHERE `acc-num` = '$accNum'";
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                            if (mysqli_affected_rows($conn) > 0) {
                                $_SESSION['delete'] = true;
                            } else {
                                echo "<div id='error-php'>No user found to delete.</div>";
                            }
                        } else {
                            echo "<div id='error-php'>Error deleting user.</div>";
                        }
                    }
                    if (isset($_SESSION['delete']) && $_SESSION['delete'] === true) {
                        unset($_SESSION['delete']); // Unset the session variable
                        echo "<script>window.location = 'admin.php';</script>"; // Redirect using JavaScript
                        exit(); // Stop further execution
                    }
                ?>
            </form>
            <div id="error"></div>
        </section>
        <section id="messages">
            <h3>Messages</h3>
            <h5>Messages List:</h5>
            <?php
                $sql = "SELECT * FROM messages";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Message Number</th>";
                    echo "<th>Sender</th>";
                    echo "<th>Subject</th>";
                    echo "<th>Message</th>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['mess-num'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['type'] . "</td>";
                        echo "<td>" . $row['content'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No messages found.";
                }
            ?>
        </section>
    </main>
    <script src="script/admin.js"></script>
</body>
</html>