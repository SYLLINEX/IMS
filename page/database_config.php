<?php
$host = "localhost";
$dbname = "item_management";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user exists
$checkUser = "SELECT * FROM users LIMIT 1";
$resultUser = $conn->query($checkUser);

if ($resultUser->num_rows == 0) {
    // Default user credentials
    $defaultUserUsername = "user";
    $defaultUserPassword = password_hash("user123", PASSWORD_DEFAULT);
    
    // Insert default user
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $defaultUserUsername, $defaultUserPassword);
    $stmt->execute();
    $stmt->close();
}

// Check if items table is empty
$checkItems = "SELECT * FROM items LIMIT 1";
$resultItems = $conn->query($checkItems);

if ($resultItems->num_rows == 0) {
    // Dummy data array
    $dummyData = [
        ['Dell XPS 13', 'High-performance ultrabook', 'Laptop', 10],
        ['HP Pavilion', 'Business laptop with Intel i5', 'Laptop', 8],
        ['MacBook Pro', 'Apple laptop with M2 chip', 'Laptop', 5],
        ['Logitech MX Master 3', 'Wireless ergonomic mouse', 'Mouse', 15],
        ['Razer DeathAdder', 'Gaming mouse with RGB lighting', 'Mouse', 12],
        ['Apple Magic Mouse', 'Wireless touch-sensitive mouse', 'Mouse', 7],
        ['Dell Inspiron 15', 'Everyday use laptop', 'Laptop', 6],
        ['Lenovo ThinkPad T14', 'Business laptop with long battery life', 'Laptop', 9],
        ['Corsair K95', 'Mechanical gaming keyboard', 'Keyboard', 10],
        ['Logitech K380', 'Compact Bluetooth keyboard', 'Keyboard', 14],
        ['HP Omen 25L', 'Gaming desktop with RTX 3060', 'Desktop', 3],
        ['Dell OptiPlex 7090', 'Office desktop PC', 'Desktop', 4],
        ['Samsung 27" Monitor', '4K UHD monitor for professionals', 'Monitor', 8],
        ['Asus ROG Strix', '144Hz gaming monitor', 'Monitor', 6],
        ['Epson EcoTank L3150', 'Wireless inkjet printer', 'Printer', 5]
    ];

    // Prepare and execute insert statement
    $sql = "INSERT INTO items (item_name, item_desc, item_category, item_quantity, date_added) VALUES (?, ?, ?, ?, CURDATE())";
    $stmt = $conn->prepare($sql);

    foreach ($dummyData as $item) {
        $stmt->bind_param("sssi", $item[0], $item[1], $item[2], $item[3]);
        $stmt->execute();
    }
    
    $stmt->close();
}
?>