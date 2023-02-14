<?php
// Obtiene la instancia del objeto que guarda los datos de configuración
$config = Config::singleton();

// Carpetas para los Controladores, los Modelos y las Vistas
$config->set('controllersFolder', 'controllers/');
$config->set('modelsFolder', 'models/');
$config->set('viewsFolder', 'views/');

// Parámetros de conexión a la BD
// $config->set('dbhost', 'localhost');
// $config->set('dbname', 'almacen');
// $config->set('dbuser', 'super');
// $config->set('dbpass', '123456');

// Parámetros de conexión a la BD mysql://root:K3fJiO5nhrBk0L3WOzb8@containers-us-west-40.railway.app:7545/railway
//mysql -hcontainers-us-west-40.railway.app -uroot -pK3fJiO5nhrBk0L3WOzb8 --port 7545 --protocol=TCP railway
$config->set('dbhost', 'containers-us-west-40.railway.app:7545');
$config->set('dbname', 'railway');
$config->set('dbuser', 'root');
$config->set('dbpass', 'K3fJiO5nhrBk0L3WOzb8');
?>