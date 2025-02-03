<?php
session_start();
include("../database_config.php");

//read json input
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['username']) || !isset($data['password'])) {
    echo json_encode(["status" => "error", "message" => "Please enter username and password"]);
    exit();
}

$username = $data['username'];
$password = $data['password'];


$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        // Set session variables
        $_SESSION['user'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        

        echo json_encode([
            "status" => "success", 
            "redirectUrl" => "/page/index.php",
            "message" => "Login successful"
        ]);
    } else {
        
        echo json_encode([
            "status" => "error", 
            "message" => "Invalid username or password",
        ]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid username or password"]);
}

exit();
?>