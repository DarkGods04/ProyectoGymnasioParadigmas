<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú principal</title>
</head>

<style>
    a{color: #fff;
        text-decoration: none;
    }
    .menugym ul{
        padding: 0;
        transform: translate(-100px,0);
    }
    
     .menugym ul li{
        margin: 0.5rem 5px;
        background-color: #22aeBa;
        width: 350px;
        text-align: right;
        padding: 05px;
        border-radius: 0 30px 30px 0;
        transition: all 1s;
        font-size: 16px;
    }
    .menugym ul li:hover{
        transform: translate(80px,0);
        background: darkgray;
    }
    .menugym ul li:hover a{
        color: #000;
    }
</style>
<body>
    <h1>Proyecto Gimnasio</h1>
    <h2>Menú principal</h2>
    <nav class="menugym">
        <ul>
            <li><a href="./view/listarInstructores.php"> Instructores</a></li>
            <li><a href="./view/listarClientes.php"> Clientes</a></li>
            <li><a href="./view/listarClientePeso.php"> Clientes pesos</a></li>
            <li><a href="./view/menuListarActivos.php"> Activos</a></li>
            <li><a href="./view/listarPagoPeridiocidades.php"> Peridiocidades de pago</a></li>
            <li><a href="./view/listarPagoMetodos.php"> Métodos de pago</a></li>
            <li><a href="./view/listarImpuestoVentas.php"> Impuestos de venta</a></li>
            <li><a href="./view/listarServicios.php"> Servicios</a></li>
            <li><a href="./view/menuListaFactura.php"> Facturación</a></li>
            <li><a href="./view/listarModalidadFuncional.php"> Modalidades funcionale</a></li>
            <li><a href="./view/listarModalidadFuncionalCriterio.php"> Criterios de modalidad funcional</a></li>
            <li><a href="./view/listarEjercicios.php"> Ejercicios</a></li>
            <li><a href="./view/listarMedidasIsometricas.php"> Medidas isométricas</a></li>
            <li><a href="./view/listarGrupoMuscular.php"> Grupos musculares</a></li>
            <li><a href="./view/listarClienteTipo.php"> Tipos de clientes</a></li>
            <li><a href="./view/listarRutinaNivel.php"> Niveles de rutina</a></li>
            <li><a href="./view/listarLineasProductos.php"> Líneas de productos</a></li>
            <li><a href="./view/listarProveedores.php"> Proveedores</a></li>
            <li><a href="./view/listarProducto.php"> Productos</a></li>
            <li><a href="./view/listarCompras.php"> Compras</a></li>
            <li><a href="./view/listarCategorizacionCliente.php"> Categorizacion de clientes</a></li>
        </ul>
    </nav>
</body>

</html>