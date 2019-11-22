<form method="POST" enctype="multipart/form-data" class="form-horizontal">
                 
    <div class="form-group"> 
        <input type="file" name="image" class="form-control" id="file" > 
    </div>
 
        <button type="submit" class="btn btn-success" name="btnsave">Ajouter</button>
       	<?php
				if(isset($errMSG)){
						?>
			            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
			            <?php
				}
				else if(isset($successMSG)){
					?>
			              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
			       <?php
				}
				?>  
</form>

<?php
	error_reporting( ~E_NOTICE ); // avoid notice

	if(isset($_POST['image']))
	{
		
		$imgFile = $_FILES['image']['name'];
		$tmp_dir = $_FILES['image']['tmp_name'];
		$imgSize = $_FILES['image']['size'];
		
		if(empty($imgFile)){
			$errMSG = "Please Select Image File.";
		} else {
			$upload_dir = 'assets/uploads/'; 
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
		
			
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
		
			
			$image = rand(1000,1000000).".".$imgExt;
				
			
			if(in_array($imgExt, $valid_extensions)){			
				
				if($imgSize < 5000000)				{
                    move_uploaded_file($tmp_dir,$upload_dir.$image);
                    echo "Wesh c bon";
				}
				else{
					$errMSG = "Désolé l'image est un peu trop grande.";
				}
			}
			else{
				$errMSG = "Désolé seule les format 'jpeg', 'jpg', 'png', 'gif' sont autorisés";		
			}
		}
		
	}

?>


                