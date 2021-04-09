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

	public function executeShowProduct (HTTPRequest $request)
	{
    	//Obtention des managers nécessaires (produits, likes, commentaires). Les infos nécessaires de l'utilisateurs sont dans les supervariables de session.
    	$managerP = $this->managers->getManagerOf('Products');
    	$managerL = $this->managers->getManagerOf('Likes');
    	$managerC = $this->managers->getManagerOf('Comments');

    	//Récupération des données nécessaires en BDD - La gestion du like unique et commentaire unique par utilisateur est géré séparemment pour les 2 entités

		//le produit concerné
		$product = $managerP->getUnique($request->getdata('id'));

		//Gestion des informations relatives aux likes/dislikes du produit 
		$verdicts = $managerL-> countVerdicts($request->getdata('id'));
		$likes = $managerL-> countLikes($request->getdata('id'));
		$dislikes = (int)$verdicts-(int)$likes;

		$allowLike = $managerL-> allowLike($request->getdata('id'), $this->app->user()->getAttribute('id'));

        if ($allowLike == "allow")
        {
            $likeOption = '<span id=\'interfaceLike\'><?= $likes ?><form method="post" action="bootstrap.php?action=likeProduct&id='.$request->getdata('id').'&verdict=O"><span id=\'boutonlike\'><input type="image" id="like" alt="pouceup" src="liiiiiiiiiiiiiike.png"></span>
                </form><form method="post" action="bootstrap.php?action=likeProduct&id='.$request->getdata('id').'&verdict=N"><span id=\'boutonlike\'><input type="image" id="dislike" alt="poucedown" src="disliiiiiiiiiiiiiiiiiiiike.png"><?= $dislikes ?></span></form></span>';
         }
        else
        {
            $likeOption = '<p>Produit évalué</p><img src="liiiiiiiiiiiiiike.png" alt="imagelike" id="imagelike"><?= $likes ?> <img src="disliiiiiiiiiiiiiiiiiiiike.png" alt="imagedislike" id="imagedislike"><?= $dislikes ?>';
        }

		//Gestion des informations relatives aux commentaires du produit 
		$listComments = $managerC-> getComments($request->getdata('id'));
        $commentsNumber = $managerC-> countComments($request->getdata('id'));

		$allowComment = $managerC-> allowComment($request->getdata('id'), $this->app->user()->getAttribute('id'));
        
        if ($allowComment == 'allow')
        {
            $commentOption = '<form method="post" action="bootstrap.php?action=commentProduct&id='.$request->getdata('id').'"><button type="submit" class="bouton">Nouveau commentaire</button></form>';
        } 
        else
        {
            $commentOption = '<p>Votre avis est enregistré</p>';
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
        //la présence d'un commentaire rédigé en méthode post permet de savoir si l'utilisateur à déja écris le commentaire ou s'il doit accéder au formulaire de commentaire
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

            //le produit concerné
            $product = $managerP->getUnique($request->getdata('id'));
            $salId = $this->app->user()->getAttribute('id');
            $firstName = $this->app->user()->getAttribute('firstName');

            $this->page->addVar('product', $product);
            $this->page->addVar('salId', $salId);
            $this->page->addVar('firstName', $firstName);
        }  
    }
}