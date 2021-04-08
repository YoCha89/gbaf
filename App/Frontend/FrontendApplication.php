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
    if ($this->user->isAuthenticated())
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