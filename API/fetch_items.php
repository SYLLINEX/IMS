<?php
require_once '../page/database_config.php';

$records_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$category = isset($_GET['category']) ? $conn->real_escape_string($_GET['category']) : '';
$sort = isset($_GET['sort']) ? $conn->real_escape_string($_GET['sort']) : '';
$order = isset($_GET['order']) ? $conn->real_escape_string($_GET['order']) : 'ASC';

$start_from = ($page-1) * $records_per_page;

// Build WHERE clause
$where = [];
if ($search) {
    $where[] = "(item_name LIKE '%$search%' OR item_desc LIKE '%$search%')";
}
if ($category) {
    $where[] = "item_category = '$category'";
}
$where_clause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

// Build ORDER BY clause
$order_clause = '';
if ($sort) {
    $order_clause = "ORDER BY $sort $order";
}

// Get total filtered records
$total_query = "SELECT COUNT(*) as total FROM items $where_clause";
$result = $conn->query($total_query);
$row = $result->fetch_assoc();
$total_records = $row['total'];
$total_pages = ceil($total_records / $records_per_page);

// Get items for current page
$query = "SELECT * FROM items $where_clause $order_clause LIMIT $start_from, $records_per_page";
$result = $conn->query($query);

$items = array();
while($row = $result->fetch_assoc()) {
    $items[] = $row;
}

echo json_encode([
    'items' => $items,
    'total_pages' => $total_pages,
    'current_page' => $page
]);
?>