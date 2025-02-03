<?php
require_once '../page/database_config.php';

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

// Validate input
if(empty($data['itemId']) || empty($data['itemName']) || empty($data['itemDesc']) || 
   empty($data['itemCategory']) || empty($data['itemQuantity'])) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
    exit;
}

// Validate quantity is positive
if($data['itemQuantity'] < 1) {
    echo json_encode(['status' => 'error', 'message' => 'Quantity must be at least 1']);
    exit;
}

// Prepare SQL statement
$sql = "UPDATE items SET item_name = ?, item_desc = ?, item_category = ?, item_quantity = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssii", 
    $data['itemName'],
    $data['itemDesc'],
    $data['itemCategory'],
    $data['itemQuantity'],
    $data['itemId']
);

if($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Item updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
}

$stmt->close();
$conn->close();
?>