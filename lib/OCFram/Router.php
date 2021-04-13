<?php
namespace OCFram;
 
class Router
{
  protected $routes = [];
 
  const NO_ROUTE = 1;

  public function getRoute($action)
  {
    if (!empty($action))
    {
      if ($action == 'index')
      {
        $action = 'index';
        $module = 'Employees';
        $var = null;//Setup à nulle pour la création de la route. C'est le controller, quel que soit la route, qui se chargera des variables éventuelles 
        $matchedRoute = new Route ($module, $action, $var);
        return $matchedRoute;
      }

      else if ($action == 'createAccount')
      {
        $action = 'createAccount';
        $module = 'Employees';
        $var = null;
        $matchedRoute = new Route ($module, $action, $var);
        return $matchedRoute;
      }

      else if ($action == 'updateAccount')
      {
        $action = 'updateAccount';
        $module = 'Employees';
        $var = null;
        $matchedRoute = new Route ($module, $action, $var);
        return $matchedRoute;
      }

      else if ($action == 'updatePass')
      {
        $action = 'updatePass';
        $module = 'Employees';
        $var = null;
        $matchedRoute = new Route ($module, $action, $var);
        return $matchedRoute;
      }

      else if ($action == 'seeAccount')
      { 
        $action = 'seeAccount';
        $module = 'Employees';
        $var = null;
        $matchedRoute = new Route ($module, $action, $var);
        return $matchedRoute;
      }

      else if ($action == 'disconnect')
      {
        $action = 'disconnect';
        $module = 'Employees';
        $var = null;
        $matchedRoute = new Route ($module, $action, $var);
        return $matchedRoute;
      }

      else if ($action == 'showProducts')
      {
        $action = 'showProducts';
        $module = 'Products';
        $var = null;
        $matchedRoute = new Route ($module, $action, $var);
        return $matchedRoute;
      }

      else if ($action == 'showProduct')
      {
        $action = 'showProduct';
        $module = 'Products';
        $var = null;
        $matchedRoute = new Route ($module, $action, $var);
        return $matchedRoute;
      }

      else if ($action == 'likeProduct')
      {
        $action = 'likeProduct';
        $module = 'Products';
        $var = null;
        $matchedRoute = new Route ($module, $action, $var);
        return $matchedRoute;
      }

      else if ($action == 'commentProduct')
      {
        $action = 'commentProduct';
        $module = 'Products';
        $var = null;
        $matchedRoute = new Route ($module, $action, $var);   
        return $matchedRoute;
      }

      else
      { 
        throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
      }
    }
  
    //Route d'entrée de l'utilisateur sur le site
    else
    {
      $action = 'index';
      $module = 'Employees';
      $var = null;
      $matchedRoute = new Route ($module, $action, $var);
      return $matchedRoute;
    }
    
  }
}