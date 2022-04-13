<?php
// connect to database
$conn = mysqli_connect('db-instance.id.eu-central-1.rds.amazonaws.com:3306', 'user', 'pass', 'mydb');

if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
}

$sql = 'SELECT * FROM myclocks ORDER by id DESC LIMIT 1';

// make query and get result
$results = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$times = mysqli_fetch_assoc($results);

echo json_encode($times);

//free results from memory
mysqli_free_result($results);

// close connection
mysqli_close($conn);

// print_r($times);

?>