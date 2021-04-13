<?php
namespace App\Frontend;
 
use \OCFram\Application;
 
class FrontendApplication extends Application
{
  public function __construct()
  {
    parent::__construct();
 
    $this->name = 'Frontend';
  }
 
  public function run()
  {

    //Paramétrage des actions que l'on doit pouvoir effectuer hors connexion
    if ($this->httpRequest->getData('action') == 'index' || $this->httpRequest->getData('action') == 'updatePass')
    {
      $controller = $this->getController();
    }

    //CreateAccount ne doit pas pouvoir être effectuée par un utilisateur en session. Les variables de session fausserait l'action
    else if ($this->httpRequest->getData('action') == 'createAccount') 
    {
      if ($this->user->getAttribute('auth') == true)
      {
        $this->app->user()->setFlash('Vous devez être déconnecté pour créer un compte');
        $controller = new Modules\Employees\EmployeesController($this, 'Employees', 'seeAccount');
      }

      else
      {
        $controller = $this->getController();
      }
    }
    
    //Vérification de la connexion de l'utilisateur avant d'éxécuter l'action
    else if ($this->user->getAttribute('auth') == true)
    {
      $controller = $this->getController();
    }

    else
    { 
      //Redirection page d'entrée si l'utilisateur non connecté essaye d'effectuer une action necessitant connexion
      $controller = new Modules\Employees\EmployeesController($this, 'Employees', 'index');
    }

    $controller->execute();

    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send();
  }
}