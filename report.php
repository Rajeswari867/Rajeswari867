<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Gender count
$gender_count = $conn->query("SELECT gender, COUNT(*) as total FROM students GROUP BY gender");

// Grade count (pass/fail)
$pass_fail_count = $conn->query("SELECT grade, COUNT(*) as total FROM students GROUP BY grade");

// Caste count
$caste_count = $conn->query("SELECT caste, COUNT(*) as total FROM students GROUP BY caste");

// Location count
$location_count = $conn->query("SELECT location, COUNT(*) as total FROM students GROUP BY location");

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Report</title>
</head>
<body>
    <h1>Student Report</h1>

    <h2>Gender Count</h2>
    <ul>
        <?php while($row = $gender_count->fetch_assoc()) { ?>
            <li><?php echo $row['gender']; ?>: <?php echo $row['total']; ?></li>
        <?php } ?>
    </ul>

    <h2>Pass/Fail Count</h2>
    <ul>
        <?php while($row = $pass_fail_count->fetch_assoc()) { ?>
            <li><?php echo $row['grade']; ?>: <?php echo $row['total']; ?></li>
        <?php } ?>
    </ul>

    <h2>Caste Count</h2>
    <ul>
        <?php while($row = $caste_count->fetch_assoc()) { ?>
            <li><?php echo $row['caste']; ?>: <?php echo $row['total']; ?></li>
        <?php } ?>
    </ul>

    <h2>Location Count</h2>
    <ul>
        <?php while($row = $location_count->fetch_assoc()) { ?>
            <li><?php echo $row['location']; ?>: <?php echo $row['total']; ?></li>
        <?php } ?>
    </ul>

</body>
</html>
