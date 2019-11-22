<?php
$page = "news";
include('inc/config.php');
include('inc/header.php');
include('inc/nav.php');

 error_reporting( ~E_NOTICE );
    
    if (isset($_POST['go'])) {

        $nom = htmlspecialchars($_POST['nom']);//htmlspecialchars Convertit les caractères spéciaux en entités HTML
        //récupération du tri2 et insertion de la valeur dans la variable $tri2
        $web = htmlspecialchars($_POST['web']);
        $php = htmlspecialchars($_POST['php']);
        $math = htmlspecialchars($_POST['math']);
        $anglais = htmlspecialchars($_POST['anglais']);
        $moy = htmlspecialchars($_POST['moy']);

        if (empty($nom) OR empty($web) OR empty($php)OR empty($math)OR empty($anglais)OR empty($moy)) {
            //On affiche un message d'erreur demandant à l'utilisateur de remplir tous les champs du formulaire
            echo '
                   <div class="bs-example text-center">    
                       <div class="toast fade show">
                           <div class="toast-header red" >
                               <strong class="mr-auto"><i class="fa fa-exclamation-triangle"></i> Information</strong>
                               <button type="button" class="ml-2 mb-1 close red" data-dismiss="toast">&times;</button>
                           </div>
                           <div class="toast-body red">Veuillez; s\'il vous plaît remplir tous les champs du formulaire</div>
                       </div>
                   </div>  '; 
        }

         $sql = "INSERT INTO `matiere` ( `nom`, `web`, `php`,`math`, `anglais`, `moy`) VALUES (:nom, :web, :php,:math, :anglais, :moy);";//$sql reçoit la requête d'exécution d'insertion dans la table users des différents paramètre
         $req = $bdd->prepare("update matiere set nom='".$nom."', web='".$web. "', php='".$php."', math='".$math."', anglais='".$anglais."', moy= '".$moy ."' where id=" . $_GET["id"]);

                        //Une fois la requête preparée on l'exécute 
        $result = $req->execute([
                                ':nom'      => $nom,
                                ':web' => $web,
                                ':php'   => $php,
                                ':math'      => $math,
                                ':anglais' => $anglais,
                                ':moy'   => $moy
                        ]);
            if(!empty($result)){
                            //on affiche que tout est bon et que celui-ci sera rédirigé dans 2 secondes
                            echo '
                                    <div class="bs-example text-center">    
                                        <div class="toast fade show">
                                            <div class="toast-header green" >
                                                <strong class="mr-auto green"><i class="fa fa-check-circle green"></i> Succes</strong>
                                                <button type="button" class="ml-2 mb-1 close green" data-dismiss="toast">&times;</button>
                                            </div>
                                            <div class="toast-body green">
                                                Bravo l\'enregistrement a bien été fait et vous serez rédirigez d\'ici 2 secondes
                                            </div>
                                        </div>
                                    </div> ';
                            header("refresh:2;news.php");//header permet la redirection vers la nouvelle qu'on souhaite, et le refresh permet de définir en seconde le temps mis.
                        }
        }

    $req = $bdd->prepare("SELECT * FROM matiere WHERE id=".$_GET["id"]);
    $req->execute();
    $result = $req->fetchAll();

?>
   
    <div class="jumbotron">
        <div class="container mt-5">
            <div class="row">
                    <h1 class="display-4">Modifications des moyennes</h1>
                <div class="col-sm"></div>
                <div class="col-sm"></div>
                <div class="col-sm"></div>
                <div class="col-sm"></div>
                <div class="col-sm">
                    <a name="" id="" class="btn btn-primary " href="news.php" role="button">
                        <i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        

                <form class="container form1" action="" method="POST" name="frmAdd" class="ml-5 text-center" enctype="multipart/form-data">

                    <h2 class="text-center"></h2>


                    <div class="form-group ">
                        <label >Nom/Prenom</label>
                        <input type="text" name="nom" class="form-control w-25" value="<?=$result[0]["nom"];?>" >
                    </div>
                    <div class="form-group ">
                        <label >Web-Design</label>
                        <input type="text" name="web" class="form-control w-25" value="<?=$result[0]["web"];?>" >
                    </div>
                    <div class="form-group ">
                        <label >Php</label>
                        <input type="text" name="php" class="form-control w-25" value="<?=$result[0]["php"];?>" >
                    </div>
                    <div class="form-group ">
                        <label >Math</label>
                        <input type="text" name="math" class="form-control w-25" value="<?=$result[0]["math"];?>" >
                    </div>
                    <div class="form-group ">
                        <label >Anglais</label>
                        <input type="text" name="anglais" class="form-control w-25" value="<?=$result[0]["anglais"];?>" >
                    </div>
                    <div class="form-group ">
                        <label >Moy-General</label>
                        <input type="text" name="moy" class="form-control w-25" value="<?=$result[0]["moy"];?>" >
                    </div>

                    <input type="submit" name="go" class="btn btn-primary">

                </form>
             
    </div>


</body>
</html>