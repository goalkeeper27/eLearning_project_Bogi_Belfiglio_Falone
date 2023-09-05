<?php

$id_enrollment = $_SESSION['auth']['enrollment'];

$file_information_query = $mysql->query("SELECT C.nome, U.nome, U.cognome FROM Utente U INNER JOIN storico_iscrizioni_corso SIC ON 
                                    U.ID = SIC.ID_utente INNER JOIN Corso C ON C.ID = SIC.ID_corso WHERE SIC.ID = $id_enrollment");

$file_information = $file_information_query->fetch_row();
$course_name = $file_information[0];
$user_name = $file_information[1];
$user_surname = $file_information[2];
$certification_title = "fbb_elearning-". strtolower($course_name) ."-". $user_name."_". $user_surname;

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// Aggiungi una pagina vuota
$pdf->AddPage();

// Scrivi il contenuto nel PDF
$pdf->SetFont('helvetica', '', 16);

$html = 
        '<div style="text-align:center">'.
            '<h1 style="color:blue; position=fixed; top=5%; right:50%">FBB E-LEARNING</h1>'.
            '<h3>COURSE OF "'. $course_name .'"</h3>'.
            '<p>This is to certify that <b>'. $user_surname .' '. $user_name .'</b> has successfully completed
                the course of "<b>'.strtolower($course_name) .'</b>" with a final assessment score of <b>' .$certification_score .'/'.$maximum_score.'</b></p>';
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$certification = $pdf->Output('', 'S');


$insert_certification = $mysql->prepare("INSERT INTO attestato (titolo, file, ID_iscrizione) VALUES (?, ?, ?)");
$insert_certification->bind_param("ssi", $certification_title, $certification, $id_enrollment);

$insert_certification->execute();



//============================================================+
// END OF FILE
//=====================
?>