<?php
include __DIR__ . '/../database_config.php'; 

//read json input
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['username']) || !isset($data['password']) ) {
    echo json_encode(["status" => "error", "message" => "Please enter username and password"]);
    exit();
}

$username = $data['username'];
$password = password_hash($data['password'], PASSWORD_DEFAULT); //password hashing for enhance security

//check if username already exists
$sql_check = "SELECT * FROM users WHERE username = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Username already exists"]);
    exit();
}

//insert new user to database
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "RedirectUrl" => "index.php"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to register user"]);
}

exit();
?>
