<?php
$page = "home";
require_once('inc/config.php');
include('inc/header.php');
include('inc/nav.php');

$req = $bdd->prepare("SELECT * FROM users ORDER BY moy DESC");
$req->execute();
$users = $req->fetchAll(); 


?>

    <div class="jumbotron">
        <h1 class="display-3">MOYENNE DE L'ETUDIANT<a name=""  id="" class="btn btn-success ml-5" href="add.php" role="button"><i class="fa fa-plus-square fa-3x" aria-hidden="true"></i></a></h1>
        <p class="lead">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">Numero</th>
                <th scope="col">Nom/Prenom</th>
                <th scope="col">contact</th>
                <th scope="col">Moy-PHP</th>
                <th scope="col">Moy-math</th>
                <th scope="col">Moy-angl</th>
                <th scope="col">Picture</th>
                <th scope="col">Moy-Generale</th>
                <th scope="col">MENTION</th>
                <th scope="col">Modify</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <?php
                if (!empty($users)) {
                   foreach ($users as $user) {
            ?>
            <tbody>
                <tr>
                <th scope="row"><?= $user["id"]; ?></th>
                <td><?= $user["nom"]; ?></td>
                <td><?= $user["contact"]; ?></td>
                <td><?= $user["php"]; ?></td>
                <td><?= $user["math"]; ?></td>
                <td><?= $user["anglais"]; ?></td>
                <td> <img src="assets/uploads/<?= $user["picture"]; ?>" alt="" width="100" height="50"> </td>
                <td><?=$dec = $user["moy"]; ?></td>
                <td><?php if($dec >=10 ){
                    echo '<font color=green> <b> VALIDER </b> </font>';}
                    else { echo '<font color=red> <b> RECALER </b> </font>';}
                ?></td>
                 <td><a name="" id="" class="btn btn-primary" href="update.php?id=<?= $user['id']?>" role="button"><i class="fa fa-book" aria-hidden="true"></i></a></td>
                <td> <a name="" id="" class="btn btn-danger" href="delete.php?id=<?= $user['id']?>" onclick="return confirm('Voulez vous supprimer cette donnéee ?')" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
            </tbody>
            <?php 

                   }
                }
            ?>

        
            </table>
    </div>
</div>

