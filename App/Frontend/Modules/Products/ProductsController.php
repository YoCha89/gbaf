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

    		//Les informations relatives aux likes/dislikes du produit (décompte et statut de l'utilisateur en session concernant l'expression de son avis)
    		$verdicts = $managerL-> countVerdicts($request->getdata('id'));
    		$likes = $managerL-> countLikes($request->getdata('id'));
    		$dislikes = $verdicts-$likes;

    		$allowLike = $managerL-> allowLike($request->getdata('id'), $this->app->user()->getAttribute($id));

    		//Les informations relatives aux commentaires du produit (décompte et statut de l'utilisateur en session concernant l'expression de son avis)
    		$ListComments = $managerC-> getComments($request->getdata('id'));
            $commentsNumber = $managerC-> countComments($request->getdata('id'));

    		$allowComment = $managerC-> allowComment($request->getdata('id'), $this->app->user()->getAttribute($id));

    	// Ajout des variables à afficher.
    	$this->page->addVar('title', $product['title']); 
        $this->page->addVar('product', $product);
        $this->page->addVar('allowComment', $allowComment);
        $this->page->addVar('ListComments', $ListComments);
        $this->page->addVar('commentsNumber', $commentsNumber);
        $this->page->addVar('allowLike', $allowLike);
        $this->page->addVar('likes', $likes);
        $this->page->addVar('dislikes', $dislikes);

	}

    public function executeLikeProduct (HTTPRequest $request)
    {
        $like = new Likes ([
            'employeeId' => $this->app->user()->getAttribute($id),
            'productId' => $request->getData('id'),
            'verdict' => $request->postData('verdict')
        )];

        //Saisie du manager des likes
        $managerL = $this->managers->getManagerOf('Likes');    

        //ajout en BDD
        $managerL->addLikeVerdict (Likes $like);

        //redirection pour retour sur la page du produit évalué
        $this->app->httpResponse()->redirect('show-product-'.$request->getdata('id').'.html');
    }

    public function executeCommentProduct (HTTPRequest $request)
    {
        //la présence d'un commentaire rédigé en méthode post permet de savoir si l'utilisateur à écris le commentaire et doit être redirigé vers la page produit où figurera son commentaire ou s'il doit accéder au formulaire de commentaire
        if ($request->postExists('content'))
        {
            //Création du nouveau commentaire
            $comment = new Comments ([
            'employeeId' => $this->app->user()->getAttribute($id),
            'author' => $this->app->user()->getAttribute($firstName),
            'productId' => $request->getData('id'),
            'content' => $request->postData('content')
            )];

            //Saisie du manager des commentaires
            $managerC = $this->managers->getManagerOf('comment');

            //ajout en BDD
            if($comment->isValid())
            {
                $managerC->addComment(Comments $comment);

                //redirection pour retour sur la page du produit commenté
                $this->app->httpResponse()->redirect('show-product-'.$request->getdata('id').'.html');
            }

            else
            {
                //on ajoute l'erreur paramétrée de l'entité sur la vue
                $this->page->addVar('erreurs', $comment->erreurs());
            }
            
        }  
    }
}