<?php
namespace OCFram;
 
abstract class Application
{
  protected $httpRequest;
  protected $httpResponse;
  protected $name;
  protected $user;

 
  public function __construct()
  {
    $this->httpRequest = new HTTPRequest($this);
    $this->httpResponse = new HTTPResponse($this);
    $this->user = new User($this);
   
    $this->name = 'Frontend';//Une seule option car nous ne développons que le frontend
  }

  public function getController()
  {

    $router = new Router;

    try
    {
      // On récupère la route correspondante à l'URL.
      $matchedRoute = $router->getRoute($this->httpRequest->getData('action'));
    }
    catch (\RuntimeException $e)
    {
      if ($e->getCode() == Router::NO_ROUTE)
      {
        // Si aucune route ne correspond, c'est que la page demandée n'existe pas.
        $this->httpResponse->redirect404();
      }
    }

    // On ajoute la variable éventuelle à l'objet.
    if ($this->httpRequest->getExists('var'))
    {
      $matchedRoute->setVar(getData('var'));
    }
 
    // On instancie le contrôleur.
    $controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
    return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action()); 
       
  }
 
  abstract public function run();
 
  public function httpRequest()
  {
    return $this->httpRequest;
  }
 
  public function httpResponse()
  {
    return $this->httpResponse;
  }
 
  public function name()
  {
    return $this->name;
  }
 
  public function user()
  {
    return $this->user;
  }
}