<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 
    <title>Document</title>

    <style>

        body {
            background-image: url('img/fondo.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }

        .container{
            margin:50px 0% 0px 550px;
        }

        button{
            margin:0px 0% 0px 60px;
        }
    </style>

</head>
<body>

    <form action="guardar.php" method="post" class = 'was-validated'>

                
        <div class="container">
            <div class="card" style="width: 20rem;">
                <div class="card-header">
                    <h1 style="text-align: center;color:black;">INGRESE SUS DATOS</h1>
                </div>
                <div class="card-body">
                         <label for="validationDefault01">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
                    
                        <br>
                        <label for="validationDefault02">Contraseña</label>
                        <input type="text" class="form-control"  id="contraseña" name="contraseña" placeholder="Contraseña" required>
                    
                        <br>
                        <button type="submit" class="btn btn-primary" name="btnLogin"> 
                        <i class="fas fa-arrow-alt-circle-right"></i>  &nbsp;&nbsp;<b>Crear Usuario</b></button>
                </div>
            </div>
        </div>

    </form>

</body>
</html>