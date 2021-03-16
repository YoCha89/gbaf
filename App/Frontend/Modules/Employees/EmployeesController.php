<?php
namespace App\Frontend\Modules\Users;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Users;
use \Entity\Employees;

class UsersController extends BackController
{
	//formulaire de connexion en guise d'entrée pour l'application. Etablissement des variables de session. Retour sur index avec message d'erreur si co à échoué, Redirection showproduct si ok
	public function executeIndex (HTTPRequest $request)
	{
		//on vérifie si le user arrive sur la page ou a envoyé le formulaire de connexion
		if ($request->postExists('userName'))
    	{
	     	$passEntered = password_hash($request->postData('pass'), PASSWORD_DEFAULT);
	    	$userNameEntered = $request->postData('userName');

	    	//Obtention du manager des salariés
	    	$managerE = $this->managers->getManagerOf('Employees');

	    	//Récupération des infos nécessaires en BDD
	    	$registeredPass = $managerE->getEmployeePass($userNameEntered);

	    	//confirmation du mot de passe
	    	if ($passEntered == $registeredPass)
		    {
			    //setup de l'indicateur de connexion effective
			    $this->app->user()->setAuthenticated(true);

			    //Etablissement des supervariables de session dont nous aurons usage
				$this->app->user()->setAttribute($id, $employee['id']);;
			    $this->app->user()->setAttribute($firstName, $employee['firstName']);
			    $this->app->user()->setFlash('Vous êtes connecté, nous sommes ravis de votre retour !');

			    //Redirection en cas de connexion
			    $this->app->httpResponse()->redirect('show-products.html');
		    }

		    else
		    {
		    	$this->app->user()->setFlash('Votre nom d\'utlisateur ou votre mot de passe sont incorrect.');
		    }
	    }
	}


	//Création du compte
	public function executeCreateAccount (HTTPRequest $request)
	{
		//Obtention du manager des salariés
	    $managerE = $this->managers->getManagerOf('Employees');

		//Vérification des champs du formulaire
		if ($request->postExists('name'))
		{
			//Vérification de la disponibilité de l'alias
			if (!empty ($managerE->checkUserName($request->postData('userName'))))
			{

				$this->app->user()->setFlash('Ce nom d\'utilisateur n\'est pas disponible.');
			}

			else
			{
				//Vérification concordance des 2 pass entrés avant création en BDD
				if ( $request->postData('pass') != $request->postData('confPass'))
				{

				$this->app->user()->setFlash('Vous avez saisie 2 mots de passe différents.');
				}

				else
				{
					//cryptage du pass
					$pass = password_hash($request->postData('pass'), PASSWORD_DEFAULT);

					//Fonction gérant les création et mise à jour de compte
					$this->processForm($request);

			   		$this->app->user()->setFlash('Votre compte a été créé, bienvenue sur le portail salarié de la GBAF !');

			   		$this->app->httpResponse()->redirect('show-products.html');
				}
			}
		}
	}


	//Voir les informations de son compte
	public function executeSeeAccount (HTTPRequest $request)
	{
		// Ajout du titre.
    	$this->page->addVar('title', 'Paramètre du compte');

    	//Obtention du manager des salariés
	    $managerE = $this->managers->getManagerOf('Employees');

	    //Récupération des infos nécessaires en BDD
	    $employee = $managerE->getEmployeePerId($this->app->user()->getAttribute($id));

	    //ajout des infos sur la page
	    $this->page->addVar('employee', $employee);
	}


	//Mise à jour des infos du compte
	public function executeUpdateAccount (HTTPRequest $request)
	{
		//Si le champs "name" n'est pas rempli via le formulaire, l'utilisateur vient d'arriver, il faut remplir les champs par défaut
		if (!= $request->postExists('name')))
		{
	    	//ajout des infos sur la page
	    	$this->page->addVar('employee', $employee);
		}
		
		//Si le champs "name" est complété à l'éxécution de updateAccount, l'utilisateur a envoyé le formulaire à jour
		else
		{
			//Obtention du manager des salariés
	    	$managerE = $this->managers->getManagerOf('Employees');

	    	//Récupération des infos en BDD de l'utilisateur connecté 
	   		$employee = $managerE->getEmployeePerId($this->app->user()->getAttribute($id));

			//Avant de mettre à jour, on s'assure d'avoir un nom d'utilisateur inchangé ou unique. 
			if (!empty ($managerE->checkUserName($request->postData('userName')))
			{
				if ($request->postData('userName') == $employee['userName'])))
				{
					$id = $employee['id']
					$pass = $employee['pass'] //la variable a été récupérée en BDD, le pass est déja crypté.

					//Fonction gérant les création et mise à jour de compte
					$this->processForm($request);

					$this->app->user()->setFlash('Votre compte a bien été mis à jour !');

					//On redirigre sur la page "Paramètre du compte" ou l'utilisateur voit les infos à jour
					$this->app->httpResponse()->redirect('see-account-'.$id.'.html');
				}

				else
				{
					$this->app->user()->setFlash('Ce nom d\'utilisateur n\'est pas disponible.');
				}
				
			}

			else
			{
				$id = $employee['id']
				$pass = $employee['pass'] //la variable a été récupérée en BDD, le pass est déja crypté.

				//Fonction gérant les création et mise à jour de compte
				$this->processForm($request);

				$this->app->user()->setFlash('Votre compte a bien été mis à jour !');

				//On redirigre sur la page "Paramètre du compte" ou l'utilisateur voit les infos à jour
				$this->app->httpResponse()->redirect('see-account-'.$id.'.html');
			}
		}

	}


	//Mise à jour du mot de passe en cas d'oubli. Si postexist, process et redirection. Sinon, affichage formulaire. Message d'erreur à prévoir
	public function executeUpdatePass (HTTPRequest $request)
	{
		//Obtention du manager des salariés
	    $managerE = $this->managers->getManagerOf('Employees');

	    //Récupération des infos de l'utilisateur en BDD
	    $employee = $managerE->getEmployeePerId($this->app->user()->getAttribute($id));

		//Si le champs "newPass" n'est pas rempli via le formulaire à l'éxécution de updatePass, l'utilisateur vient d'arriver sur l'interface. Sinon, on lance le script de mise à jour en BDD
		if (!= $request->postExists('newPass')))
		{
			//Vérification de la réponse secrète de l'utilisateur
			if ($request->postData('secretA') == $employee['secretA'])
			{
				//Vérification concordance des 2 pass entrés avant création en BDD
				if ($request->postData('newPass') != $request->postData('ConfNewPass'))
				{
					$this->app->user()->setFlash('Vous avez saisie 2 mots de passe différents.');
				}

				else
				{
					$pass = password_hash($request->postData('newPass'), PASSWORD_DEFAULT);

	            	$managerE = $this->managers->updatePass($this->app->user()->getAttribute($id), $pass);

	            	$this->app->user()->setFlash('Votre mot de passe a bien été mis à jour !');

					//On redirigre sur la page "Paramètre du compte" ou l'utilisateur voit les infos à jour
					$this->app->httpResponse()->redirect('see-account-'.$id.'.html');
	            }
	        }

	        else
	        {
	        	$this->app->user()->setFlash('Vous n\'avez pas entré la bonne réponse à votre question secrète.');
	        }
		}
	}


	//Déconnexion de la session, redirection vers index
	public function executeDisconnect (HTTPRequest $request)
	{
		//setup de l'indicateur de connexion à "false"
		$this->app->user()->setAuthenticated(false);

		$this->app->httpResponse()->redirect('index.html');
	}


	//fonction permettant de poursuivre les processus de mises à jour ou création de compte utilisateur
	public function processForm(HTTPRequest $request)
  	{
	    $employee = new Employees ([
	    'name' => $request->postData('name'),
	    'firstName' => $request->postData('firstName'),
	    'userName' => $request->postData('userName'),
	    'pass' => $pass,
	    'secretQ' => $request->postData('secretQ'),
	    'secretA' => $request->postData('secretA')
		)];
	 
	    // L'identifiant de la news est transmis si on veut la modifier.
	    if (isset($id))
	    {
	      $employee->setId($id);
	    }
	 
	    if ($employee->isValid())
		{
			$managerE = $this->managers->saveEmployee($employee);

			//Une fois le compte créé/mis à jour, on connecte automatiquement l'utilisateur avec les mêmes étapes
			$this->app->user()->setAuthenticated(true);

			$this->app->user()->setAttribute($id, $employee['id']);
			$this->app->user()->setAttribute($firstName, $employee['firstName']);
		}

	    else
		{
			//on ajoute l'erreur paramétrée de l'entité sur la vue
			$this->page->addVar('erreurs', $employee->erreurs());
		}
	}
}


