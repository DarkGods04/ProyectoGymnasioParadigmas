<?php
include 'clienteBusiness.php';

if (isset($_POST['insertarCliente'])) {
    if (isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2']) && isset($_POST['telefono']) &&
        isset($_POST['fechaNacimiento']) && isset($_POST['genero']) && isset($_POST['peso']) && isset($_POST['altura']) && isset($_POST['correo'])) {

        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $telefono = $_POST['telefono'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $genero = $_POST['genero'];
        $peso = $_POST['peso'];
        $altura = $_POST['altura'];
        $correo = $_POST['correo'];

        if (strlen($nombre) > 0 && strlen($apellido1) > 0  && strlen($apellido2) > 0 && strlen($telefono) > 0 && strlen($fechaNacimiento) > 0
            && strlen($genero) > 0 && strlen($peso) > 0  && strlen($altura) > 0  && strlen($correo) > 0) {

                $tempTelefono = str_replace("-", "", $telefono);
                $tempPeso = str_replace("Kgg", "", $peso);
                $tempAltura = str_replace("cmm", "", $altura);

            if (!is_numeric($nombre) && !is_numeric($apellido1) && !is_numeric($apellido2) && !is_numeric($genero)) {
                $cliente = new Cliente(0, $nombre, $apellido1 , $apellido2, $tempTelefono, $fechaNacimiento, $genero, $tempPeso, $tempAltura, $correo, 1);
                $clienteBusiness = new ClienteBusiness();
                $resultado = $clienteBusiness->insertar($cliente);

                if ($resultado == 1) {
                    Header("Location: ../view/listarClientes.php?success=inserted");
                } else {
                    Header("Location: ../view/listarClientes.php?error=dbError");
                }
            } else {
                header("location: ../view/listarClientes.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarClientes.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarClientes.php?error=error");
    }
}


if (isset($_POST['eliminarCliente'])) {
    if (isset($_POST['idCliente'])) {
        $id = $_POST['idCliente'];

        $clienteBusiness = new ClienteBusiness();
        $result = $clienteBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarClientes.php?success=deleted");
        } else {
            header("Location: ../view/listarClientes.php?error=dbError");
        }
    } else {
        header("location: ../view/listarClientes.php?error=error");
    }
}

if (isset($_POST['recuperarCliente'])) {
    if (isset($_POST['idCliente'])) {
        $id = $_POST['idCliente'];

        $clienteBusiness = new ClienteBusiness();
        $result = $clienteBusiness->recuperar($id);

        if ($result == 1) {
            header("Location: ../view/listarClientes.php?success=deleted");
        } else {
            header("Location: ../view/listarClientes.php?error=dbError");
        }
    } else {
        header("location: ../view/listarClientes.php?error=error");
    }
}


if (isset($_POST['actualizarCliente'])) {

    if (isset($_POST['idCliente']) && isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2']) && isset($_POST['telefono']) &&
    isset($_POST['fechaNacimiento']) && isset($_POST['genero']) && isset($_POST['peso']) && isset($_POST['altura']) && isset($_POST['correo'])) {

    $id = $_POST['idCliente'];
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $telefono = $_POST['telefono'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $genero = $_POST['genero'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $correo = $_POST['correo'];

    if (strlen($nombre) > 0 && strlen($apellido1) > 0  && strlen($apellido2) > 0 && strlen($telefono) > 0 && strlen($fechaNacimiento) > 0
        && strlen($genero) > 0 && strlen($peso) > 0  && strlen($altura) > 0  && strlen($correo) > 0) {

        $tempTelefono = str_replace("-", "", $telefono);
        $tempPeso = str_replace("Kgg", "", $peso);
        $tempAltura = str_replace("cmm", "", $altura);

        if (!is_numeric($nombre) && !is_numeric($apellido1) && !is_numeric($apellido2) && !is_numeric($genero)) {
            $cliente = new Cliente($id, $nombre, $apellido1 , $apellido2, $tempTelefono, $fechaNacimiento, $genero, $tempPeso, $tempAltura, $correo, 1);
                $clienteBusiness = new ClienteBusiness();
                $resultado = $clienteBusiness->update($cliente);

                if ($resultado == 1) {
                    Header("Location: ../view/listarClientes.php?success=update");
                } else {
                    Header("Location: ../view/listarClientes.php?error=dbError");
                }
            } else {
                header("location: ../view/listarClientes.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarClientes.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarClientes.php?error=error");
    }
}