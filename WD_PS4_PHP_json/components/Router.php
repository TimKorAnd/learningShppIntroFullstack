<?php


class Router
{
  private $routes;

  /**
   * Router constructor.
   *
   */
  public function __construct()
  {
    $routesPath = ROOT.'/config/routes.php';
    $this->routes = include($routesPath);
  }

  /**
   *
   */
  public function run()
  {
    /*echo 'class '.__CLASS__.' , method '.__FUNCTION__;
    print_r($this->routes);*/
    $uri = $this->getURI();
    //echo $uri;
    foreach ($this->routes as $uriPattern => $route) {
      if (preg_match("~$uriPattern~", $uri))
      echo "<br> $uriPattern -> $route";
    }
  }

  /**
   * @return URI string
   */
  private function getURI(): string
  {
    if (!empty($_SERVER['REQUEST_URI'])) {
      return trim($_SERVER['REQUEST_URI'], '/');
    }
    return '';
  }


}