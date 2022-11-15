<?php
include 'clienteBusiness.php';
include 'facturaBusiness.php';

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

                $clienteBusiness = new ClienteBusiness();
                $clientes = $clienteBusiness->obtener();
                $flag = 0;
                foreach ($clientes as $row) { if($row->getNombreTBCliente() == $_POST['nombre'] && $row->getActivoTBCliente() == 1 && $row->getApellido1TBCliente() == $_POST['apellido1'] && $row->getApellido2TBCliente() == $_POST['apellido2'] && $row->getTelefonoTBCliente() == $tempTelefono){  $flag = 1; } }
                    
        if($flag == 0){

            if (!is_numeric($nombre) && !is_numeric($apellido1) && !is_numeric($apellido2) && !is_numeric($genero)) {
                if (filter_var($correo, FILTER_VALIDATE_EMAIL)){
                    $cliente = new Cliente(0, $nombre, $apellido1 , $apellido2, $tempTelefono, $fechaNacimiento, $genero, $tempPeso, $tempAltura, $correo, 1);
                    $clienteBusiness = new ClienteBusiness();
                    $resultado = $clienteBusiness->insertar($cliente);

                    if ($resultado == 1) {
                        Header("Location: ../view/listarClientes.php?success=inserted");
                    } else {
                        Header("Location: ../view/listarClientes.php?error=dbError");
                    }
                } else {
                    header("location: ../view/listarClientes.php?error=emailError&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&telefono=$telefono&fechaNacimiento=$fechaNacimiento&genero=$genero&peso=$peso&altura=$altura&correo=$correo");
                }   
            } else {
                header("location: ../view/listarClientes.php?error=numberFormat&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&telefono=$telefono&fechaNacimiento=$fechaNacimiento&genero=$genero&peso=$peso&altura=$altura&correo=$correo ");
            }

        } else {
            header("location: ../view/listarClientes.php?error=duplicate&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&telefono=$telefono&fechaNacimiento=$fechaNacimiento&genero=$genero&peso=$peso&altura=$altura&correo=$correo ");
        }
        } else {
            header("location: ../view/listarClientes.php?error=emptyField&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&telefono=$telefono&fechaNacimiento=$fechaNacimiento&genero=$genero&peso=$peso&altura=$altura&correo=$correo");
        }
    } else {
       header("location: ../view/listarClientes.php?error=error&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&telefono=$telefono&fechaNacimiento=$fechaNacimiento&genero=$genero&peso=$peso&altura=$altura&correo=$correo");
    }
}


if (isset($_POST['eliminarCliente'])) {
    $facturaBusiness = new FacturaBusiness();
    $facturas = $facturaBusiness->obtener();
    $flag = 0;
    foreach ($facturas as $row) { if($row->getClienteidTBFactura() == $_POST['idCliente'] && $row->getActivoTBFactura() == 1 ){  $flag = 1; } }
        
    if($flag == 0){
        
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

        } else {
            header("location: ../view/listarClientes.php?error=relationError");
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


            $clienteBusiness = new ClienteBusiness();
            $clientes = $clienteBusiness->obtener();
            $flag = 0;
            foreach ($clientes as $row) { if($row->getNombreTBCliente() == $_POST['nombre'] && $row->getActivoTBCliente() == 1 && $row->getApellido1TBCliente() == $_POST['apellido1'] && $row->getApellido2TBCliente() == $_POST['apellido2'] && $row->getTelefonoTBCliente() == $tempTelefono ){  $flag = 1; } }
                
    if($flag == 0){

            if (!is_numeric($nombre) && !is_numeric($apellido1) && !is_numeric($apellido2) && !is_numeric($genero)) {
                if (filter_var($correo, FILTER_VALIDATE_EMAIL)){
                    $cliente = new Cliente($id, $nombre, $apellido1 , $apellido2, $tempTelefono, $fechaNacimiento, $genero, $tempPeso, $tempAltura, $correo, 1);
                    $clienteBusiness = new ClienteBusiness();
                    $resultado = $clienteBusiness->update($cliente);

                    if ($resultado == 1) {
                        Header("Location: ../view/listarClientes.php?success=update");
                    } else {
                        Header("Location: ../view/listarClientes.php?error=dbError");
                    }
                } else {
                    header("location: ../view/listarClientes.php?error=emailError");
                }
            } else {
                header("location: ../view/listarClientes.php?error=numberFormat");
            }

        } else {
            header("location: ../view/listarClientes.php?error=duplicate");
        }
        } else {
            header("location: ../view/listarClientes.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarClientes.php?error=error");
    }
}
