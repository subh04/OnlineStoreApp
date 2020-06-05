<?php

$connection=new mysqli("localhost:3307","root","","online_store_db");
$getTemporaryOrdersCommand=$connection->prepare("select* from temporary_place_order where email=?");
$getTemporaryOrdersCommand->bind_param("s", $_GET["email"]);
$getTemporaryOrdersCommand->execute();
$temporaryOrdersResult=$getTemporaryOrdersCommand->get_result();

$populateInvoiceWithEmailCommand=$connection->prepare("insert into invoice(email) values(?)");
$populateInvoiceWithEmailCommand->bind_param("s", $_GET["email"]);
$populateInvoiceWithEmailCommand->execute();

$getLatestInvoiceNumberCommand=$connection->prepare("select max(invoice_num) as latest_invoice_num from invoice where email=?");
$getLatestInvoiceNumberCommand->bind_param("s", $_GET["email"]);
$getLatestInvoiceNumberCommand->execute();
$invoice_number_result=$getLatestInvoiceNumberCommand->get_result();
$row_invoiceNumber=$invoice_number_result->fetch_assoc();

while ($row=$temporaryOrdersResult->fetch_assoc()){
    //amount invoice_num product_id
    
    $populateInvoiceDetailsCommand=$connection->prepare("insert into invoice_details values(?,?,?)");
    $populateInvoiceDetailsCommand->bind_param("iii",$row["amount"], $row_invoiceNumber["latest_invoice_num"],$row["product_id"]);
    $populateInvoiceDetailsCommand->execute();
    
    $deleteTempOrdersCommand=$connection->prepare("delete from temporary_place_order where email=?");
    $deleteTempOrdersCommand->bind_param("s", $_GET["email"]);
    $deleteTempOrdersCommand->execute();
    
}

echo $row_invoiceNumber["latest_invoice_num"];



