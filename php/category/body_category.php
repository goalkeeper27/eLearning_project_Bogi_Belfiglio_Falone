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

$total_index = ceil($totalRecords / 6);

//index check for view
if ($total_index <= 3) {
    for ($i = 1; $i <= $total_index; $i++) {
        if ($i == $index) {
            $body->setContent('index', ' <li class="page-item active">
                                    <form id="index_category_' . $i . '" method="POST" action="category.php#anchor">
                                        <input type="hidden" name="index" value="' . $i . '" />
                                        <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_category_' . $i . '\')">' . $i . '</a>
                                    </form>
                                    </li>');
        } else {
            $body->setContent('index', ' <li class="page-item">
                                    <form id="index_category_' . $i . '" method="POST" action="category.php#anchor">
                                        <input type="hidden" name="index" value="' . $i . '" />
                                        <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_category_' . $i . '\')">' . $i . '</a>
                                    </form>
                                    </li>');
        }
    }

} else if ($total_index > 3 && $index <= 2) {
    for ($i = 1; $i <= 3; $i++) {
        if ($i == $index) {
            $body->setContent('index', ' <li class="page-item active">
                                    <form id="index_category_' . $i . '" method="POST" action="category.php#anchor">
                                        <input type="hidden" name="index" value="' . $i . '" />
                                        <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_category_' . $i . '\')">' . $i . '</a>
                                    </form>
                                    </li>');
        } else {
            $body->setContent('index', ' <li class="page-item">
                                    <form id="index_category_' . $i . '" method="POST" action="category.php#anchor">
                                        <input type="hidden" name="index" value="' . $i . '" />
                                        <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_category_' . $i . '\')">' . $i . '</a>
                                    </form>
                                    </li>');
        }
    }

    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');
    $body->setContent('index', ' <li class="page-item">
                                    <form id="index_category_' . $total_index . '" method="POST" action="category.php#anchor">
                                        <input type="hidden" name="index" value="' . $total_index . '" />
                                        <a class="page-link" id="' . $total_index . '" href="#" onclick="submitCourseDetail(\'index_category_' . $total_index . '\')">' . $total_index . ' </a>
                                    </form>
                                    </li>');
} else if ($total_index > 3 && ($index > 2 && $index < ($total_index - 1))) {
    $body->setContent('index', ' <li class="page-item">
                                    <form id="index_category_1" method="POST" action="category.php#anchor">
                                        <input type="hidden" name="index" value="1" />
                                        <a class="page-link" id="1" href="#" onclick="submitCourseDetail(\'index_category_1\')">1</a>
                                    </form>
                                    </li>');
    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');

    for ($i = $index - 1; $i <= $index + 1; $i++) {
        if ($i == $index) {
            $body->setContent('index', ' <li class="page-item active">
                                        <form id="index_category_' . $i . '" method="POST" action="category.php#anchor">
                                            <input type="hidden" name="index" value="' . $i . '" />
                                            <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_category_' . $i . '\')">' . $i . '</a>
                                        </form>
                                        </li>');
        } else {
            $body->setContent('index', ' <li class="page-item">
                                        <form id="index_category_' . $i . '" method="POST" action="category.php#anchor">
                                            <input type="hidden" name="index" value="' . $i . '" />
                                            <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_category_' . $i . '\')">' . $i . '</a>
                                        </form>
                                        </li>');
        }
    }

    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');
    $body->setContent('index', ' <li class="page-item">
                                    <form id="index_category_' . $total_index . '" method="POST" action="category.php#anchor">
                                        <input type="hidden" name="index" value="' . $total_index . '" />
                                        <a class="page-link" id="' . $total_index . '" href="#" onclick="submitCourseDetail(\'index_category_' . $total_index . '\')">' . $total_index . '</a>
                                    </form>
                                    </li>');



} else {
    $body->setContent('index', ' <li class="page-item">
                                    <form id="index_category_1" method="POST" action="category.php#anchor">
                                        <input type="hidden" name="index" value="1" />
                                        <a class="page-link" id="1" href="#" onclick="submitCourseDetail(\'index_category_1\')">1</a>
                                    </form>
                                    </li>');
    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');

    for ($i = $total_index - 2; $i <= $total_index; $i++) {
        if ($i == $index) {
            $body->setContent('index', ' <li class="page-item active">
                                        <form id="index_category_' . $i . '" method="POST" action="category.php#anchor">
                                            <input type="hidden" name="index" value="' . $i . '" />
                                            <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_category' . $i . '\')">' . $i . '</a>
                                        </form>
                                        </li>');
        } else {
            $body->setContent('index', ' <li class="page-item">
                                        <form id="index_category_' . $i . '" method="POST" action="category.php#anchor">
                                            <input type="hidden" name="index" value="' . $i . '" />
                                            <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_category_' . $i . '\')">' . $i . '</a>
                                        </form>
                                        </li>');
        }
    }

}


$min = 6*$index-6;

$courses = $mysql->query("SELECT * FROM categoria LIMIT $min, 6");
while($row = $courses->fetch_assoc()){
    $id = $row['ID'];
    $category = $mysql->query("SELECT C.*, R.nome as nome_responsabile, R.cognome as cognome_responsabile, I.titolo as alt, I.file as immagine FROM Categoria C INNER JOIN Immagine I ON C.ID_immagine = I.ID INNER JOIN Responsabile R ON 
    C.ID_responsabile = R.ID WHERE C.ID = $id");

    $result_category = $category->fetch_assoc();
    $body->setContent('category_image', '<img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($result_category["immagine"]) . '" alt="'. $result_category["alt"] .'">');
    $body->setContent("category_title", $result_category["nome"]);
    $body ->setContent("category_manager", $result_category['nome_responsabile']." ".$result_category['cognome_responsabile']);
    $body->setContent("category_detail", '<form id="category_'. $result_category["ID"] .'" method="POST" action="courses.php">
                                            <input type="hidden" name="id_category" value="'. $result_category["ID"] .'" />
                                                <a class="btn btn-primary" href="#" onclick="submitCourseDetail(\'category_'. $result_category["ID"] .'\')">
                                                    Category Detail
                                                </a>
                                        </form>');
}

?>