<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PHP-Login Test</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";
// Create connection
$conn = new mysqli( $servername, $username, $password );
$checkdb = $conn->query( "SHOW DATABASES LIKE 'myDB'" );
$checkdb_arr = $checkdb->fetch_assoc();
$tc_query = "CREATE TABLE USERS (id INT AUTO_INCREMENT NOT NULL,name VARCHAR(20) NOT NULL,
        email VARCHAR(50) NOT NULL,password VARCHAR(20) NOT NULL,PRIMARY KEY (id))";
//Check Connection
if ( $conn->connect_error ) {
    die( "Connection failed: " . $conn->connect_error );
}
//Check if db exists
if ( @count( $checkdb_arr ) === 1 ) {
    echo "Database already exists!<br>";
    $conn -> close();
    $conn = new mysqli( $servername, $username, $password, $dbname );
    /*Database exists here*/
    //Check if table exists
    if ( empty( $conn->query( "SHOW TABLES LIKE 'USERS'" )->fetch_assoc() ) ) {
        if ( $conn->query( $tc_query ) === TRUE ) {
            echo "Table created successfully.";
        } else {
            echo $conn->error;
        }
    } else {
        echo "Table already exists.<br>";
        /*Table exists here*/
    }

} else {

    // Create database
    $sql = "CREATE DATABASE myDB";
    if ( $conn->query( $sql ) === TRUE ) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
}

$conn->close();
?>
</head>

<body id="page-top">

    <header class="d-flex masthead" style="width: 100%;height: 100%; background-image:url('assets/img/bg-masthead.jpg');">
        <div id="header" class="container my-auto text-center">
            <h1 class="mb-2">PHP Test Login/Register</h1>
            <h3 class="mb-5"><em>Select Login/Register</em></h3><a class="btn btn-success btn-xl js-scroll-trigger" role="button" style="color: #efb605;background-color: rgb(48,56,58);" onclick="logShow()">Login</a><a class="btn btn-success btn-xl js-scroll-trigger" role="button" style="color: #edb403;background-color: #30383a;" onclick="regShow()">Register</a>
            <div class="overlay"></div>
        </div>
        <!--REGISTER MENU START-->
        <center id="regmenu" style="display: none;width: 100%;height: 100%">
            <div class="login-dark" style="width: 50%">
                <div>
                    <h2 class="sr-only">Login Form</h2>
                    <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
                    <h1 class="text-center" style="margin-bottom: 20px;">Register</h1><input class="form-control" type="text" id="regname" name="name" placeholder="Name" style="margin-top: 0;margin-bottom: 10px;"><input class="form-control" id="regmail" type="email" name="email" placeholder="Email" style="margin-bottom: 10px;"><input class="form-control" type="password" id="regpass" name="password" placeholder="Password" style="margin-bottom: 10px;"><input class="form-control" id="regpass2" style="margin-bottom: 10px;" type="password" name="repassword" placeholder="Confirm Password">
                    <div class="form-group"><button class="btn btn-primary btn-block" onclick="registerAJAX()">Register</button></div>
                    <div class="form-group"><button class="btn btn-primary btn-block" style="margin-bottom: 20px;" onclick="back2header()">Back</button></div>
                </div>
        </center>
        <!--LOGIN MENU START-->
        <center id="logmenu" style="display: none;width: 100%;height: 100%">
            <div class="login-dark" style="width: 50%">
                <div>
                    <h2 class="sr-only">Login Form</h2>
                    <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
                    <h1 class="text-center" style="margin-bottom: 20px;">Login</h1><input class="form-control" id="logmail" type="email" name="email" placeholder="Email" style="margin-bottom: 10px;"><input class="form-control" id="logpass" type="password" name="password" placeholder="Password" style="margin-bottom: 10px;">
                    <div class="form-group"><button class="btn btn-primary btn-block" onclick="loginAJAX()">Login</button></div>
                    <div class="form-group"><button class="btn btn-primary btn-block" style="margin-bottom: 10px;" onclick="back2header()">Back</button></div>
                </div>
        </center>


        </div>


    </header>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/js/stylish-portfolio.js"></script>
    <script>
        function registerAJAX() {
            let name = document.getElementById("regname").value;
            let mail = document.getElementById("regmail").value;
            let pass = document.getElementById("regpass").value;
            let pass2 = document.getElementById("regpass2").value;
            if (pass === pass2) {
                var data = new FormData();
                data.append("name", name);
                data.append("email", mail);
                data.append("password", pass);


                var xhr = new XMLHttpRequest();


                xhr.addEventListener("readystatechange", function() {
                    if (this.readyState === 4) {
                        console.log(this.responseText);
                        if (this.responseText.trim() === "Register Successful") {
                            back2header();
                            alert(this.responseText);
                        }
                    }
                });

                xhr.open("POST", "http://localhost/dbtest/Main/reg.php");
                xhr.send(data);
            } else {
                alert("Password Confirmation Error!");
            }

        };

        function loginAJAX() {
            let mail2 = document.getElementById("logmail").value;
            let pass2 = document.getElementById("logpass").value;

            var data = new FormData();
           
            data.append("email", mail2);
            data.append("password", pass2);


            var xhr = new XMLHttpRequest();


            xhr.addEventListener("readystatechange", function() {
                if (this.readyState === 4) {
                   alert(this.responseText);
                   /* if (this.responseText == "Register Successful") {
                        back2header();
                    }*/
                }
            });

            xhr.open("POST", "http://localhost/dbtest/Main/log.php");
            xhr.send(data);


        }

        function regShow() {
            document.querySelector("#header").style.display = "none";
            document.querySelector("#logmenu").style.display = "none";
            document.querySelector("#regmenu").style.display = "block";
        }

        function logShow() {
            document.querySelector("#header").style.display = "none";
            document.querySelector("#logmenu").style.display = "block";
            document.querySelector("#regmenu").style.display = "none";
        }

        function back2header() {
            document.querySelector("#header").style.display = "block";
            document.querySelector("#logmenu").style.display = "none";
            document.querySelector("#regmenu").style.display = "none";
        }

    </script>
</body>

</html>
