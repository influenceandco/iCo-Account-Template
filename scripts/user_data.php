<?php

session_start();

include("../scripts/dbconnect.php");


$number = $_POST["number"];
$search = $_POST["search"];
$limitnumber = 20;

$data = mysql_query("SELECT users.id, users.firstname, users.lastname, users.email, users.clearance_level FROM users WHERE CONCAT(users.firstname, ' ', users.lastname) LIKE '%" . $search . "%' OR CONCAT(users.lastname, ' ', users.firstname) LIKE '%" . $search . "%' ORDER BY firstname, lastname LIMIT $number, $limitnumber")or die(mysql_query());


$array = array();
while ($row = mysql_fetch_array($data)) {
    $array[] = $row;
}

if (count($array) == 0) {
    echo false;
}

$js_array = json_encode($array);
echo $js_array;



?>