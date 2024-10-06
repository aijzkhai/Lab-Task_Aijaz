<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="includes.css" />
<title>List of Doctors</title>
</head>
<body>
<?php include("header.php"); ?>

<?php

// Query to select data
$q = "SELECT ID, FirstName, LastName, Specialization, Password FROM Doktor ORDER BY ID";
$result = mysqli_query($connect, $q);

if ($result) {
    echo '<table>';
    echo "<table border='2'>";
    echo "<tr>";
    echo "<td><b>Edit</b></td>";
    echo "<td><b>Delete</b></td>";
    echo "<td><b>ID</b></td>";
    echo "<td><b>First Name</b></td>";
    echo "<td><b>Last Name</b></td>";
    echo "<td><b>Specialization</b></td>";
    echo "<td><b>Password</b></td>";
    echo "</tr>";
    
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo '<tr>';
        echo '<td><a href="edit_doktor.php?id=' . $row['ID'] . '">Edit</a></td>';
        echo '<td><a href="delete_doktor.php?id=' . $row['ID'] . '">Delete</a></td>';
        echo '<td>' . $row['ID'] . '</td>';
        echo '<td>' . $row['FirstName'] . '</td>';
        echo '<td>' . $row['LastName'] . '</td>';
        echo '<td>' . $row['Specialization'] . '</td>';
        echo '<td>' . $row['Password'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    mysqli_free_result($result);
} else {
    echo '<p class="error">Sorry, we are unable to retrieve the records at this time. Please try again later.</p>';
}

// Close the database connection
mysqli_close($connect);
?>

</body>
</html>
