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