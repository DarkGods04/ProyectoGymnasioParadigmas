<?php

include 'clientePesoBusiness.php';

if (isset($_POST['btnregistrar'])) {
    if (isset($_POST['clienteid']) && isset($_POST['clientepesofecha']) && isset($_POST['clientepesopeso']) && isset($_POST['instructorid'])) {

        $clienteid = $_POST["clienteid"];
        $clientepesofecha = $_POST["clientepesofecha"];
        $clientepeso = $_POST["clientepesopeso"];
        $instructorid = $_POST["instructorid"];

        if (strlen($clienteid) > 0 && strlen($clientepesofecha) > 0 && strlen($clientepeso) > 0 && strlen($instructorid) > 0) {

            $tempPeso = str_replace("kg","",$clientepeso);
            
            if (is_numeric($instructorid)) {

                $clientePeso = new ClientePeso(0, $clienteid, $clientepesofecha, $tempPeso, $instructorid);
                $clientePesoBusiness = new ClientePesoBusiness();
                $resultado = $clientePesoBusiness->insertar($clientePeso);

                if ($resultado == 1) {
                    Header("Location: ../view/listarClientePeso.php?success=inserted");
                } else {
                    Header("Location: ../view/listarClientePeso.php?error=dbError&clienteid=$clienteid&clientepesofecha=$clientepesofecha&clientepesopeso=$clientepeso&instructorid=$instructorid");
                }
            } else {
                header("location: ../view/listarClientePeso.php?error=numberFormat&clienteid=$clienteid&clientepesofecha=$clientepesofecha&clientepesopeso=$clientepeso&instructorid=$instructorid");
            }
        } else {
            header("location: ../view/listarClientePeso.php?error=emptyField&clienteid=$clienteid&clientepesofecha=$clientepesofecha&clientepesopeso=$clientepeso&instructorid=$instructorid");
        }
    } else {
        header("location: ../view/listarClientePeso.php?error=error&clienteid=$clienteid&clientepesofecha=$clientepesofecha&clientepesopeso=$clientepeso&instructorid=$instructorid");
    }
}
