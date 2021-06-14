    <header id="header" class="border">
      <div>
        <ul class="settings">
          <?php
          if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
          ?>
          <div class="bg-black"><p>
            <li class="settings"><a class="red" href="parametres.php"><strong><?php echo $_SESSION['username'] . ' '; ?></strong> </a></li>
            <li class="settings"><a class="black" href="parametres.php"><i></i>Paramètres du compte</a></li>
            <li class="settings"><a class="black" href="deconnexion.php"><i></i>Deconnexion</a></li>
          </p></div>
          <?php
          } else {
          ?>
          <p> Veuillez vous connecter </p>
          <?php
          }
          ?>
        </ul>
      </div>
      <a href="index.php"><img src="img/logo.png" alt="GBAF" class="gbaf"></a>
    </header>
