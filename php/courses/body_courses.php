<?php

if(isset($_POST['index'])){
    $index = $_POST['index'];
}else{
    $index = 1;
}


$body = new Template("skins/revision/dtml/courses/body_courses.html");
$number_courses = $mysql->query("SELECT COUNT(*) as total_records FROM corso"); //Query che conta il numero di corsi totali che poi salverò il numero in $totalRecords

if($number_courses->num_rows > 0){
    $row = $number_courses->fetch_assoc();
    $totalRecords = $row["total_records"];
}else{
    $totalRecords = 0;
}

$total_index = ceil($totalRecords / 6); //approssimo per eccesso il risultato, se ad esempio ho 7 records, mi serviranno 2 indici totali

$id_category_value = isset($_POST['id_category']) ? $_POST['id_category'] : '';

//index check for view
if ($total_index <= 3) {
    for ($i = 1; $i <= $total_index; $i++) {
        if ($i == $index) {
            $content = ' <li class="page-item active">
            <form id="index_' . $i . '" method="POST" action="courses.php#anchor">
                <input type="hidden" name="index" value="' . $i . '" />';
            if (!empty($id_category_value)) {
            $content .= '<input type="hidden" name="id_category" value="' . $id_category_value . '" />';
            }
            $content .= '<a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
            </form>
            </li>';
            $body->setContent('index', $content);
        } else {
            $content = ' <li class="page-item">
            <form id="index_' . $i . '" method="POST" action="courses.php#anchor">
                <input type="hidden" name="index" value="' . $i . '" />';

            if (!empty($id_category_value)) {
            $content .= '<input type="hidden" name="id_category" value="' . $id_category_value . '" />';
            }

            $content .= '<a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
            </form>
            </li>';

            $body->setContent('index', $content);
        }
    }

} else if ($total_index > 3 && $index <= 2) {
    for ($i = 1; $i <= 3; $i++) {
        if ($i == $index) {
            $content = ' <li class="page-item active">
            <form id="index_' . $i . '" method="POST" action="courses.php#anchor">
                <input type="hidden" name="index" value="' . $i . '" />';
            if (!empty($id_category_value)) {
            $content .= '<input type="hidden" name="id_category" value="' . $id_category_value . '" />';
            }
            $content .= '<a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                        </form>
                    </li>';
            $body->setContent('index', $content);
        } else {
            $content = ' <li class="page-item">
            <form id="index_' . $i . '" method="POST" action="courses.php#anchor">
                <input type="hidden" name="index" value="' . $i . '" />';
            if (!empty($id_category_value)) {
            $content .= '<input type="hidden" name="id_category" value="' . $id_category_value . '" />';
            }
            $content .= '<a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                        </form>
                    </li>';
            $body->setContent('index', $content);
        }
    }

    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');
    $content1 = ' <li class="page-item">
    <form id="index_' . $total_index . '" method="POST" action="courses.php#anchor">
        <input type="hidden" name="index" value="' . $total_index . '" />';
    if (!empty($id_category_value)) {
    $content1 .= '<input type="hidden" name="id_category" value="' . $id_category_value . '" />';
    }
    $content1 .= '<a class="page-link" id="' . $total_index . '" href="#" onclick="submitCourseDetail(\'index_' . $total_index . '\')">' . $total_index . '</a>
                </form>
            </li>';
    $body->setContent('index', $content1);
} else if ($total_index > 3 && ($index > 2 && $index < ($total_index - 1))) {
    $content = ' <li class="page-item">
    <form id="index_1" method="POST" action="courses.php#anchor">
        <input type="hidden" name="index" value="1" />';
    if (!empty($id_category_value)) {
    $content .= '<input type="hidden" name="id_category" value="' . $id_category_value . '" />';
    }
    $content .= '<a class="page-link" id="1" href="#" onclick="submitCourseDetail(\'index_1\')">1</a>
                </form>
            </li>';
    $body->setContent('index', $content);
    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');

    for ($i = $index - 1; $i <= $index + 1; $i++) {
        if ($i == $index) {
            $content1 = ' <li class="page-item active">
            <form id="index_' . $i . '" method="POST" action="courses.php#anchor">
                <input type="hidden" name="index" value="' . $i . '" />';
            if (!empty($id_category_value)) {
            $content1 .= '<input type="hidden" name="id_category" value="' . $id_category_value . '" />';
            }
            $content1 .= '<a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                        </form>
                    </li>';
            $body->setContent('index', $content1);
            
        } else {
            $content1 = ' <li class="page-item">
            <form id="index_' . $i . '" method="POST" action="courses.php#anchor">
                <input type="hidden" name="index" value="' . $i . '" />';
            if (!empty($id_category_value)) {
            $content1 .= '<input type="hidden" name="id_category" value="' . $id_category_value . '" />';
            }
            $content1 .= '<a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                        </form>
                    </li>';
            $body->setContent('index', $content1);
        }
    }

    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');
    $content2 = ' <li class="page-item">
    <form id="index_' . $total_index . '" method="POST" action="courses.php#anchor">
        <input type="hidden" name="index" value="' . $total_index . '" />';
    if (!empty($id_category_value)) {
    $content2 .= '<input type="hidden" name="id_category" value="' . $id_category_value . '" />';
    }
    $content2 .= '<a class="page-link" id="' . $total_index . '" href="#" onclick="submitCourseDetail(\'index_' . $total_index . '\')">' . $total_index . '</a>
                </form>
            </li>';
    $body->setContent('index', $content2);
} else {
    $content = ' <li class="page-item">
    <form id="index_1" method="POST" action="courses.php#anchor">
        <input type="hidden" name="index" value="1" />';
    if (!empty($id_category_value)) {
    $content .= '<input type="hidden" name="id_category" value="' . $id_category_value . '" />';
    }
    $content .= '<a class="page-link" id="1" href="#" onclick="submitCourseDetail(\'index_1\')">1</a>
                </form>
            </li>';
    $body->setContent('index', $content);
    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');

    for ($i = $total_index - 2; $i <= $total_index; $i++) {
        if ($i == $index) {
            $content1 = ' <li class="page-item active">
            <form id="index_' . $i . '" method="POST" action="courses.php#anchor">
                <input type="hidden" name="index" value="' . $i . '" />';
            if (!empty($id_category_value)) {
            $content1 .= '<input type="hidden" name="id_category" value="' . $id_category_value . '" />';
            }
            $content1 .= '<a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                        </form>
                    </li>';
            $body->setContent('index', $content1);
        } else {
            $content1 = ' <li class="page-item">
            <form id="index_' . $i . '" method="POST" action="courses.php#anchor">
                <input type="hidden" name="index" value="' . $i . '" />';
            if (!empty($id_category_value)) {
            $content1 .= '<input type="hidden" name="id_category" value="' . $id_category_value . '" />';
            }
            $content1 .= '<a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                        </form>
                    </li>';
            $body->setContent('index', $content1);
        }
    }

}

$min = 6*$index-6;

if(isset($_POST['id_category'])){
    $id_category = $_POST['id_category'];
    $name_category = $mysql->query("SELECT * FROM Categoria WHERE ID = $id_category");
    $result_category = $name_category->fetch_assoc();
    $body->setContent('title_courses','<h1 class="display-4">Courses in category: "'.$result_category["nome"].'"</h1>');
    $courses = $mysql->query("SELECT C.* FROM corso C INNER JOIN Categoria Cat ON C.ID_categoria = Cat.ID WHERE C.ID_categoria = $id_category LIMIT $min, 6");
}else{
    $body->setContent('title_courses','<h1 class="display-4">Discover all our courses</h1>');
    $courses = $mysql->query("SELECT * FROM corso LIMIT $min, 6");
}
while($row = $courses->fetch_assoc()){
    $id = $row['ID'];
    $course = $mysql->query("SELECT C.*, I.titolo as alt, I.file as immagine, IST.nome as nome_istruttore, IST.cognome as cognome_istruttore FROM 
    Corso C INNER JOIN Immagine I ON C.ID_immagine = I.ID INNER JOIN Istruttore IST ON C.ID_istruttore = IST.ID 
    WHERE C.ID = $id");

    $result_course = $course->fetch_assoc();
    $body->setContent('course_image', '<img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($result_course["immagine"]) . '" alt="'. $result_course["alt"] .'">');
    $body->setContent("course_title", $result_course["nome"]);
    $body->setContent("instructor_course", $result_course["nome_istruttore"]." ".$result_course["cognome_istruttore"]);
    $body->setContent("price_course", $result_course["prezzo"]);
    $body->setContent("course_detail", ' <form id="'. $result_course["ID"] .'" method="POST" action="course.php">
                                            <input type="hidden" name="id_course" value="'. $result_course["ID"] .'" />
                                                <a class="btn btn-primary" href="#" onclick="submitCourseDetail('. $result_course["ID"] .')">
                                                    Course Detail
                                                </a>
                                        </form>');

}

?>
