<?php
//$conn_str ="/home/ubuntu/conn.txt"
$servername = file_get_contents('conn.txt') or die ("Error");

//$servername='sarang-db.cmyhufjngqyk.us-west-2.rds.amazonaws.com';

$username = "sarang";
$password = "sarang123";

//foreach (glob("conn.txt") as $filename) {
  // $servername=nl2br(file_get_contents($filename));
   //}





// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Drop database
$sql_drop= "drop database school";
if ($conn->query($sql_drop) === TRUE) 
{
//    echo "Database created successfully";
}

// Create database
$sql = "CREATE DATABASE school";
if ($conn->query($sql) === TRUE) {
  //  echo "Database created successfully";
} 
else 
{
    echo "Error creating database: " . $conn->error;
}

$sql_create = "create table school.students (ID int NOT NULL AUTO_INCREMENT, Name varchar(255), Age int(3),PRIMARY KEY (ID))";

if ($conn->query($sql_create) === TRUE) 
{
    //echo "Table students created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$sql_insert="insert into school.students(Name,Age) values
('sarang',43),
('rahul',44),
('saurav',42),
('virat',29),
('christina',24);";
if ($conn->query($sql_insert) === TRUE)
{
    //echo "Table students created successfully";
} else
 {
    echo "Error creating table: " . $conn->error;
}


$sql_select = "select * from school.students";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["ID"]. " - Name: " . $row["Name"]. " Age " . $row["Age"]. "<br>";
    }
} else {
    echo "0 results";
}



$conn->close();
?>
