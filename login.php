<?php

$uid=$_POST["usernameTXT"];
$pwd=$_POST["passwordTXT"];

if ($uid<>NULL){

include("./AES.class.php");
$key = "myencryptionKeys";
$aes = new AES($key);

$servername="localhost";
$username="root"; //database admin user name
$password="Ish@n123";
$dbname="Harshit";

//create connection
$conn=new mysqli($servername,$username,$password,$dbname);

$sql="SELECT firstname,lastname from login where username='".$uid."' and password='".base64_encode($aes->encrypt($pwd))."'";
//check connection
$result=$conn->query($sql);
if($result->num_rows>0){
while($row=$result->fetch_assoc()){
echo "Welcome ".$row["firstname"]." ".$row["lastname"].",<br/>You have logged in successfully<br/>";
}
}else{
echo "There is an error with sql statement.<br/>";
}

if($conn->connect_error){
die("connection failed:".$conn->connect_error);
}


$conn->close();
}

?>
<html>
<head>
<title>Login</title>
</head>
<body>
<form name="encrypt" target="login.php" method="post">
username : <input name="usernameTXT" type="text"></input><br/><br/>
password : <input name="passwordTXT" type="text"></input><br/><br/>
<input name="submit" type="submit"/>
</form>
</body>
</html>
