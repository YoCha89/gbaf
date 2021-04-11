<!--Presentation du partenaire choisi-->
<div id="principal">
	<div id="bandeauPartenaire">
		<div id="blocPartenaire">
			<img  src="<?=$product['logoUrl']?>" alt="logopartenaire" id="logoVueUnique"/>

			<h2><?= $product['title'] ?></h2>
			<span class="lienActeur"><a href="">Consultez le site du partenaire</a></span>
			<br/>
			<p><span class="prezActeur"><?= nl2br($product['description']) ?></span></p>
			<a href="bootstrap.php?action=showProducts"><div id="lienRetour">Retourner à la liste des partenaires</div></a>
		</div>
	</div>


	<!--Interface commentaires et likes-->
	<div id="avis">
		<div id="interfaceAvis">
			<?php 
			//Affichage dynamique de l'action "commenter le produit"
			echo $commentOption;

			//Affichage dynamique de la possibilité de liker/disliker le produit 
			echo $likeOption;
			?>
		</div>

		<!--Affichage des commentaires sur le produit-->
		<div class="commentaires">
			<?php 
			if (empty($listComments))
			{
				echo 'Pas de commentaire pour ce produit';
			}

			else
			{
				foreach ($listComments as $comment)
				{
					echo('<div class="commentaire">
							<p><span class="auteur">'.$comment['author'].'</span><br/>
							<span class="date">'.$comment['creationDate']->format('d/m/Y à H\hi').'</span><br/><br/>
							<span class="commentaire">'.nl2br($comment['content']).'</span>
							<hr class="separeCom"></p>
						</div>');
				}
			}  	
			?>
		</div>
	</div>
</div>