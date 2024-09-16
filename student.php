<?php
// Retrieve form data
$name = $_POST['name'] ;
$gender = $_POST['gender'] ;
$grade = $_POST['grade'] ;
$caste = $_POST['caste'] ;
$location = $_POST['location'] ;

// Connect to the database
$dbcon = mysqli_connect("localhost", "root", "", "test");

if ($dbcon) {
    echo "<div class='centered'>Successfully connected<br>";
} else {
    echo "<div class='centered'>Not connected";
    exit();
}

// Insert the form data into the 'student' table
$inrsql = "INSERT INTO student(name, gender, grade, caste, location) VALUES ('$name', '$gender', '$grade', '$caste', '$location')";
$response = mysqli_query($dbcon, $inrsql);

if ($response) {
    echo "Successfully added record<br>";
} else {
    echo "Error: " . mysqli_error($dbcon) . "<br>";
}

// Report 1: Count students by gender
echo "<h3>Report 1: Count by Gender</h3>";
$gender_query = "SELECT gender, COUNT(*) AS total FROM student GROUP BY gender";
$gender_result = mysqli_query($dbcon, $gender_query);

if ($gender_result) {
    echo "<table border='1'>
            <tr>
                <th>Gender</th>
                <th>Total</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($gender_result)) {
        echo "<tr>
                <td>" . $row['gender'] . "</td>
                <td>" . $row['total'] . "</td>
              </tr>";
    }
    echo "</table><br>";
} else {
    echo "Error in gender query: " . mysqli_error($dbcon) . "<br>";
}

// Report 2: Count students who passed and failed
echo "<h3>Report 2: Count by Pass/Fail</h3>";
$pass_fail_query = "SELECT 
                        CASE 
                            WHEN grade IN ('A', 'B', 'C', 'D') THEN 'Pass'
                            ELSE 'Fail'
                        END AS result, 
                        COUNT(*) AS total 
                    FROM student 
                    GROUP BY result";
$pass_fail_result = mysqli_query($dbcon, $pass_fail_query);

if ($pass_fail_result) {
    echo "<table border='1'>
            <tr>
                <th>Result</th>
                <th>Total</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($pass_fail_result)) {
        echo "<tr>
                <td>" . $row['result'] . "</td>
                <td>" . $row['total'] . "</td>
              </tr>";
    }
    echo "</table><br>";
} else {
    echo "Error in pass/fail query: " . mysqli_error($dbcon) . "<br>";
}

// Report 3: Count students by caste
echo "<h3>Report 3: Count by Caste</h3>";
$caste_query = "SELECT caste, COUNT(*) AS total FROM student GROUP BY caste";
$caste_result = mysqli_query($dbcon, $caste_query);

if ($caste_result) {
    echo "<table border='1'>
            <tr>
                <th>Caste</th>
                <th>Total</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($caste_result)) {
        echo "<tr>
                <td>" . $row['caste'] . "</td>
                <td>" . $row['total'] . "</td>
              </tr>";
    }
    echo "</table><br>";
} else {
    echo "Error in caste query: " . mysqli_error($dbcon) . "<br>";
}

// Report 4: Count students by location
echo "<h3>Report 4: Count by Location</h3>";
$location_query = "SELECT location, COUNT(*) AS total FROM student GROUP BY location";
$location_result = mysqli_query($dbcon, $location_query);

if ($location_result) {
    echo "<table border='1'>
            <tr>
                <th>Location</th>
                <th>Total</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($location_result)) {
        echo "<tr>
                <td>" . $row['location'] . "</td>
                <td>" . $row['total'] . "</td>
              </tr>";
    }
    echo "</table><br>";
} else {
    echo "Error in location query: " . mysqli_error($dbcon) . "<br>";
}

// Display all student records
echo "<h3>All Student Records</h3>";
$student_query = "SELECT * FROM student";
$student_result = mysqli_query($dbcon, $student_query);

if ($student_result) {
    echo "<table border='1'>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Grade</th>
                <th>Caste</th>
                <th>Location</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($student_result)) {
        echo "<tr>
                <td>" . $row['name'] . "</td>
                <td>" . $row['gender'] . "</td>
                <td>" . $row['grade'] . "</td>
                <td>" . $row['caste'] . "</td>
                <td>" . $row['location'] . "</td>
              </tr>";
    }
    echo "</table><br>";
} else {
    echo "Error in student query: " . mysqli_error($dbcon) . "<br>";
}

// Close the database connection
mysqli_close($dbcon);
echo "</div>";
?>

<!-- Add CSS to center content -->
<style>
    .centered {
        text-align: center;
        margin: 0 auto;
        max-width: 800px;
    }
    table {
        margin: 0 auto;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px 12px;
    }
</style>
