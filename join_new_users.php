<?php

$connection=new mysqli("localhost:3307","root","","online_store_db");

//$sqlCommand=$connection->prepare("insert into app_users_table values(?,?,?)");
//$sqlCommand->bind_param("sss", $_GET["email"],$_GET["username"],$_GET["pass"]);
//$sqlCommand->execute();


//user with same email cannot signup again
$emailCheckSQLCommand=$connection->prepare("select*from app_users_table where email=?");
$emailCheckSQLCommand->bind_param("s", $_GET["email"]);
$emailCheckSQLCommand->execute();
$emailResult=$emailCheckSQLCommand->get_result();

if($emailResult->num_rows==0){
    
    $sqlCommand=$connection->prepare("insert into app_users_table values(?,?,?)");
    $sqlCommand->bind_param("sss", $_GET["email"],$_GET["username"],$_GET["pass"]);
    $sqlCommand->execute();
    echo 'congrats the signup is successful';
    
}else{
    echo 'A user with same email already exists';
}
