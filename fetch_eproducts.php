<?php



$connection=new mysqli("localhost:3307","root","","online_store_db");
$fetchProductsCommand=$connection->prepare("select*from electronic_products where brand=?");
$fetchProductsCommand->bind_param("s", $_GET["brand"]);
$fetchProductsCommand->execute();
$electronicProductResults=$fetchProductsCommand->get_result();
$epArray=array();
while ($row=$electronicProductResults->fetch_assoc()){
    array_push($epArray, $row);
}
echo json_encode($epArray);
