<?php include_once("body/code.php"); ?>

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
            <h1>BiblioTech | Livres</h1>
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Livres</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Titre</th>
                      <th>Auteur</th>
                      <th>Genre</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($livres as $livre): ?>
                      <tr>
                        <td><?php echo($livre["titre"]); ?></td>
                        <td><?php echo($livre["prenom"] . " " . $livre["nom"]); ?></td>
                        <td><?php echo($livre["genre"]); ?></td>
                        <td class="align_btn">
                          <form action="update_titre.php" method="POST">
                            <button type="submit" name="update_livre" class="btn btn-primary" value=<?php echo($livre["id"]); ?>>Modifier</button>
                          </form>
                          <form action="" method="POST">
                            <button type="submit" name="delete_livre" class="btn btn-primary" value=<?php echo($livre["id"]); ?>>Supprimer</button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    <section class="content">
    <form action="" method="POST">
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Titre</label>
          <input type="text" name="titre" class="form-control" id="exampleInputEmail1" placeholder="Titre">
        </div>
        <div class="form-group">
          <label>Auteur</label>
          <br>
          <select name="auteur_select">
            <option selected>Sélectionner votre auteur</option>
            <?php foreach($auteurs as $auteur): ?>
                <option value=<?php echo($auteur["id"]); ?>><?php echo($auteur["prenom"] . " " . $auteur["nom"]); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Genre</label>
          <br>
          <select name="genre_select">
            <option selected>Sélectionner votre genre</option>
            <?php foreach($genres as $genre): ?>
                <option value=<?php echo($genre["id"]); ?>><?php echo($genre["genre"]); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="card-footer">
        <input type="submit" class="btn btn-primary" value="Envoyer !">
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