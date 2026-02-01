<?php

include 'db.php';

header('Content-Type: application/json');
header('Access-control-allow-origin: *');

try{
    $sql = "SELECT * FROM games";
    $result = $conn->query($sql);

    $bas6ahs= [];
    if($result && $result->num_rows > 0)

    while($row = $result->fetch_assoc()){
        $bas6ahs []=$row;
        }


    echo json_encode($bas6ahs);

}catch(Exception $e){
    http_response_code(500);
    echo json_encode($e->getMessage());

}

$conn -> close();