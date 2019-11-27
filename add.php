<?php
//le nom de la variable
$page = "home";

//Connexion à la base donnée
include('inc/config.php');
//Connexion de l'entête du fichier
include('inc/header.php');
//connecion de la navbar
include('inc/nav.php');

 //error_reporting() modifie la directive error_reporting pendant l'exécution du script.
 error_reporting( ~E_NOTICE );

    //Si le bouton au nom "submit" est cliquer
    if (isset($_POST['submit'])) {
        $contact = htmlspecialchars($_POST['contact']);
        $php = htmlspecialchars($_POST['php']);
        $nom = htmlspecialchars($_POST['nom']);
        $math = htmlspecialchars($_POST['math']);
        $anglais = htmlspecialchars($_POST['anglais']);
        $moy = ($php + $math +$anglais)/3;
        if (empty($moy)){
            echo'
            <div class="toast-body red text-center">Veuillez; Saisir les moyennes pour eviter les erreur du haut !</div>
                        </div>
            ';
        }
         if (empty($nom) OR empty($contact) OR empty($php) OR empty($math)OR empty($anglais)OR empty($_FILES['image']['name'])) {
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
         } else {//sinon
            $imgFile = $_FILES['image']['name'];        //$imgFile reçoit le nom de le fichier(image dans notre cas) uploader par le biais du formulaire [nom du fichier]
            $tmp_dir = $_FILES['image']['tmp_name'];    //$tmp_dir reçoît le chemin du fichier uploadé dans une mémoire tampon [chemin tampon]
            $imgSize = $_FILES['image']['size'];        //$imgSize reçoit le poids du fichier uploadé [poids du fichier]
            
            //Si l'image est vide alors [répétitif je sais mais bon 😊 c'est pas mauvais]
            if(empty($imgFile)){
                //On demande à l'utilisateur de reuploader le fichier
                $errMSG = "S'il vous plaît sélectionner une image.";
            } else { //sinon
                //$upload_dir est une variable dans la laquelle on indiquera le chemin où les images iront s'enregistrer
                //$upload_dir = mkdir('assets/uploads/');
                if (!file_exists('assets/uploads/')) {
                    mkdir('assets/uploads/');
                    $upload_dir = 'assets/uploads/'; 
                    
                }
                //$imgExt reçoit ici l'extension du fichier
                $upload_dir = 'assets/uploads/'; 
			    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); //strtolower -> fonction mettant tout ce qu'il reçoit en paramètre en minuscule 
			    $valid_extensions = ['jpeg', 'jpg', 'png', 'gif', 'pdf']; //$valid_extensions on liste les extensions qu'on aimerait pouvoir gérer dans notre formulaire
			    $image = rand(1000,1000000).".".$imgExt; //$image recevra par le biais de la fonction rand() un nom aléatoire qui sera une série de chiffre choisis entre 1000 et 1.000.000
                
                //Si l'extension et la validation des extensions sont valides alors
			    if(in_array($imgExt, $valid_extensions)){			
                
                    //si l'image pèse moins de 5000000Ko
				    if($imgSize < 10000000) {
                        //On déplace le fichier de la mémoire tampon au fichier de destination que nous avons choisis plus haut
                        move_uploaded_file($tmp_dir,$upload_dir.$image);

                        //Quand tout ce qui est plus haut est bon alors on va exécuter notre requête SQL
                        $sql = "INSERT INTO `users` ( `nom`, `moy`, `contact`, `php`,`math`,`anglais`, `picture`) VALUES (:nom, :moy, :contact, :php, :math,:anglais,:picture);";//$sql reçoit la requête d'exécution d'insertion dans la table users des différents paramètre
                        $req = $bdd->prepare($sql);//la requête $sql est préparée
                        //Une fois la requête preparée on l'exécute 
                        $result = $req->execute([
                            ':nom'      => $nom,
                            ':moy' => $moy,
                            ':contact'      => $contact,
                            ':php'      => $php,
                            ':picture'   => $image,
                            ':math'      => $math,
                            ':anglais'      => $anglais
                            
                        ]);

                        //Si $result qui permet l'exécution de l'insertion dans la base de donnée n'est pas null alors
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
                            header("refresh:2;index.php");//header permet la redirection vers la nouvelle qu'on souhaite, et le refresh permet de définir en seconde le temps mis.
                        }

                    } else {//sinon si l'image dépase les 5000000Ko
                        //$errMSG affiche que la taille est trop grande
					    $errMSG = "Désolé l'image est un peu trop grande.";
				      }
                } else { //sinon si la validation des extensions n'est pas conforme alors 
                    //$errMSG affiche les différentes extensions à prendre en charge
				    $errMSG = "Désolé seule les format 'jpeg', 'jpg', 'png', 'gif' sont autorisés";		
			      }
             }
         }
    }

?>
   
    <div class="jumbotron">
        <div class="container mt-5">
            <div class="row">
                    <h1 class="display-4"> AJOUTER UN ETUDIANT</h1>
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


                    <div class="form-group ">
                        <label >Nom</label>
                        <input type="text" name="nom" class="form-control w-25" >
                    </div>
                    <div class="form-group ">
                        <label >contact</label>
                        <input type="text" name="contact" class="form-control w-25" >
                    </div>
                    
                    <div class="form-group ">
                        <label >moy-php</label>
                        <input type="text" name="php" class="form-control w-25" >
                    </div>
                    <div class="form-group ">
                        <label >moy-math</label>
                        <input type="text" name="math" class="form-control w-25" >
                    </div>
                    <div class="form-group ">
                        <label >moy-anglais</label>
                        <input type="text" name="anglais" class="form-control w-25" >
                    </div>
                    <div class="form-group">
                    <label >Choisir Image</label>
                        <input type="file" name="image" class="form-control w-50" id="file" > 
                    </div>
                    

                    <input type="submit" name="submit" class="btn btn-primary">

                </form>
                
            </div>
    </div>


</body>
</html>