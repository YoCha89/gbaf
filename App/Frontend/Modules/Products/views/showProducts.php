
<div id="bandeau">
	<div id="banniere">
	<h1>Groupement Banque-Assurance Français</h1>
	<div id="PortailPres">
		<p><span class="txtInstit">Bienvenu sur le portail de la GBAF. Votre interface privilégiée pour sélectionner le partenaire qui répondra aux ambitions de vos clients. Partagez votre expérience avec vos collaborateurs et profitez de leurs retours pour mener à bien vos projets.<span class="txtInstit"></p>
	</div>
		<img src="images/LogoGBAF.png" alt="LogoGBAF" id="LogoGBAF"/>
	</div>
</div>

<div id="prezList">
	<div id="prezText">
	<h2>Acteurs & Partenaires</h2>
	<p><span class="txtInstit">En accueillant 6 des plus grands groupes bancaire du territoire, notre fédération a su mettre à la disposition des salariés des agences françaises les meilleurs partenaires et produits financiers. Il est cependant complexe de s'orienter face une offre dense et variée. Nous savons que le produit idéal pour vos projets existes. Nous vous proposons de le trouver simplement dans cette liste grâce aux retours d'expériences de tous les collaborateurs de la GBAF !<span class="txtInstit"></p>
</div>
</div>

<div id="principal">

	<div id="listeActeurs">
		<?php
		foreach ($listProducts as $products)
		{
		?>
		<div class="acteur">
			<div class="logoPartenaire">
				<img src="<?=$products['logoUrl']?>" alt="logopartenaire" id="logoPartenaire"/>
			</div>
			
			<div class="partenaireTextuelle">
				<div class="txtActeur">
					<h3><?= $products['title'] ?></h3>
					<p><?= nl2br($products['description']) ?></p><br/>
					<a href="">Découvrez le site du partenaire</a>
				</div>

				<div class="lire">
					<form method="post" action="bootstrap.php?action=showProduct&id=<?=$products['id']?>">
						<button type="submit" class="bouton">Lire la suite</button>
					</form>
				</div>
			</div>
		</div>
		<?php
		}?>
	</div>
</div> 



