<?php
$page = "home";
include('inc/config.php');
include('inc/header.php');
include('inc/nav.php');

 error_reporting( ~E_NOTICE );
    
    if (isset($_POST['update'])) {

        $contact = htmlspecialchars($_POST['contact']);
        $php = htmlspecialchars($_POST['php']);
        $nom = htmlspecialchars($_POST['nom']);
        $math = htmlspecialchars($_POST['math']);
        $anglais = htmlspecialchars($_POST['anglais']);
        $moy = ($php + $math +$anglais)/3;


        if (empty($moy) OR empty($nom) OR empty($contact) OR empty($php) OR empty($math)OR empty($anglais)) {
            echo '
                <div class="bs-example text-center">    
                <div class="toast fade show">
                    <div class="toast-header red" >
                        <strong class="mr-auto"><i class="fa fa-exclamation-triangle"></i> Information</strong>
                        <button type="button" class="ml-2 mb-1 close red" data-dismiss="toast">&times;</button>
                    </div>
                    <div class="toast-body red">Veuillez; s\'il vous plaît remplir le formulaire</div>
                </div>
                </div>
             ';
        }
        $req = $bdd->prepare("update users set nom='".$nom."', contact='".$contact. "' , moy='".$moy. "' ,php='".$php. "' ,anglais='".$anglais. "' , math='".$math."' where id=" . $_GET["id"]);

                    $result = $req->execute([
                        ':nom'      => $nom,
                        ':moy' => $moy,
                        ':contact'      => $contact,
                        ':php'      => $php,
                        ':picture'   => $image,
                        ':math'      => $math,
                        ':anglais'      => $anglais
                            
                    ]);

                    if(!empty($result)){
                        echo '
                             <div class="bs-example text-center">    
                                <div class="toast fade show">
                                    <div class="toast-header green" >
                                        <strong class="mr-auto green"><i class="fa fa-check-circle green"></i> Succes</strong>
                                        <button type="button" class="ml-2 mb-1 close green" data-dismiss="toast">&times;</button>
                                    </div>
                                    <div class="toast-body green">
                                        Bravo mise à jour a bien été faite et vous serez rédirigez d\'ici 2 secondes
                                    </div>
                                </div>
                                </div>
                        ';
                        header("refresh:2;index.php");
                    }
                    

				}
				
    $req = $bdd->prepare("SELECT * FROM users WHERE id=".$_GET["id"]);
    $req->execute();
    $result = $req->fetchAll();

?>

   
   <div class="jumbotron">
       <div class="container mt-5">
           <div class="row">
                   <h1 class="display-4">MODIFICATION DES INFOS </h1>
               <div class="col-sm"></div>
               <div class="col-sm"></div>
               <div class="col-sm"></div>
               <div class="col-sm"></div>
               <div class="col-sm">
                   <a name="" id="" class="btn btn-primary " href="index.php" role="button">
                       <i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i>
                   </a>
               </div>
           </div>
       </div>
       

               <form class="container form1" action="" method="POST" name="frmAdd" class="ml-5 text-center" enctype="multipart/form-data">

                   <h2 class="text-center"></h2>
                   <div class="form-group">
                            <img src="assets/uploads/<?= $result[0]['picture'];?>" alt="" width="300px" height="300">
                        </div>

                   <div class="form-group ">
                       <label >Nom</label>
                       <input type="text" name="nom" class="form-control w-25" value="<?= $result[0]['nom'];?>" >
                   </div>
                   <div class="form-group ">
                       <label >contact</label>
                       <input type="text" name="contact" class="form-control w-25" value="<?= $result[0]['contact'];?>" >
                   </div>
                   <div class="form-group ">
                       <label >moy-php</label>
                       <input type="text" name="php" class="form-control w-25" value="<?= $result[0]['php'];?>" >
                   </div>
                   <div class="form-group ">
                       <label >moy-math</label>
                       <input type="text" name="math" class="form-control w-25" value="<?= $result[0]['math'];?>" >
                   </div>
                   <div class="form-group ">
                       <label >moy-anglais</label>
                       <input type="text" name="anglais" class="form-control w-25" value="<?= $result[0]['anglais'];?>" >
                   </div>
                   <div class="form-group ">
                       <label >moy-Generale</label>
                       <input type="text" name="moy" class="form-control w-25" value="<?= $result[0]['moy'];?>" >
                   </div>
                        
                             <input type="submit" name="update" class="btn btn-primary">
                    </form>
                </div>
            </p>
    </div>



</body>
</html>