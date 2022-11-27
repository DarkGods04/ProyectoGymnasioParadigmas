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
<style>
    a {
        color: #fff;
        text-decoration: none;
    }

    .menugym ul {
        padding: 0;
        transform: translate(-100px, 0);
    }

    .menugym ul li {
        margin: 1.5rem 5px;
        background-color: #22aeBa;
        width: 350px;
        text-align: right;
        padding: 5px;
        border-radius: 0 30px 30px 0;
        transition: all 1s;
        font-size: 16px;
    }

    .menugym ul li:hover {
        transform: translate(80px, 0);
        background: darkgray;
    }

    .menugym ul li:hover a {
        color: #000;
    }
</style>

<body>
    <nav class="menugym">
        <ul>
            <li><a onclick="return confirmarVolverMenuPrincipal()" href="../index.php"> Menú principal</a></li>
        </ul>
    </nav>
</body>

<style>
    table {
        border: none;
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 5px 10px;
        text-align: center;
        border: 1px solid #999;
    }

    tr:nth-child(1) {
        background: #dedede;
    }
</style>
<br> <br> <br>