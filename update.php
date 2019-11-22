<?php
$page = "home";
include('inc/config.php');
include('inc/header.php');
include('inc/nav.php');

 error_reporting( ~E_NOTICE );
    
    if (isset($_POST['update'])) {

        $prenom = htmlspecialchars($_POST['prenom']);
        $contact = htmlspecialchars($_POST['contact']);
        $residence = htmlspecialchars($_POST['residence']);
        $nom = htmlspecialchars($_POST['nom']);

         if (empty($prenom) OR empty($nom) OR empty($contact) OR empty($residence)) {
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
        $req = $bdd->prepare("update users set nom='".$nom."', prenom='".$prenom. "' , contact='".$contact. "' , residence='".$residence."' where id=" . $_GET["id"]);

                    $result = $req->execute([
                            ':nom'      => $nom,
                            ':prenom' => $prenom,
                            ':contact'      => $contact,
                            ':residence'      => $residence
                            
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
                   <h1 class="display-4">MODIFIER INFO ETUDIANT</h1>
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
                       <label >Prenom</label>
                       <input type="text" name="prenom" class="form-control w-25" value="<?= $result[0]['prenom'];?>" >
                   </div>
                   <div class="form-group ">
                       <label >Contact</label>
                       <input type="text" name="contact" class="form-control w-25" value="<?= $result[0]['contact'];?>" >
                   </div>
                   <div class="form-group ">
                       <label >Residence</label>
                       <input type="text" name="residence" class="form-control w-25" value="<?= $result[0]['residence'];?>" >
                   </div>
                        
                             <input type="submit" name="update" class="btn btn-primary">
                    </form>
                </div>
            </p>
    </div>



</body>
</html>