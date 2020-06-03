<?php

$connection=new  mysqli("localhost:3307","root","","online_store_db");
$sqlCommand=$connection->prepare("insert into temporary_place_order value(?,?,?)");
$sqlCommand->bind_param("sii", $_GET["email"],$_GET["product_id"],$_GET["amount"]);
$sqlCommand->execute();
