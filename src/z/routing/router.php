<?php

declare(strict_types=1);
/**
 * --------------------------------
 *         le routeur
 * ----------------------------------
 */



/**
 * cette fonction du routeur lui permet de recuperer chaque route dont l'application
 * attend la reception via la methode "get"
 * 
 * @param string $request_route
 * @param array $action_route
 * 
 * @return void
 */

function get(string $request_route, array $action_route): void
{
    collectRoutes("GET", $request_route, $action_route);
}

/**
 * cette fonction du routeur lui permet de recuperer chaque route dont l'application
 * attend la reception via la methode "post"
 * 
 * @param string $request_route
 * @param array $action_route
 * 
 * @return void
 */

function post(string $request_route, array $action_route): void
{
    collectRoutes("POST", $request_route, $action_route);

}

/**
* cette methode collect les routes dont l'application attend la reception
* via la méthode "GET" et "POST" 
* 
* Elle stocke ensuite ces routes dans un tableau à routes en prenant soin
* de les trier par méthode d'envoi
* @param string $method
* @param string $request_route
* @param array $action_route
* @return void
*/
function collectRoutes(string $method, string $request_route, array $action_route): void
{
    //tableau de routes 
    global $routes;
    $route=[];
    
    $route[]= $request_route;
    $route[]= $action_route;

    $routes[$method][]=$route;
}
/**
 * cette function du routeur lui permet de s'executer 
 * et de retourner:
 *     -soit un tableau si les routes ont matche
 *     -soit null si les routes n'ont pas matché
 *
 * @return array|null
 */
function run() : ?array
{
   global $routes;
   
  
  foreach ($routes[$_SERVER['REQUEST_METHOD']] as $route)
  {

$request_uri = strip_tags(urldecode(parse_url(trim($_SERVER['REQUEST_URI']), PHP_URL_PATH)));
 
$request_route = $route[0];
$pattern = preg_replace("#{[a-z]+}#","([0-9a-zA-Z-_]+)", $request_route);
$pattern="#^$pattern$#";
if (preg_match($pattern,$request_uri,$matches))
{
  array_shift($matches);
  $parameters=$matches;
  
  $controller=$route[1][0];
  $method =$routes[1][1];
  if ($parameters)
  {
    return[
        "controller"=>$controller,
        "methode"=> $method,
        "parameters"=> $parameters,
    ];
  }

    return[
        "controller"=>$controller,
        "methode"=> $method,
    ];
  
}
return null;
}

}