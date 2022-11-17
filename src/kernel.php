<?php
declare(strict_types=1);
/**
 * -------------------------------
 *             le kernel
 * @author ahlem <ahlemgasmi2389@gmail.com>
 * 
 * @version 1.0.0
 * --------------------------
 */

 //chargement du routeur
require __DIR__ . "/z/routing/router.php";

 //chargement des routes dont l'application attend la reception
require __DIR__ . "/../config/routes.php";

//chargement de l'autoloader de composer
require __DIR__ ."/../vendor/autoload.php";

//Execution du routeur
$router_response=run();

dd($router_response);