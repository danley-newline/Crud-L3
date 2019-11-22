<?php
$page = "news";
require_once('inc/config.php');
include('inc/header.php');
include('inc/nav.php');

$req = $bdd->prepare("SELECT * FROM matiere ORDER BY moy DESC");
$req->execute();
$matiere = $req->fetchAll(); 

?>

    <div class="jumbotron mt-5">
        <h3 class="display-3">MOYENNE DE L'ETUDIANT<a name="" id="" class="btn btn-success ml-5" href="moyen.php" role="button"><i class="fa fa-plus-square fa-3x" aria-hidden="true"></i></a>
</h3>
        <p class="lead">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">Nom/Prenom</th>
                <th scope="col">WEB</th>
                <th scope="col">PHP</th>
                <th scope="col">MATH</th>
                <th scope="col">ANGLAIS</th>
                <th scope="col">MOY-GENERAL</th>
                <th scope="col">Modify</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <?php
                if (!empty($matiere)) {
                   foreach ($matiere as $mate) {
            ?>
            
            <tbody>
                <tr>
                <td><?= $mate["nom"]; ?></td>
                <td><?= $mate["web"]; ?></td>
                <td><?=$mate["php"];?></td>
                <td><?= $mate["math"]; ?></td>
                <td><?= $mate["anglais"]; ?></td>
                <td><?=$mate["moy"];?></td>
                 <td><a name="" id="" class="btn btn-primary" href="renews.php?id=<?= $mate['id']?>" role="button"><i class="fa fa-book" aria-hidden="true"></i></a></td>
                <td> <a name="" id="" class="btn btn-danger" href="supri.php?id=<?= $mate['id']?>" onclick="return confirm('Voulez vous supprimer cette donnéee ?')" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
            </tbody>
            <?php 

                   }
                }
            ?>

        
            </table>
    </div>
</div>

