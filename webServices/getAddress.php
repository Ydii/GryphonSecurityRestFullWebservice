<?php
header("Content-Type:application/json");
include("../dataSource.php");
$dataSource = new dataSource();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    //var_dump($data);
    $address = $dataSource->getAddress($data);
    
    if(empty($address->getId())){
        deliver_response(200, false, NULL);
    }else{
        deliver_response(200, true, $address);
    }
} else {
    deliver_response(400, false, NULL);
}

function deliver_response($status, $status_message, $address){
    header("HTTP/1.1 $status $status_message");
    
    $response['Address'] = $address->getTheAdress();
    $response['Addressid'] = $address->getId();
    $json_response = json_encode($response);
    echo $json_response;
}


