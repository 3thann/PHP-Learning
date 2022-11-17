<?php

    $user = "chef";
    $pass = "chefchef";
    $bdd = new PDO('mysql:host=localhost:3306;dbname=test', $user, $pass);

    $id_livre = $_POST['update_livre'];

    $sql_livre = "SELECT livres.id, livres.titre, livres.auteur_id, livres.genre_id, auteurs.nom, auteurs.prenom, genres.genre 
    FROM livres INNER JOIN auteurs ON livres.auteur_id = auteurs.id INNER JOIN genres ON livres.genre_id = genres.id WHERE livres.id=" . $id_livre . ";";
    $livre = $bdd->query($sql_livre)->fetch();
    $sql_auteurs = "SELECT id, nom, prenom FROM auteurs;";
    $auteurs = $bdd->query($sql_auteurs)->fetchAll();
    $sql_genres = "SELECT id, genre FROM genres;";
    $genres = $bdd->query($sql_genres)->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<!-- Header -->
<?php include_once("body/header.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include_once("body/menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>BiblioTech</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">BiblioTech</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <form action="livres.php" method="POST">
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Titre</label>
          <input type="text" name="txt_livre" class="form-control" id="exampleInputEmail1" value="<?php echo($livre["titre"]); ?>">
          <input type="hidden" name="id_livre" value=<?php echo($livre["id"]); ?>>
          <input type="hidden" name="auteur_livre" value=<?php echo($livre["auteur_id"]); ?>>
          <input type="hidden" name="genre_livre" value=<?php echo($livre["genre_id"]); ?>>
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">Auteur</label>
        <select name="auteur_select">
            <option selected value=<?php echo($livre["auteur_id"]); ?>><?php echo($livre["prenom"] . " " . $livre["nom"]); ?></option>
            <?php foreach($auteurs as $auteur): ?>
                <option value=<?php echo($auteur["id"]); ?>><?php echo($auteur["prenom"] . " " . $auteur["nom"]); ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">Genre</label>
        <select name="genre_select">
            <option selected value=<?php echo($livre["genre_id"]); ?>><?php echo($livre["genre"]); ?></option>
            <?php foreach($genres as $genre): ?>
                <option value=<?php echo($genre["id"]); ?>><?php echo($genre["genre"]); ?></option>
            <?php endforeach; ?>
        </select>
        </div>
      </div>
      <div class="card-footer">
        <input type="submit" name="btn_livre" class="btn btn-primary" value="Envoyer !"/>
      </div>
    </form>
    </section>
    <!-- /.content -->
    
  </div>

<?php include_once("body/footer.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
<!-- ./wrapper -->

<style>
    .align_btn{
      display: flex;
      justify-content: space-evenly; 
    }

    select{
      width: 100%;
      border-radius: 3px;
    }
</style>

<?php include_once("body/import_js.php"); ?>
</body>
</html>