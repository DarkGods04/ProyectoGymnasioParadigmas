
<?php
require 'data.php';
$con = new Data();
$pdo = $con->Data();
$valor = true;
if (isset($_POST["campo"]) > 0) {
    $campo = $_POST["campo"];
} else {
    $campo = $_POST["campo2"];
    $valor = false;
}
$html = "";

$sql = "SELECT tbcatalogopagometodoid, tbcatalogopagometodonombre FROM tbcatalogopagometodo WHERE (tbcatalogopagometodoactivo=1) AND (tbcatalogopagometodoid LIKE ? OR tbcatalogopagometodonombre LIKE ?) ORDER BY tbcatalogopagometodoid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    if ($valor == true) {
        $html .= "<li onclick=\"mostrar('" . $row["tbcatalogopagometodonombre"] . "')\">" . $row["tbcatalogopagometodoid"] . " - " . $row["tbcatalogopagometodonombre"] . "</li>";
    } else {
        $html .= "<li onclick=\"mostrarCampo2('" . $row["tbcatalogopagometodonombre"] . "')\">" . $row["tbcatalogopagometodoid"] . " - " . $row["tbcatalogopagometodonombre"] . "</li>";
    }
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);