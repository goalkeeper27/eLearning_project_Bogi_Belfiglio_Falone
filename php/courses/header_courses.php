<?php

#definiamo l'header della pagina dei corsi
$header = new Template("skins/revision/dtml/courses/header_courses.html");
if(isset($_POST['id_category'])){
    $header->setContent('path_category','<i class="fa fa-angle-double-right pt-1 px-3"></i>
                                         <a class="text-white" href="category.php">CATEGORY</a>');
}

?>