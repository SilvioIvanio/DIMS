<?php
header("Content-Type: application/json");
require 'db.php';

$res1 = $conn->query("SELECT COUNT(*) as total FROM applications");
$res2 = $conn->query("SELECT COUNT(*) as placed FROM applications WHERE status = 'Accepted'");
$res3 = $conn->query("SELECT COUNT(*) as active_placements FROM placements WHERE status = 'Active'");
$res4 = $conn->query("SELECT COUNT(*) as employers FROM users WHERE role = 'employer'");

$total = $res1->fetch_assoc()['total'];
$placed = $res2->fetch_assoc()['placed'];
$active = $res3->fetch_assoc()['active_placements'];
$employers = $res4->fetch_assoc()['employers'];

$rate = $total > 0 ? round(($placed / $total) * 100) : 0;

echo json_encode([
    "status" => "success",
    "data" => [
        "total_applications" => $total,
        "total_placed" => $placed,
        "active_placements" => $active,
        "placement_rate" => $rate,
        "total_employers" => $employers
    ]
]);
?>
