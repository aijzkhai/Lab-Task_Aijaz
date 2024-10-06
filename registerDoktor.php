<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="includes.css" />
    <title>Register Doctor</title>
</head>
<body>
    
<?php include("header.php"); ?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = array();

        // Check for ID:
        if (empty($_POST['ID'])) {
            $errors[] = 'You forgot to enter your ID.';
        } else {
            $id = mysqli_real_escape_string($connect, $_POST['ID']);
        }

        // Check for First Name:
        if (empty($_POST['FirstName'])) {
            $errors[] = 'You forgot to enter your first name.';
        } else {
            $firstName = mysqli_real_escape_string($connect, $_POST['FirstName']);
        }

        // Check for Last Name:
        if (empty($_POST['LastName'])) {
            $errors[] = 'You forgot to enter your last name.';
        } else {
            $lastName = mysqli_real_escape_string($connect, $_POST['LastName']);
        }

        // Check for Specialization:
        if (empty($_POST['Specialization'])) {
            $errors[] = 'You forgot to enter your specialization.';
        } else {
            $specialization = mysqli_real_escape_string($connect, $_POST['Specialization']);
        }

        // Check for Password:
        if (empty($_POST['Password'])) {
            $errors[] = 'You forgot to enter your password.';
        } else {
            $password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Secure password hash
        }

        // Insert the doctor into the database using defined variables
        if (empty($errors)) {
            $q = "INSERT INTO doktor (ID, FirstName, LastName, Specialization, Password) 
                  VALUES ('$id', '$firstName', '$lastName', '$specialization', '$password')";
            $result = @mysqli_query($connect, $q); // Run the query

            if ($result) { // If it runs
                echo '<h1>Thank you for registering!</h1>';
                exit();
            } else { // If it did not run
                echo '<h1>System error</h1>';
                // Debugging message
                echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
            } // End of if ($result)

            mysqli_close($connect); // Close the database connection
            exit(); // End of the main submit conditional
        } else {
            echo '<p>Error: ' . implode('<br>', $errors) . '</p>'; // Display any errors
        }
    }
?>

<h1>REGISTER DOCTOR</h1>
<p>This field is required to fill up.</p>
<form method="post" action="">
    <!-- Changed Doctor ID field to ID -->
    <p><label for="ID">ID:</label>
    <input type="text" name="ID" id="ID" value="<?php if (isset($_POST['ID'])) echo $_POST['ID']; ?>" /></p>

    <p><label for="FirstName">First Name:</label>
    <input type="text" name="FirstName" id="FirstName" value="<?php if (isset($_POST['FirstName'])) echo $_POST['FirstName']; ?>" /></p>

    <p><label for="LastName">Last Name:</label>
    <input type="text" name="LastName" id="LastName" value="<?php if (isset($_POST['LastName'])) echo $_POST['LastName']; ?>" /></p>

    <p><label for="Specialization">Specialization:</label>
    <input type="text" name="Specialization" id="Specialization" value="<?php if (isset($_POST['Specialization'])) echo $_POST['Specialization']; ?>" /></p>

    <p><label for="Password">Password:</label>
    <input type="password" name="Password" id="Password" /></p>

    <p><input id="submit" type="submit" name="submit" value="Register" />  
    <input id="reset" type="reset" name="reset" value="Clear All" /></p>
</form>
<p>
<br />
<br />
<br />
</body>
</html>
