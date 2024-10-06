<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="includes.css" />
</head>

<body>

    <?php include("header.php"); ?>

    <?php
    // Query to fetch data
    $q = "SELECT ID_P, FirstName_P, LastName_P, InsuranceNumber, Diagnose FROM pesakit ORDER BY ID_P";
    $result = @mysqli_query($connect, $q);

    if ($result) {
        // Output data of each row
        echo "<table border='2'>";
        echo "<tr>";
        echo "<td><b>Edit</b></td>";
        echo "<td><b>Delete</b></td>";
        echo "<td><b>ID patient</b></td>";
        echo "<td><b>First Name</b></td>";
        echo "<td><b>Last Name</b></td>";
        echo "<td><b>Insurance Number</b></td>";
        echo "<td><b>Diagnose</b></td>";
        echo "</tr>";

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td><a href='edit_pesakit.php?id=" . $row['ID_P'] . "'>Edit</a></td>";
            echo "<td><a href='delete_pesakit.php?id=" . $row['ID_P'] . "'>Delete</a></td>"; // Fixed the "Delete" link
            echo "<td>" . $row['ID_P'] . "</td>";
            echo "<td>" . $row['FirstName_P'] . "</td>";
            echo "<td>" . $row['LastName_P'] . "</td>";
            echo "<td>" . $row['InsuranceNumber'] . "</td>";
            echo "<td>" . $row['Diagnose'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_free_result($result);
    } else {
        // Error message
        echo '<p class="error">The current patient data could not be retrieved. We apologize for any inconvenience.</p>';

        // Debugging message
        echo '<p>' . mysqli_error($connect) . '<br><br/>Query: ' . $q . '</p>';
    }

    // Close the database connection
    mysqli_close($connect);
    ?>
</body>
</html>
