<?php

$client = ReservationData::getById($_GET["id"]);
$client->del();
Core::alert("Eliminado exitosamente!");
Core::redir("./index.php?view=reservations");

?>