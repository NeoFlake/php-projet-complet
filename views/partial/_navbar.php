<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="../users/user_board.php">EducHP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../calculette/calculette.php" <?php echo (basename($_SERVER["PHP_SELF"]) === "calculette.php") ? "aria-disabled=\"true\"" : ""; ?>>Calculette</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../conjugaison/conjugaison.php" <?php echo (basename($_SERVER["PHP_SELF"]) === "conjugaison.php") ? "aria-disabled=\"true\"" : ""; ?>>Conjugaison</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../user/user_board.php" <?php echo (basename($_SERVER["PHP_SELF"]) === "user_board.php") ? "aria-disabled=\"true\"" : ""; ?>>Tableau de bord</a>
        </li>
      </ul>
      <form action="../../src/controllers/user/deconnection_controller.php" method="get">
        <button class="btn btn-outline-primary fw-bold" type="submit">Déconnexion</button>
      </form>
    </div>
  </div>
</nav>