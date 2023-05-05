<?php
// Connect to the database
$db = new mysqli('localhost', 'username', 'password', 'database_name');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Process search request
if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
    
    // Query the database
    $query = "SELECT * FROM blood_camps WHERE location LIKE '%$search_term%'";
    $result = $db->query($query);
    
    // Display search results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h2>" . $row['name'] . "</h2>";
            echo "<p>" . $row['location'] . "</p>";
            echo "</div>";
        }
    } else {
        echo "No results found.";
    }
}
?>

<!-- Search form -->
<form action="" method="get">
    <input type="text" name="search" placeholder="Search blood camps">
    <button type="submit">Search</button>
</form>




