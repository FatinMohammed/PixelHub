<?php
include "db.php";


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "";
if (isset($_GET['search'])) {
    $query = $_GET['search'];
}

$sql = "SELECT * FROM games WHERE name LIKE '%$query%' OR des LIKE '%$query%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Results</title>
<style>
body {
    background-color: #121212;
    color: bisque;
    font-family: Arial, sans-serif;
}
.container {
    width: 80%;
    margin: 50px auto;

}
.search-box {
    text-align: center;
    margin-bottom: 30px;
    
}
.search-box input[type="text"] {
    padding: 10px;
    width: 50%;
    border-radius: 5px;
    border: none;
    background-color:   rgba(248, 249, 251, 0.84);

}
.search-box button {
    padding: 10px 15px;
    background-color: rgba(99, 41, 41, 0.8);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.product {
    background-color: #1e1e1e;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}
.product img {
    width: 120px;
    height: 120px;
    border-radius: 10px;
    margin-right: 20px;
}
.search-box img{
width: 100px;

}
</style>
</head>
<body>
<div class="container">
    <div class="search-box">
        <a href="index.html"> <img src="images/pppp.png" alt="" ></a>
        
        <form action="search.php" method="GET">
            <input type="text" name="search" placeholder="Search for games..." value="<?php echo htmlspecialchars($query); ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <h2>Search Results:</h2>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
            echo "<div>";
            echo "<h3>" . $row['name'] . "</h3>";
            echo "<p>" . $row['des'] . "</p>";
            echo "<p><strong>$" . $row['price'] . "</strong></p>";
            echo "</div></div>";
        }
    } else {
        echo "<p>No games found.</p>";
    }
    ?>
</div>
</body>
</html>