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

//check connection
if($conn->connect_error){
die("connection failed:".$conn->connect_error);
}

$sql= "UPDATE login SET password ='".base64_encode($aes->encrypt($pwd))."' WHERE username='".$uid."'";

if ($conn->query($sql)==TRUE){
	echo "Update successful<br/><br/>";
}else{
echo "Error: there is an error with updating password with encryption.<br/><br/>";
}

$conn->close();
}

?>
<html>
<head>
<title>Encrypt password</title>
</head>
<body>
If you type in the username and password, we will find a record with the username
 from the login table and change the password field with the password input text encrypted 
with AES encryption.<p/>
<form name="encrypt" target="encrypt_mysql.php" method="post">
username : <input name="usernameTXT" type="text"></input><br/><br/>
password : <input name="passwordTXT" type="text"></input><br/><br/>


<input name="submit" type="submit"/>
</form>
</body>
</html>
