
<h1>GBAF</h1>
<img src="" alt="logoGBAF" id="logoGBAF"/>
<h2>Acteurs & Partenaires</h2>

<?php
foreach ($listProducts as $products)
{
?>
  <img src="$products['logoUrl']" alt="logoPartenaire" id="logoPartenaire"/>
  <h3><?= $products['title'] ?></h3>
  <p><?= nl2br($products['description']) ?></p>
  <a href="show-product-<?= $product['id']?>.html">Consultez ce produit</a>
<?php
}


