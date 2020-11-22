 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB"; 

/*function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}*/
$conn = new mysqli( $servername, $username, $password, $dbname );
$pname = $_POST["name"];
$pemail = $_POST["email"];
try{
   $phash =password_hash($_POST["password"], PASSWORD_DEFAULT);
}
catch(Exception $e)
{
echo $e;
}


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql ="INSERT INTO users (name, email, password)
VALUES ("."'".$pname."'".","."'".$pemail."'".","."'".$phash."'".")";
if ($conn->query($sql) === TRUE) {
  echo "Register Successful";
   // echo $phash;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}




?>