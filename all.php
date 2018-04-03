<?php
$servername="localhost";
$username="root"; //database admin user name
$password="Ish@n123";
$dbname="Harshit";

//create connection
$conn=new mysqli($servername,$username,$password,$dbname);

//check connection
if($conn->connect_error){
die("connection failed:".$conn->connect_error);
}
echo "This file displays the data from <b>login</b> table in <u>".$dbname."</u> database.<br/><br/>";
$sql = "SELECT username, firstname, lastname, password from login";
$result = $conn->query($sql);

if($result->num_rows>0){
echo "<table border=\"1\"><tr><th>username</th><th>password</th><th>firstname</th><th>lastname</th></tr>";
while($row=$result->fetch_assoc()){
echo "<tr><td>".$row["username"]."</td><td><pre>".$row["password"]."</pre></td><td>".$row["firstname"]."</td><td>".$row["lastname"]."</td></tr>";
}
echo "</table>";
}else{
echo "0 results";
}
$conn->close();

?>
