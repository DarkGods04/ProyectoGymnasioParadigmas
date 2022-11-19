<?php
include '../business/clienteRutinaBusiness.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente rutina</title>
    <?php
    include 'header.php';
    ?>
    <script type="text/javascript">
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar esta rutina al cliente ?");
        }
    </script>
    <h2>Crear rutina cliente</h2>
</head>

<body>

    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaCompras"></ul>
        </div>
    </form></br></br>
    <script src="../js/peticiones.js"></script>
    <script type="text/javascript" src="../js/jquery_formato.js"></script>
    <?php
    if (!isset($_POST['campo'])) {
        $_POST['campo'] = "";
        $campo = $_POST['campo'];
    }
    $campo = $_POST['campo'];

    $clienteRutina = new ClienteRutinaBusiness();
    //$rutinas = $clienteRutina->buscar($campo);
    ?>
    <div>

    </div>

    <div>
        <form name="formulario" method="POST" id="direccionform" action="../business/compraAction.php">


        <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>Cliente</th>
                        <th>Instructor</th>
                        <th>Modalidad funcional</th>
                        <th>Ejercicios</th>
                        <th>Fecha</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><imput type="text" id="" name="idCliente" value="ef"></td>
                        <td><imput type="text" id="" name="idInstructor" value=""></td>
                        <td><imput type="text" id="" name="idModalidad" value=""></td>
                        <td><imput type="text" id="" name="ejercicios" value=""></td>
                        <td><input type="date" name="fecha" id="fecha" value="<?php if(isset($_GET['fecha'])){ echo $_GET['fecha']; }?>" ></td>
                        <td><button type="submit" name="insertarCompra" id="insertarCompra" value="insertarCompra">Registrar rutina</button></td>
                    </tr>
                </tbody>
        </form>
    </div>
</body>

</html>