 <?php
 
    // database connection

    // development architecture

    $config['localhost']['host'] = "localhost";
    $config['localhost']['user'] = "root";
    $config['localhost']['passwd'] = "";
    $config['localhost']['db_name'] = "e_learning";
    
    // deployment architecture 
    /*
    $config['sql.example.com']['host'] = "localhost";
    $config['sql.example.com']['user'] = "root";
    $config['sql.example.com']['passwd'] = "viva1felice";
    $config['sql.example.com']['db_name'] = "tdw_2223";
*/
    $mysql = new mysqli(
        $config[/*$_SERVER["SERVER_NAME"]*/ 'localhost']['host'],
        $config[/*$_SERVER["SERVER_NAME"]*/ 'localhost']['user'],
        $config[/*$_SERVER["SERVER_NAME"]*/ 'localhost']['passwd'],
        $config[/*$_SERVER["SERVER_NAME"]*/ 'localhost']['db_name']
    );

    if (!$mysql) {
        die('conection error');
    }

?>