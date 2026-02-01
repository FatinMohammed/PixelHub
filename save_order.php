<?php
include "db.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$name = $data["name"];
$address = $data["address"];
$phone = $data["phone"];
$payment = $data["payment"];
$coupon = $data["coupon"];
$total = $data["total"];

$sql = "INSERT INTO order1 (customer_name, address, phone, payment_method, coupon, total)
        VALUES ('$name', '$address', '$phone', '$payment', '$coupon', '$total')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$conn->close();
?>