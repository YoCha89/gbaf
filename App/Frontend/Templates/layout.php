<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= isset($title) ? $title : 'GBAF' ?>
    </title>
    
    <meta charset="utf-8" />
    
    <link rel="stylesheet" href="/css/Envision.css" type="text/css" />
  </head>
  
  <body>
    <div id="wrap">
      <header>
        <h1><a href="/">Portail BBAF</a></h1>
      </header>
      
      <nav>
        <ul>
          <li><a href="/">Connexion</a></li>
          <li><a href=>Besoin d'aide ?</a></li>
          <li><a href=>Mon compte</a></li>
          <li><a href=>Besoin dinspiration ?</a></li>
        </ul>
      </nav>
      
      <div id="content-wrap">
        <section id="main">
          <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
          
          <?= $content ?>
        </section>
      </div>
    
      <footer></footer>
    </div>
  </body>
</html>