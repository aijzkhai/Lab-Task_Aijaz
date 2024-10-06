<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Klinik Ajwa</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <?php
    // Call file to connect server Klinik Ajwa
    include("header.php");

    // This section processes submissions from the login form
    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validate the username
        if (!empty($_POST['ID'])) {
            $un = mysqli_real_escape_string($connect, $_POST['ID']);
        } else {
            $un = FALSE;
            echo '<p class="error">You forgot to enter your ID.</p>';
        }

        // Validate the password
        if (!empty($_POST['Password'])) {
            $pw = mysqli_real_escape_string($connect, $_POST['Password']);
        } else {
            $pw = FALSE;
            echo '<p class="error">You forgot to enter your password.</p>';
        }

        if ($un && $pw) {
            // Query the database
            $q = "SELECT first_name, last_name, specialization, password FROM users WHERE ID='$un'";
            $r = @mysqli_query($connect, $q);

            // Check the result
            if (mysqli_num_rows($r) == 1) {
                // Fetch the record
                $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

                // Verify the password
                if (password_verify($pw, $row['password'])) {
                    // Start the session and set the session variables
                    session_start();
                    $_SESSION['ID'] = $un;
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['specialization'] = $row['specialization'];

                    // Redirect to the logged-in page
                    header('Location: loggedin.php');
                    exit();
                } else {
                    // Invalid password
                    echo '<p class="error">The username and password do not match our records.</p>';
                }
            } else {
                // No user found
                echo '<p class="error">The username and password do not match our records.</p>';
            }
        } else {
            // Missing ID or password
            echo '<p class="error">Please enter both your ID and password.</p>';
        }

        // Close the database connection
        mysqli_close($connect);
    }
    ?>

    <h2 align="center">LOGIN</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <p><label class="label" for="ID">ID:</label>
        <input id="id" type="text" name="ID" size="30" maxlength="30"
            value="<?php if (isset($_POST['ID'])) echo $_POST['ID']; ?>"></p>
        <p><label class="label" for="Password">Password:</label>
        <input id="password" type="password" name="Password" size="30" maxlength="60"
            value="<?php if (isset($_POST['Password'])) echo $_POST['Password']; ?>"></p>
        <p align='left'><input id="submit" type="submit" name="submit" value="Login"/></p>
        <p align='center'>Don't have an account? <br><a href="./register.php">Sign up</a></p>
    </form>
</body>
</html>
