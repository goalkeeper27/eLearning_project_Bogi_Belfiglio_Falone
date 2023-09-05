<?php

$certification_query = $mysql->query("SELECT titolo, file FROM attestato WHERE ID = $id_certification ");
$certification = $certification_query->fetch_row();

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="'. $certification[0] .'.pdf"');

// Invia il contenuto del file al browser
echo $certification[1];



?>