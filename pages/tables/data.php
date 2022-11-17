<?php
    function verif($valeur) {
        if(isset($valeur) && !empty($valeur) && !is_null(($valeur))) {
            return true;
        }
        return false;
    }

    $user = "chef";
    $pass = "chefchef";
    $bdd = new PDO('mysql:host=localhost:3306;dbname=test', $user, $pass);

    // ------------------------------------------------------

    if(isset($_POST['delete_livre'])) {
        $sql_delete = "DELETE FROM livres WHERE id=:id";
        $stmt = $bdd->prepare($sql_delete);
        $stmt->execute(['id' => $_POST["delete_livre"]]);
    }

    if(isset($_POST['delete_auteur'])) {
        $sql_delete = "DELETE FROM auteurs WHERE id=:id";
        $stmt = $bdd->prepare($sql_delete);
        $stmt->execute(['id' => $_POST["delete_auteur"]]);
    }

    if(isset($_POST['delete_genre'])) {
        $sql_delete = "DELETE FROM genres WHERE id=:id";
        $stmt = $bdd->prepare($sql_delete);
        $stmt->execute(['id' => $_POST["delete_genre"]]);
    }

    // ------------------------------------------------------

    if(isset($_POST['btn_livre'])) {
        $sql_update_livre = "UPDATE livres SET titre=:titre, auteur_id=:auteur_id, genre_id=:genre_id WHERE id=:id";
        $stmt = $bdd->prepare($sql_update_livre);
        $stmt->execute(['titre' => $_POST["txt_livre"], 'id' => $_POST["id_livre"], 'auteur_id' => $_POST["auteur_select"], 'genre_id' => $_POST["genre_select"]]);
    }

    if(isset($_POST['btn_auteur'])) {
        $sql_update_auteur = "UPDATE auteurs SET nom=:nom, prenom=:prenom WHERE id=:id";
        $stmt = $bdd->prepare($sql_update_auteur);
        $stmt->execute(['nom' => $_POST["nom_auteur"], 'prenom' => $_POST["prenom_auteur"], 'id' => $_POST["id_auteur"]]);
    }

    if(isset($_POST['btn_genre'])) {
        $sql_update_genre = "UPDATE genres SET genre=:genre WHERE id=:id";
        $stmt = $bdd->prepare($sql_update_genre);
        $stmt->execute(['genre' => $_POST["txt_genre"], 'id' => $_POST["id_genre"]]);
        }

    // ------------------------------------------------------

    if( verif($_POST) ) {
        if( verif($_POST["titre"]) ) {
            $sql_insert_livre = "INSERT INTO livres VALUES (NULL, :titre, :auteur_id, :genre_id)";
            $stmt_livre = $bdd->prepare($sql_insert_livre);
            $stmt_livre->execute(['titre' => $_POST["titre"], 'auteur_id' => $_POST["auteur_select"], 'genre_id' => $_POST["genre_select"]]);
        }
    }

    if( verif($_POST) ) {
        if( verif($_POST["nom"]) ) {
            $sql_insert_auteur = "INSERT INTO auteurs VALUES (NULL, :nom, :prenom)";
            $stmt_auteur = $bdd->prepare($sql_insert_auteur);
            $stmt_auteur->execute(['nom' => $_POST["nom"], 'prenom' => $_POST["prenom"]]);
        }
    }

    if( verif($_POST) ) {
        if( verif($_POST["genre"]) ) {
            $sql_insert_genre = "INSERT INTO genres VALUES (NULL, :genre)";
            $stmt_genre = $bdd->prepare($sql_insert_genre);
            $stmt_genre->execute(['genre' => $_POST["genre"]]);
        }
    }

    // ------------------------------------------------------

    $sql_livres = "SELECT livres.id, livres.titre, auteurs.nom, auteurs.prenom, genres.genre 
    FROM livres INNER JOIN auteurs ON livres.auteur_id = auteurs.id INNER JOIN genres ON livres.genre_id = genres.id;";
    $livres = $bdd->query($sql_livres)->fetchAll();
    $sql_auteurs = "SELECT id, nom, prenom FROM auteurs;";
    $auteurs = $bdd->query($sql_auteurs)->fetchAll();
    $sql_genres = "SELECT id, genre FROM genres;";
    $genres = $bdd->query($sql_genres)->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BiblioTech | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php
  include_once("../../body/pages.php")
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
                        <td>
                          <form action="update_titre.php" method="POST">
                            <button type="submit" name="update_livre" value=<?php echo($livre["id"]); ?>>Modifier</button>
                          </form>
                          <form action="" method="POST">
                            <button type="submit" name="delete_livre" value=<?php echo($livre["id"]); ?>>Supprimer</button>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
