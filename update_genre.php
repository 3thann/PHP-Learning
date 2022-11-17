<?php

    $user = "chef";
    $pass = "chefchef";
    $bdd = new PDO('mysql:host=localhost:3306;dbname=test', $user, $pass);

    $id_genre = $_POST['update_genre'];

    $sql_genre = "SELECT id, genre FROM genres WHERE id=" . $id_genre . ";";
    $genre = $bdd->query($sql_genre)->fetch();

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
    <form action="genres.php" method="POST">
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Genre</label>
          <input type="text" name="txt_genre" class="form-control" id="exampleInputEmail1" value="<?php echo($genre["genre"]); ?>">
        </div>
      </div>
      
      <input type="hidden" name="id_genre" value=<?php echo($genre["id"]); ?>>
      <div class="card-footer">
        <input type="submit" name="btn_genre" class="btn btn-primary" value="Envoyer !">
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
</style>

<?php include_once("body/import_js.php"); ?>
</body>
</html>