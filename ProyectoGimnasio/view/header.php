<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"><!--botones estilos -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <script>
        function confirmarVolverMenuPrincipal() {
            return confirm("¿Está seguro de que desea volver al menú principal?");
        }
    </script>

</head>

<body>
    <nav class="menugym">
        <ul>
            <li><a onclick="return confirmarVolverMenuPrincipal()" href="../index.php"> Menú principal</a></li>
        </ul>
    </nav>
</body>
<br> <br> <br>