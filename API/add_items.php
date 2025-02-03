<?php
require_once '../page/database_config.php';

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

// Validate input
if(empty($data['itemName']) || empty($data['itemDesc']) || 
   empty($data['itemCategory']) || empty($data['itemQuantity'])) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
    exit;
}

// Prepare SQL statement
$sql = "INSERT INTO items (item_name, item_desc, item_category, item_quantity, date_added) 
        VALUES (?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", 
    $data['itemName'],
    $data['itemDesc'],
    $data['itemCategory'],
    $data['itemQuantity']
);

if($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
}

$stmt->close();
$conn->close();
?>