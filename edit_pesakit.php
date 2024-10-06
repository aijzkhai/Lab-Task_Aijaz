<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Pesakit</title>
</head>

<body>
<?php include("header.php"); ?>

<h2>Edit a record</h2>

<?php
// Look for a valid user ID, either through GET or POST
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];
} else {
    echo '<p class="error">This page has been accessed in error.</p>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array();
    
    // Look for FirstName
    if (empty($_POST['FirstName'])) {
        $error[] = 'You forgot to enter the First Name.';
    } else {
        $n = mysqli_real_escape_string($connect, trim($_POST['FirstName']));
    }
    
    // Look for LastName
    if (empty($_POST['LastName'])) {
        $error[] = 'You forgot to enter the Last Name.';
    } else {
        $l = mysqli_real_escape_string($connect, trim($_POST['LastName']));
    }
    
    // Look for Insurance Number
    if (empty($_POST['InsuranceNumber'])) {
        $error[] = 'You forgot to enter the Insurance Number.';
    } else {
        $in = mysqli_real_escape_string($connect, trim($_POST['InsuranceNumber']));
    }

    // Look for Diagnose
    if (empty($_POST['Diagnose'])) {
        $error[] = 'You forgot to enter the Diagnose.';
    } else {
        $d = mysqli_real_escape_string($connect, trim($_POST['Diagnose']));
    }

    // If no problem occurred
    if (empty($error)) {
        $q = "SELECT ID_P FROM pesakit WHERE InsuranceNumber ='$in' AND ID_P != $id";
        $result = @mysqli_query($connect, $q);
        
        if (mysqli_num_rows($result) == 0) {
            $q = "UPDATE pesakit SET FirstName_P='$n', LastName_P='$l', InsuranceNumber='$in', Diagnose='$d' WHERE ID_P='$id' LIMIT 1";
            $result = @mysqli_query($connect, $q);
            
            if (mysqli_affected_rows($connect) == 1) {
                echo '<h3>The user has been edited</h3>';
            } else {
                echo '<p class="error">The user has not been edited due to a system error. We apologize for any inconvenience.</p>';
                echo '<p>' .mysqli_error($connect). '<br/> query: ' .$q. '</p>';
            }
        }
    }
} else {
    $sql = "SELECT FirstName_P, LastName_P, InsuranceNumber, Diagnose FROM pesakit WHERE ID_P =$id";
    $result = @mysqli_query($connect, $sql);

    if (!$result) {
        echo '<p class="error">The user has not been edited due to the system error. We apologize for any inconvenience.</p>';
    } else {
        echo '<p class="error">The user has been edited.</p>';
    }
}
mysqli_close($connect);
?>

<form action="edit_pesakit.php" method="post">
    <p>First Name: <input type="text" name="FirstName" size="15" maxlength="30" value="<?php if (isset($_POST['FirstName_P'])) echo $_POST['FirstName_P']; ?>" /></p>
    <p>Last Name: <input type="text" name="LastName" size="15" maxlength="30" value="<?php if (isset($_POST['LastName_P'])) echo $_POST['LastName_P']; ?>" /></p>
    <p>Insurance Number: <input type="text" name="InsuranceNumber" size="15" maxlength="30" value="<?php if (isset($_POST['InsuranceNumber'])) echo $_POST['InsuranceNumber']; ?>" /></p>
    <p>Diagnose: <input type="text" name="Diagnose" size="15" maxlength="30" value="<?php if (isset($_POST['Diagnose'])) echo $_POST['Diagnose']; ?>" /></p>
    <p><input id="submit" type="submit" name="submit" value="Edit" /></p>
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
</form>

</body>
</html>
