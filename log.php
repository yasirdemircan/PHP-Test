 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB"; 

/*function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}*/
$conn = new mysqli( $servername, $username, $password, $dbname );
$pemail = $_POST["email"];
$pass = $_POST["password"];


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql ="SELECT id,email,password,name FROM USERS WHERE email="."'".$pemail."'";
$res = $conn->query($sql)->fetch_assoc();
if (password_verify($pass,$res["password"])) {
  echo "Welcome ".$res["name"];
} else {
  echo "Invalid Credentials.";
}




?>