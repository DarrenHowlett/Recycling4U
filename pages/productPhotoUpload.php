<?php

	/* --------------------------------------------
			 * Variables From File Information
			-------------------------------------------- */

	$fileName 			= $_FILES['userfile']['name'];
	$tmpName 			= $_FILES['userfile']['tmp_name'];
	$fileSize 			= $_FILES['userfile']['size'];
	$fileType 			= $_FILES['userfile']['type'];
	$productPhotoName 	= $_POST['productPhotoName'];
	$folderName 		= $_POST['folderName']; // Returns the value of the dropdown option, not what is
	// displayed to the user

	$fileName = addslashes($fileName);
	$filePath = addslashes($filePath);

	// This determines where the file is to be uploaded
	$uploadDir = '../pics/products/'.$folderName.'/';

	// This variable takes the path of the directory to which the file is to be uploaded to
	// and appends the file name to that directory, this is what is uploaded to the database,
	// the file itself will be uploaded and stored wherever the path pointed to.
	$filePath = $uploadDir . $fileName;

	// This checks if the file has been successfully uploaded, if it is, continue with the PHP,
	// if not, display an error message.


	$insert = "INSERT INTO `productPhoto`
						  (`fileName`, `fileType`, `fileSize`, `fileLocation`, `productPhotoName`, `masterPhoto`)
						  VALUES
						  ('".$fileName."', '".$fileType."', '".$fileSize."', '".$filePath."', '".$productPhotoName."', '1');

						  $result = move_uploaded_file($tmpName, $filePath);
						  if (!$result) {
						      echo \"Error uploading file\";
							  exit;
						  }";

	$result = move_uploaded_file($tmpName, $filePath);
	if (!$result) {
		echo "Error uploading file";
		exit;
	}

?>
<div class="col-lg-4">
	<h3>Photo Photo Information</h3>
	<h4>Photo To Upload</h4>
	<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
	<input name="userfile" type="file" id="userfile">
	<h4>File Name</h4>
	<label for="productPhotoName">
		<input id="productPhotoName" name="productPhotoName" type="text">
	</label><br>
	<h4>Directory To Upload To</h4>
	<label for="folderName">Folder Name<br>
		<select id="folderName" name="folderName">
			<option value="chestFreezer">Chest Freezer</option>
			<option value="cooker">Cooker</option>
			<option value="dishwasher">Dishwasher</option>
			<option value="freezer">Freezer</option>
			<option value="fridgeFreezer">Fridge Freezer</option>
			<option value="fridge">Fridge</option>
			<option value="microwave">Microwave</option>
			<option value="washingMachine">Washing Machine</option>
			<option value="cultivator">Cultivator</option>
			<option value="elctricTool">Electric Tool</option>
			<option value="hedgeTrimmer">Hedge Trimmer</option>
			<option value="lawnMower">Lawn Mower</option>
			<option value="manualTool">Manual Tool</option>
			<option value="rideOnMower">Ride On Mower</option>
			<option value="strimmer">Strimmer</option>
		</select>
	</label><br>
</div>
