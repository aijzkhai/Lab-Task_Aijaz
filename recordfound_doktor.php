<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php include('header.php'); ?>

<?php
$ID = $_POST['ID'];
include('connect.php');
$sa = "SELECT ID, FirstName, LastName, EmailAddress FROM doktor WHERE ID='$ID' ORDER BY ID";
$result = mysqli_query($connect, $sa);

if ($result) {
    echo '<table border="1">';
    echo '<tr><td>ID</td><td>FirstName</td><td>LastName</td><td>EmailAddress</td></tr>';
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $row['ID'] . '</td>';
        echo '<td>' . $row['FirstName'] . '</td>';
        echo '<td>' . $row['LastName'] . '</td>';
        echo '<td>' . $row['EmailAddress'] . '</td>';
        echo '</tr>';
    }
    mysqli_free_result($result);
    echo '</table>';
} else {
    // No records were returned.
    echo '<p class="error">No records found. Click the back button on your browser and try again.</p>';
}
mysqli_close($connect);
?>
</body>
</html>
