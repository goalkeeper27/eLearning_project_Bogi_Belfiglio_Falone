<?php

if(isset($_POST['index'])){
    $index = $_POST['index'];
}else{
    $index = 1;
}

$body = new Template("skins/revision/dtml/category/body_category.html");
$number_category = $mysql->query("SELECT COUNT(*) as total_records FROM categoria");

if($number_category->num_rows > 0){
    $row = $number_category->fetch_assoc();
    $totalRecords = $row["total_records"];
}else{
    $totalRecords = 0;
}

$indici_totali = ceil($totalRecords / 6);

$content = '';

for($i = 1; $i<$indici_totali+1; $i++){
    $content.= '<li class="page-item">
                <form id="index_category_'.$i.'" method="POST" action="category.php#anchor">
                <input type="hidden" name="index" value="'.$i.'" />
                <a class="page-link" id="'.$i.'" href="#" onclick="submitCourseDetail(\'index_category_'.$i.'\')">'.$i.'</a>
                </form>
                </li>';
}
$body->setContent('index', $content);
if($index == 1){
    $min = 0;
}else{
    $min = 6*$index-5;
}
                    //Se index è 1 il min deve essere 1 e il max deve essere 6
$max = 6*$index;    // Se index è 2 il min deve essere 7 e max 12 ecc... devi trovare delle espressioni con dentro index per definire il min e max
$courses = $mysql->query("SELECT * FROM categoria LIMIT $min, $max");
while($row = $courses->fetch_assoc()){
    $id = $row['ID'];
    $category = $mysql->query("SELECT C.*, I.titolo as alt, I.file as immagine FROM Categoria C INNER JOIN Immagine I ON C.ID_immagine = I.ID WHERE C.ID = $id");

    $result_category = $category->fetch_assoc();
    $body->setContent('category_image', '<form id="category_'. $result_category["ID"] .'" method="POST" action="courses.php">
                                        <input type="hidden" name="id_category" value="'. $result_category["ID"] .'" />
                                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="#" onclick="submitCourseDetail(\'category_'. $result_category["ID"] .'\')">
                                        <img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($result_category["immagine"]) . '" alt="'. $result_category["alt"] .'">');
    $body->setContent("category_title", $result_category["nome"]);
    $body->setContent("tag_closure", "</a></form>");
}

?>