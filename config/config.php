<?php
//host
$host = "localhost";

//dbname
$dbname = "bookstore";

//username
$user = "root";

//password
$pass = "";

$con = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$secret_key = "sk_test_51Mc9giSCD808ZUbgTb9Yq06yxZW7PjZBftUTih1CnWIkzJZlvwB78oUGgm2orG0pTYvw5Th3HOcCeAVkvKaJNeGQ00KzztlnTT";

// if($con){
//     echo "Database Connected";
// }
// else{
//     echo "Error";
// }

?>