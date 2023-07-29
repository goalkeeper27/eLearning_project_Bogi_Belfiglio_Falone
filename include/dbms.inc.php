 <?php
 
    // database connection

    // development architecture

    $config['localhost']['host'] = "localhost";
    $config['localhost']['user'] = "root";
    $config['localhost']['passwd'] = "viva1felice";
    $config['localhost']['db_name'] = "tdw_2223";
    
    // deployment architecture 

    $config['sql.example.com']['host'] = "localhost";
    $config['sql.example.com']['user'] = "root";
    $config['sql.example.com']['passwd'] = "viva1felice";
    $config['sql.example.com']['db_name'] = "tdw_2223";

    $mysql = new mysqli(
        $config[$_SERVER["SERVER_NAME"]]['host'],
        $config[$_SERVER["SERVER_NAME"]]['user'],
        $config[$_SERVER["SERVER_NAME"]]['passwd'],
        $config[$_SERVER["SERVER_NAME"]]['db_name']
    );

    if (!$mysql) {
        die('conection error');
    }

?>