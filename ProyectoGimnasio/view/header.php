<!DOCTYPE html>
<html lang="en">

<head>
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
    <div>
        <a onclick="return confirmarVolverMenuPrincipal()" href="index.php" style="text-decoration: none; color: blue; font-size: 150%;">Menú principal</a>
    </div>
</body>