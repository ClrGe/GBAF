    <header id="header" class="border">
      <div>
        <ul class="settings">
          <?php
          if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
          ?>
          <p>
            <li class="black settings"><strong><?php echo $_SESSION['username'] . ' '; ?></strong> </li>
            <li class="black settings"><a class="black" href="parametres.php"><i></i>Paramètres du compte</a></li>
            <li class="black settings"><a class="black" href="deconnexion.php"><i></i>Deconnexion</a></li>
          </p>
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