
<h1>GBAF</h1>
<img src="" alt="logoGBAF" id="logoGBAF"/>
<h2>Acteurs & Partenaires</h2>

<?php
foreach ($listProducts as $products)
{
?>
  <img src="$products['logoUrl']" alt="logoPartenaire" id="logoPartenaire"/>
  <h3><?= $products['title'] ?></h3><br/>
  <p><?= nl2br($products['description']) ?></p><br/>
  <form method="post" action="bootstrap.php?action=showProduct&id=<?= $products['id']?>">
  <button type="submit" class="bouton">Lire la suite</button>
  </form>
<?php
}