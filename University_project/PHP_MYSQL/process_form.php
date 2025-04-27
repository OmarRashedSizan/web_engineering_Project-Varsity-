<?php
// Database credentials
$servername = "localhost"; // Replace with your server name
$username = "your_username"; // Replace with your MySQL username
$password = "your_password"; // Replace with your MySQL password
$dbname = "your_database";   // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and retrieve form data
$name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
$comments = isset($_POST['comments']) ? mysqli_real_escape_escape_string($conn, $_POST['comments']) : '';
$agree = isset($_POST['agree']) ? mysqli_real_escape_string($conn, $_POST['agree']) : 'no';
$gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : '';
$occupation = isset($_POST['occupation']) ? mysqli_real_escape_string($conn, $_POST['occupation']) : '';
$password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : ''; // Hash the password

// Handle multiple checkboxes (skills)
$skills = isset($_POST['skills']) ? implode(", ", array_map(function($skill) use ($conn) {
    return mysqli_real_escape_string($conn, $skill);
}, $_POST['skills'])) : '';

// Handle multiple list box (favorite tools)
$favorite_tools = isset($_POST['favorite_tools']) ? implode(", ", array_map(function($tool) use ($conn) {
    return mysqli_real_escape_string($conn, $tool);
}, $_POST['favorite_tools'])) : '';

// SQL query to insert data
$sql = "INSERT INTO form_data (name, comments, agreed, skills, gender, occupation, favorite_tools, password)
        VALUES ('$name', '$comments', '$agree', '$skills', '$gender', '$occupation', '$favorite_tools', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully. <a href='display_data.php'>View Data</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>