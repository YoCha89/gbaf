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
    if ($this->httpRequest->getData('action') == 'index' || $this->httpRequest->getData('action') == 'createAccount' || $this->httpRequest->getData('action') == 'updatePass')
    {
      $controller = $this->getController();
    }
    
    else if ($this->user->getAttribute('auth') == true)
    {
      $controller = $this->getController();
    }

    else
    {
      $controller = new Modules\Employees\EmployeesController($this, 'Employees', 'index');
    }

    $controller->execute();

    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send();
  }
}