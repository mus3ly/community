<?php
// Database configuration
$host = "localhost";
$username = "arkethu2_chl";
$password = "^U!m,u?f?v]8";
$database = "arkethu2_chl";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all table names
$query = "SHOW TABLES";
$result = $conn->query($query);

if ($result) {
    // Loop through each table and drop it
    while ($row = $result->fetch_array()) {
        $tableName = $row[0];
        $query = "DROP TABLE $tableName";
        $conn->query($query);
        echo $tableName;
        echo "<br>";
    }
    echo "All tables have been deleted successfully.";
} else {
    echo "Error retrieving table names: " . $conn->error;
}

// Close the connection
$conn->close();
?>