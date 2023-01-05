<?php

    $servername = "localhost";
    $database = "dbplazacafe";
    $username = "root";
    $password = "";


    $conn = mysqli_connect($servername, $username, $password, $database);
 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    

    $fullname = $_POST['Fullname'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $rol = $_POST['rol'];
    $h_upass = sha1($contraseña);


    if($rol == 'Administrador'){
        $rol = 'Administrator';
    }
    if($rol == 'Cliente'){
        $rol = 'Waiter';
    } 
    if($rol == 'Cajero'){
        $rol = 'Cashier';
    }
    $sql = "INSERT INTO tblusers (USERID, FULLNAME, USERNAME, PASS, ROLE) VALUES ('', '$fullname', '$usuario', '$h_upass', '$rol')";

    if (mysqli_query($conn, $sql)) {
?>
        <script>
            window.location.replace("login.php");
        </script>
<?php
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
?>

