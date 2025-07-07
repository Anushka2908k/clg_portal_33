<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
$host = "localhost";
$username = "root";
$password = "";
$database = "college_portal";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$year = $_POST['year'];
$branch = $_POST['branch'];
$courseName = $_POST['courseName'];
$duration = $_POST['duration'];
$institute = $_POST['institute'];

// Handle file upload
$proofName = $_FILES['proof']['name'];
$proofTmpName = $_FILES['proof']['tmp_name'];
$proofFolder = "uploads/" . basename($proofName);

if (move_uploaded_file($proofTmpName, $proofFolder)) {
  // Save to database
  $sql = "INSERT INTO other_courses (name, year, branch, course_name, duration, institute, proof_file)
          VALUES ('$name', '$year', '$branch', '$courseName', '$duration', '$institute', '$proofFolder')";

  if ($conn->query($sql) === TRUE) {
    echo "✅ Other Course form submitted successfully.";
  } else {
    echo "❌ Error: " . $conn->error;
  }
} else {
  echo "❌ Failed to upload file.";
}

// Close connection
$conn->close();
?>
