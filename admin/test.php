<?php
// get value of id that sent from address bar
	$recordid= isset($_GET['id'])? (int) $_GET['id']: 0;
	
	//get value of img_id from add_image.php
	$i= isset($_POST['img_number'])? (int) $_POST['img_number']: 0;

	// target for image uploads
	$images_dir = "store/";
	
	//max number of images
	$number_of_images = "16";
	
	// initialization
	$result_final = "";

	// List of our known photo types
	$known_photo_types = array( 
						'image/pjpeg' => 'jpg',
						'image/jpeg' => 'jpg',
						'image/gif' => 'gif',
						'image/bmp' => 'bmp',
						'image/x-png' => 'png'
					);
	
	// GD Function List
	$gd_function_suffix = array( 
						'image/pjpeg' => 'JPEG',
						'image/jpeg' => 'JPEG',
						'image/gif' => 'GIF',
						'image/bmp' => 'WBMP',
						'image/x-png' => 'PNG'
					);

	// Fetch imagename
	for($i=0; $i<$number_of_images; $i++){
		if(isset($_FILES["imgname_".$i])){
			$photos_uploaded[] = $_FILES["imgname_".$i];
		}
		// Fetch photo caption
		if(isset($_POST["photo_caption_".$i])){
			$photo_caption[] = $_POST["photo_caption_".$i];
		}
		
		//fetch img_id
		if(isset($_POST["img_id"])){
			$img_id = $_POST["img_id"];
		}
	}
	
	
	//echo "<pre>";
	//exit(print_r($photos_uploaded[$i]));
	
	for($i=0; $i<$number_of_images; $i++){
		//check image size
		if($photos_uploaded[$i]['size'] > 0){
			echo $photos_uploaded[$i]['size'];
		}else{
			echo "<br>File has no size<br>";
		}
		//check image type
		if(!array_key_exists($photos_uploaded[$i]['type'], $known_photo_types)){
				echo "File ".$photos_uploaded[$i]." is not a photo<br />";
			}else{

		//show file name and caption	
		echo "<br>filename: $photos_uploaded[$i]<br>";
		echo "<br>caption: $photo_caption[$i]<br>";	
	
		//get tmp_name	
		$temp_name = $photos_uploaded[$i]['tmp_name'];
		echo "<br>Temp Name: $temp_name<br>";
		
		//check that imgid is being passed
		echo "<br>Image number: ($i)<br>";
		echo "<br>Image ID: $img_id[$i]<br>";
			
		// get filetype
			$filetype = $photos_uploaded[$i]['type'];
		//check that filetype is being created
		echo "<br>File Type: $filetype<br>";
		
		//create extension
			if($photos_uploaded[$i]['size'] > 0){
			$extension = $known_photo_types[$filetype];
			}
		//check that extension is correct
		echo "<br>Extension: $extension<br>";
		
		//create filename
			$filename = $photos_uploaded[$i].".".$extension;
		//check that filename is being created
			echo "<br>Filename: $filename<br>";
		
		// Store the orignal file
			copy($photos_uploaded[$i]['tmp_name'], $images_dir."/".$filename);
		
		// Let's get the Thumbnail size
				$size = GetImageSize( $images_dir."/".$filename );
				if($size[0] > $size[1])
				{
					$thumbnail_width = 281;
					$thumbnail_height = (int)(281 * $size[1] / $size[0]);
				}
				else
				{
					$thumbnail_width = (int)(211 * $size[0] / $size[1]);
					$thumbnail_height = 211;
				}
			
				// Build Thumbnail with GD 1.x.x, you can use the other described methods too
				$function_suffix = $gd_function_suffix[$filetype];
				$function_to_read = "ImageCreateFrom".$function_suffix;
				$function_to_write = "Image".$function_suffix;

				// Read the source file
				$source_handle = $function_to_read ( $images_dir."/".$filename ); 
				
				if($source_handle)
				{
				// Let's create an blank image for the thumbnail
				$destination_handle = ImageCreate ( $thumbnail_width, $thumbnail_height );
				
				//Now we resize it
			    ImageCopyResized( $destination_handle, $source_handle, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $size[0], $size[1] );
				}

				// Let's save the thumbnail
				$function_to_write( $destination_handle, $images_dir."/tb_".$filename );
				ImageDestroy($destination_handle );
				
				mysql_query( "INSERT INTO images(recordid, imgname, photo_caption) VALUES('$recordid', '$photos_uploaded[$i]', '$photo_caption[$i]')" )or die("Insert Error: ".mysql_error());;
				
				mysql_query( "UPDATE images SET imgname='".addslashes($filename)."', photo_caption='".addslashes($photo_caption[$i])."' WHERE imgid='$i' " )or die("Insert Error: ".mysql_error());;				
				
				//lets see the result
				$result_final = "<img src='".$images_dir. "/tb_".$filename."' /> File ".($i)." Added<br>".$photo_caption[$i]."";
				
				echo "<img src='".$images_dir. "/tb_".$filename."' /> File ".($i)." Added<br>".$photo_caption[$i]."";
			}
	$i++;
	}
	
?>  
		<?php echo $result_final; ?>



        <?php	
	// get value of id that sent from address bar
	$recordid= isset($_GET['id'])? (int) $_GET['id']: 0;

	// default number of fields
	$number_of_images = 16; 
?>
<form name="editform" enctype="multipart/form-data" action="test.php?id=<?php echo $recordid; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $recordid; ?>">       
<?php			
			
			// Retrieve data from database 
			$sql_cars="SELECT * FROM cars WHERE id='$recordid'";
			$result_cars=mysql_query($sql_cars)or die(mysql_error());

			$data=mysql_fetch_array($result_cars);
?>
			
            <table width="100%" border="1">
          	<tbody>
		<tr>
            		<td width="20%" class="label" >Make</td>
			<td width="20%" ><?php echo $data['make']; ?></td>
                	<td width="30%">&nbsp;</td>
                	<td width="30%">&nbsp;</td>
            	</tr>
            	<tr>
            		<td class="label">Model</td>
			<td><?php echo $data['model']; ?></td>
                	<td>&nbsp;</td>
                	<td>&nbsp;</td>
            	</tr>
<?php
		
		//LIMIT 0, 16 means show 16 records starting from record 0...
		$sql_images="SELECT * FROM images WHERE recordid='$recordid' LIMIT 0,16";
		$result_images=mysql_query($sql_images)or die(mysql_error());

		for($i=0; $i< $number_of_images; $i++){

		// Start looping rows in mysql database.
		while($images=mysql_fetch_array($result_images)){
?>
        	<tr>
         		<td class="label">(<?php echo $i;?>) Images [<?php echo $images['imgid']; ?>]
                		<input type="hidden" name="img_number" value="<?php echo $i; ?>">
                		<input type="hidden" name="img_id" value="<?php echo $images['imgid']; ?>" ></td>
			<td><img src="store/tb_<?php echo $images['imgname']; ?>" width="131" height="98" /></td>
                	<td>Photo: <input name="imgname_<?php echo $i; ?>" type="file" /></td>
                	<td>Caption: <textarea name="photo_caption_<?php echo $i; ?>" cols="30" rows="1"></textarea></td>
    		</tr>
<?php
		$i++;	
		}

		if($i < $number_of_images){
?>
        	<tr>
         		<td class="label"><input type="hidden" name="img_number" value="<?php echo $i; ?>">(<?php echo $i; ?>) No Image </td>
			<td><img src="images/camera.png" width="50" height="50" /></td>
                	<td>Photo: <input type="file" name="imgname_<?php echo $i; ?>" /></td>
                	<td>Caption: <textarea name="photo_caption_<?php echo $i; ?>" cols="30" rows="1"></textarea></td>
    		</tr>
<?php
		}
		}
?>
            </tbody>
            </table>
		<table class="displayRecords" width="100%" border="1">
 		<tr>
        		<td align="left"><input name="Submit" type="submit" value="Upload image"></td>
    		</tr>
                <tr>
        		<td align="left"><input type="button" value="Return to Edit" onClick="javascript:js_edit(<?php echo $recordid; ?>);"></td>
    		</tr>
 		</table>	
        </form>