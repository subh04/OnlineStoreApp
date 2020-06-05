<?php

$connection=new mysqli("localhost:3307","root","","online_store_db");
$sqlCommand=$connection->prepare("select id,name,price,email,amount from temporary_place_order inner join electronic_products on electronic_products.id=temporary_place_order.product_id where email=?");
$sqlCommand->bind_param("s", $_GET["email"]);
$sqlCommand->execute();


$tempOrderArray=array();
$sqlResult=$sqlCommand->get_result();
while($row=$sqlResult->fetch_assoc()){
    array_push($tempOrderArray, $row);
}

echo json_encode($tempOrderArray);