<?php
$videoFilePath = 'C:/Users/acer/OneDrive/Desktop/materiale_progetto_TDW/video2.mp4'; // Percorso del tuo file video
$targetDir = 'uploads/'; // Cartella di destinazione per i file caricati
$targetFile = $targetDir . basename($videoFilePath);

// Leggi il contenuto del file video
$videoContent = file_get_contents($videoFilePath);

// Crea la cartella di destinazione se non esiste
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Scrivi il contenuto del file nella cartella di destinazione
if (file_put_contents($targetFile, $videoContent)) {
    echo "Il file è stato caricato con successo.";
} else {
    echo "Si è verificato un errore durante il caricamento del file.";
}
?>