<?php
namespace App\Frontend\Modules\Employees;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Employees;


class EmployeesController extends BackController
{
	//formulaire de connexion en guise d'entrée pour l'application. 
	public function executeIndex (HTTPRequest $request)
	{
		//on vérifie si le user arrive sur le site ou si un formulaire de connexion a été envoyé 
		if ($request->postExists('userName'))
    	{
	     	$passEntered = $request->postData('pass');
	    	$userNameEntered = $request->postData('userName');

	    	//Obtention du manager des salariés
	    	$managerE = $this->managers->getManagerOf('Employees');

	    	//Récupération des infos nécessaires en BDD
	    	$employee = $managerE->getEmployeePerUsername($userNameEntered);
	    	$registeredPass = $employee['pass'];

	    	//confirmation du mot de passe entré
	    	if(password_verify($passEntered, $registeredPass))
		    {
			    //setup de l'indicateur de confirmation de connexion
			    $this->app->user()->setAuthenticated(true);

			    //Etablissement des supervariables de session dont nous aurons usage
				$this->app->user()->setAttribute('id', $employee['id']);
			    $this->app->user()->setAttribute('userName', $employee['userName']);
			    $this->app->user()->setAttribute('firstName', $employee['firstName']);

			    $this->app->user()->setFlash('Vous êtes connecté, nous sommes ravis de votre retour !');

			    //Redirection en cas de connexion réussie
			    $this->app->httpResponse()->redirect('bootstrap.php?action=showProducts');
		    }

		    else
		    {
		    	$this->app->user()->setFlash('Votre nom d\'utilisateur ou votre mot de passe sont incorrect.');
		    }
	    }
	}


	//Création du compte
	public function executeCreateAccount (HTTPRequest $request)
	{
	    $this->page->addVar('title', 'Création du compte');

		//Obtention du manager des salariés
	    $managerE = $this->managers->getManagerOf('Employees');

		//Vérification des champs du formulaire pour savoir si le formulaire a été envoyé
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

					$this->processForm($request, $pass, $managerE);

			   		$this->app->user()->setFlash('Votre compte a été créé, bienvenue sur le portail salarié de la GBAF !');

			   		$this->app->httpResponse()->redirect('bootstrap.php?action=showProducts');//redirection page des partenaires
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

	    //Récupération des infos nécessaires en BDD. Rappel : user gère les variables de session 
	    $employee = $managerE->getEmployeePerId($this->app->user()->getAttribute('id'));

	    //ajout des infos sur la page
	    $this->page->addVar('employee', $employee);
	}


	//Mise à jour des infos du compte
	public function executeUpdateAccount (HTTPRequest $request)
	{
		$this->page->addVar('title', 'Mise à jour du compte');

		//Obtention du manager des salariés
	    $managerE = $this->managers->getManagerOf('Employees');

	    //Récupération des infos en BDD de l'utilisateur connecté 
	    $employee = $managerE->getEmployeePerId($this->app->user()->getAttribute('id'));

		//Si le champs "name" n'est pas rempli via le formulaire, l'utilisateur vient d'arriver, il faut remplir les champs par défaut avec les valeurs existantes
		if (empty ($request->postData('name')))
		{
	    	//ajout des infos sur la page
	    	$this->page->addVar('employee', $employee);
		}
		
		//Si le champs "name" est complété à l'éxécution de updateAccount, l'utilisateur a envoyé le formulaire
		else
		{
			//Avant de mettre à jour, on s'assure d'avoir un nom d'utilisateur unique. On regarde d'abord si c'est un nouveau userName
			if (!empty ($managerE->checkUserName($request->postData('userName'))))
			{
				//Si le userName n'est pas nouveau, on regarde s'il correspond à l'ancien nom de l'utilisateur. Sinon, il essaye d'utiliser un nouveau nom déja pris.
				if ($request->postData('userName') == $employee['userName'])
				{
					$pass = $employee['pass'];//la variable a été récupérée en BDD, le pass est déja crypté.

					//Fonction gérant les création et mise à jour de compte
					$this->processForm($request, $pass, $managerE);

					$this->app->user()->setFlash('Votre compte a bien été mis à jour !');

					//On redirigre sur la page "Paramètre du compte" ou l'utilisateur voit les infos à jour
					$this->app->httpResponse()->redirect('bootstrap.php?action=seeAccount'); 
				}

				else
				{
					$this->app->user()->setFlash('Ce nom d\'utilisateur n\'est pas disponible.');
				}	
			}

			//si checkUsername a renvoyer un résultat vide, sachant que l'on a remplit les champs du formulaire avec les valeurs existantes par défaut, on sait que le username est nouveau et unique
			else
			{
				$pass = $employee['pass']; //la variable a été récupérée en BDD, le pass est déja crypté.

				//Fonction gérant les création et mise à jour de compte
				$this->processForm($request, $pass, $managerE);

				$this->app->user()->setFlash('Votre compte a bien été mis à jour !');

				//On redirigre sur la page "Paramètre du compte" ou l'utilisateur voit les infos à jour
				$this->app->httpResponse()->redirect('bootstrap.php?action=seeAccount');
			}
		}
	}


	//Mise à jour du mot de passe en cas d'oubli.
	public function executeUpdatePass (HTTPRequest $request)
	{
		$this->page->addVar('title', 'Mise à jour du mot de passe');

		//Obtention du manager des salariés
	    $managerE = $this->managers->getManagerOf('Employees'); 

		//Si le champs "newPass" est rempli, l'utilisateur est intervenu sur le formulaire et on lance le script de mise à jour en BDD
		if ($request->postExists('newPass'))
		{
			$employee = $managerE->getEmployeePerUserName($request->postData('userName'));

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

	            	$managerE->updatePass($request->postData('userName'), $pass);

	            	$this->app->user()->setFlash('Votre mot de passe a bien été mis à jour !');

					//On redirigre sur la page "Paramètre du compte" ou l'utilisateur voit les infos à jour
					$this->app->httpResponse()->redirect('bootstrap.php?action=index');
	            }
            }

             else
	        {
	        	$this->app->user()->setFlash('Vous n\'avez pas entré la bonne réponse à votre question secrète.');
	        }
	    }

	     //Si le champs "newPass" n'est pas rempli, l'utilisateur vient d'arriver sur l'interface, on affiche la question
	    else
	    {
	    	//Récupération des infos de l'utilisateur en BDD 
	    	if (!empty ($request->postData('userName')))
	    	{
	    		$employee = $managerE->getEmployeePerUserName($request->postData('userName'));
	    		$this->page->addVar('employee', $employee);
	    	}

	    	else
	    	{
	    		$this->app->user()->setFlash('Entrez votre nom d\'utilisateur pour modifier votre mot de passe.');
	    		$this->app->httpResponse()->redirect('bootstrap.php?action=index');
	    	}
	    	
	    }
	}


	//Déconnexion de la session, redirection vers l'accueil
	public function executeDisconnect (HTTPRequest $request)
	{
		$this->app->user()->setAuthenticated(false);
		$this->app->user()->destroy();

		$this->app->httpResponse()->redirect('bootstrap.php?action=index'); 
	}


	//fonction permettant complétant les processus de mises à jour ou création de compte utilisateur. Les deux actions sont liées ^par cette partie de code en commun
	public function processForm(HTTPRequest $request, $pass, $managerE)
  	{
    	$formEmployee = new Employees ([
	    'name' => $request->postData('name'),
	    'firstName' => $request->postData('firstName'),
	    'userName' => $request->postData('userName'),
	    'pass' => $pass,
	    'secretQ' => $request->postData('secretQ'),
	    'secretA' => $request->postData('secretA')
		]);

	    // Si l'id existe, nous sommes dans un cas de mise à jour. L'identifiant de l'utilisateur est hydrater. 
	    $idCheck = $this->app->user()->getAttribute('id');
	    if (!empty($idCheck))
	    {
	      $formEmployee->setId($idCheck);
	    }

	    if ($formEmployee->isValid())
		{
			$managerE->saveEmployee($formEmployee);//Cette méthode va séparer à nouveau les chemin de la création et la mise à jour pour les managers

			//Une fois le compte créé/mis à jour, on connecte automatiquement l'utilisateur avec les mêmes étapes qu'à la connexion.
			$this->app->user()->setAuthenticated(true);

			$this->app->user()->setAttribute('id', $formEmployee['id']);
			$this->app->user()->setAttribute('firstName', $formEmployee['firstName']);
			$this->app->user()->setAttribute('userName', $formEmployee['userName']);
		}

	    else
		{
			//on ajoute l'erreur paramétrée de l'entité sur la vue
			$this->page->addVar('erreurs', $formEmployee->erreurs());
		}
	}
}


