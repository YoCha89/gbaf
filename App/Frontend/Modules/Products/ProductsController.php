<?php
namespace App\Frontend\Modules\Products;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Likes;
use \Entity\Comments;

class ProductsController extends BackController
{
	//Affichage des produits financiers à la disposition des salariés
	public function executeShowProducts(HTTPRequest $request)
	{
		// Ajout du titre
    	$this->page->addVar('title', 'Nos partenaires');

    	//Obtention du manager des produits
    	$managerP = $this->managers->getManagerOf('Products');

    	//Récupération des produits en BDD
    	$listProducts = $managerP->getList();

        //ajout des variables à afficher
        $this->page->addVar('listProducts', $listProducts);
	}

    //Affichage d'une page de produit unique
	public function executeShowProduct (HTTPRequest $request)
	{
    	//Obtention des managers nécessaires (produits, likes, commentaires). Les infos nécessaires de l'utilisateurs sont dans les supervariables de session.
    	$managerP = $this->managers->getManagerOf('Products');
    	$managerL = $this->managers->getManagerOf('Likes');
    	$managerC = $this->managers->getManagerOf('Comments');

    	//Récupération des données nécessaires en BDD - La gestion du like unique et commentaire unique par utilisateur est géré séparemment pour les 2 entités

		//Récupération du produit concerné
		$product = $managerP->getUnique($request->getdata('id'));

		//Gestion des informations relatives aux likes/dislikes du produit 
    		//Décompte likes et dislikes
            $verdicts = $managerL-> countVerdicts($request->getdata('id'));
    		$likes = $managerL-> countLikes($request->getdata('id'));
    		$dislikes = (int)$verdicts[0]-(int)$likes[0];

        //Vérification de l'entré d'une opinion par l'utilisateur. Selon le résultat, une interface html autorisant ou empêchant l'expression d'une opinion est affichée sur la vue 
		$allowLike = $managerL-> allowLike($request->getdata('id'), $this->app->user()->getAttribute('id'));

        if ($allowLike == "allow")//interface avec bouton cliquable
        {
            $likeOption = '<div class="IntLike">
                                <div class=boutSmartL>
                                    <span class="nbL">'.$likes[0].'</span>
                                    <form method="post" action="bootstrap.php?action=likeProduct&id='.$request->getdata('id').'&verdict=O">
                                        <button type="submit" id="boutonLike"></button>
                                    </form>
                                </div>
                                <div class=boutSmartD>  
                                    <form method="post" action="bootstrap.php?action=likeProduct&id='.$request->getdata('id').'&verdict=N">
                                        <button type="submit" id="boutonDislike"></button>
                                    </form>
                                    <span class="nbL">'.$dislikes.'</span>
                                </div>
                            </div>';
         }
        else//interface avec bouton "mort"
        {
            $likeOption = '<div class="IntLike">
                                    <div class=boutSmartL>
                                        <span class="nbL">'.$likes[0].'</span>
                                        <div class="thumbBoxL"></div>
                                    </div>
                                    <div class=boutSmartD>
                                        <div class="thumbBoxD"></div>
                                        <span class="nbL">'.$dislikes.'</span>
                                    </div>
                            </div>';
        }

		//Gestion des informations relatives aux commentaires du produit 
		$listComments = $managerC-> getComments($request->getdata('id'));//Récupération des commentaires du produit
        $commentsNumber = $managerC-> countComments($request->getdata('id'));//décompte des commentaires

        //Vérification de l'entré d'un commentaire par l'utilisateur. Selon le résultat, une interface html autorisant ou empêchant l'entrée d'un commentaire est affichée sur la vue 
		$allowComment = $managerC-> allowComment($request->getdata('id'), $this->app->user()->getAttribute('id'));
        
        if ($allowComment == 'allow')//interface avec bouton commentaire cliquable
        {
            $commentOption = '<div class=IntCom>
                <div id="nbComm">'.$commentsNumber[0].'<br/>commentaires</div>
                    <form method="post" action="bootstrap.php?action=commentProduct&id='.$request->getdata('id').'">
                        <button type="submit" class="boutonComm">Nouveau<br/>commentaire</button>
                    </form>
                </div>';
        }
         
        else// Interface bouton "mort"
        {
            $commentOption = '<div class=IntCom>
                    <div id="nbComm">'.$commentsNumber[0].'<br/>commentaires</div>
                        <p><span class="comDenied">Votre avis<br/> est enregistré</span></p>
                    </div>';
        }

    	// Ajout des variables à afficher.
    	$this->page->addVar('title', $product['title']); 
        $this->page->addVar('product', $product);       
        $this->page->addVar('listComments', $listComments);
        $this->page->addVar('commentsNumber', $commentsNumber);
        $this->page->addVar('commentOption', $commentOption);
        $this->page->addVar('likeOption', $likeOption);
        $this->page->addVar('likes', $likes);
        $this->page->addVar('dislikes', $dislikes);
	}

    public function executeLikeProduct (HTTPRequest $request)
    {

        $like = new Likes ([
            'employeeId' => $this->app->user()->getAttribute('id'),
            'productId' => $request->getData('id'),
            'verdict' => $request->getData('verdict')
        ]);

        //Saisie du manager des likes
        $managerL = $this->managers->getManagerOf('Likes');    

        //ajout en BDD
        $managerL-> addLikeVerdict($like);

        //redirection pour retour sur la page du produit évalué
        $this->app->httpResponse()->redirect('bootstrap.php?action=showProduct&id='.$request->getdata('id'));
    }

    public function executeCommentProduct (HTTPRequest $request)
    {
        //la présence d'un commentaire rédigé en méthode post permet de savoir si l'utilisateur à déja écris le commentaire ou s'il doit accéder au formulaire
        if ($request->postExists('content'))
        {
            //Création du nouveau commentaire
            $comment = new Comments ([
            'employeeId' => $this->app->user()->getAttribute('id'),
            'author' => $this->app->user()->getAttribute('firstName'),
            'productId' => $request->getData('id'),
            'content' => $request->postData('content')
            ]);

            //Saisie du manager des commentaires
            $managerC = $this->managers->getManagerOf('comments');

            //ajout en BDD
            if($comment->isValid())
            {
                $managerC->addComment($comment);

                $this->app->user()->setFlash('Votre commentaire a été enregistré !');

                //redirection pour retour sur la page du produit commenté
                $this->app->httpResponse()->redirect('bootstrap.php?action=showProduct&id='.$request->getdata('id'));
            }

            else
            {
                //on ajoute l'erreur paramétrée de l'entité sur la vue
                $this->page->addVar('erreurs', $comment->erreurs());
            }
            
        }

        //affichage du produit a commenter avec le formulaire
        else
        {
            $managerP = $this->managers->getManagerOf('Products');

            $product = $managerP->getUnique($request->getdata('id'));
            $salId = $this->app->user()->getAttribute('id');
            $firstName = $this->app->user()->getAttribute('firstName');

            $this->page->addVar('product', $product);
            $this->page->addVar('salId', $salId);
            $this->page->addVar('firstName', $firstName);
        }  
    }
}