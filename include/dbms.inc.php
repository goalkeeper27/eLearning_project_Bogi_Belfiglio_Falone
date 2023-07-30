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
if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    die(phpinfo());
} else {
    echo 'Day is saved!';
}
    /*$mysql = new mysqli(
        $config['localhost']['host'],
        $config['localhost']['user'],
        $config['localhost']['passwd'],
        $config['localhost']['db_name']
    );

    if (!$mysql) {
        die('connection error');
    }*/

?>