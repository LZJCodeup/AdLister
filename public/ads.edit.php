<?php 
	 require_once '../bootstrap.php';

	
	function processForm ($adObject, $postImage)
	{	
		$errors = [];
		$errors['count'] = 0;
		//form was submitted when $_POST is not empty
		if (!empty($_POST))
		{	
			try {
				$postingTitle = Input::getString('title');
			} catch (Exception $e) {
				$errors['title'] = 'Posting Title: ' . $e->getMessage();
				$errors['count']++;
			}
			try {
				$price= Input::getNumber('price');
			} catch (Exception $e) {
				$errors['price'] = 'Price: ' . $e->getMessage();
				$errors['count']++;
			}
			try {
				$description = Input::getString('description');
			} catch (Exception $e) {
				$errors['description'] = 'Description: ' . $e->getMessage();
				$errors['count']++;
			}
			if ($errors['count'] == 0)
			{	//update the database
				// $adObject = new AdModel();
				$adObject->title = $postingTitle;
				$adObject->price = $price;
				$adObject->description = $description;
				$adObject->id = $_GET['id'];
				if ($postImage == "Database Image")
				{	//no image was uploaded - use the database image
					$adObject->image = $adObject->image;
				} else { //new image uploaded - use new image
					$adObject->image = $postImage;
				}
				var_dump("adObject image: " . $adObject->image . "!");
				$adObject->date_posted = $adObject->date_posted;
				$adObject->category = $adObject->category;
				// hardcoded:  $adObject->user_id = $_SESSION['user_id'];
				$adObject->users_id = $_SESSION['user_id'];		//this is hardcoded for now
				$adObject->save();
				unset($_SESSION['image']);
				header("Location: /ads.show.php?id=" . $adObject->id); //this will be the $_GET for the ads.show.php
				die();
			} 
		}
		return $errors;
	}

	function pageController(){
		$errors['count'] = 0;

		if (!empty($_GET['id']))
		{
			$adID = $_GET['id'];
			$adObject = AdModel::find($adID);
		}
		$imageSuccessMessage = "";
		//if an image was submitted - validate it even before validating the rest of the form
		if (!empty($_POST['upload-image']) && ($_FILES['fileToUpload']['name'] != ''))
		{
			try {
				$postImage = Input::getImage();
				//image was successfully uploaded
				$imageSuccessMessage = "Image: " . basename( $_FILES['fileToUpload']['name']) . " has been uploaded!";
				//store image in the session
				$_SESSION['image'] = $postImage;
			} catch (Exception $e) {
				$errors['image'] = 'Image: ' . $e->getMessage();
				$errors['count']++;
			}
		}
		//clicked on the upload image button without selecting a photo
		if (!empty($_POST['upload-image']) && ($_FILES['fileToUpload']['name'] == ''))
		{
			$errors['image'] = "Image:  Select an image to upload!";
			$errors['count']++;
		}
		
		//an image has been submitted; use the image stored in the $_SESSION
		if (isset($_SESSION['image']))
		{
			$postImage = $_SESSION['image'];
		} else {
			//use the image stored in the database
			$postImage = "Database Image";
		}
		//if there weren't any errors with the image; then, process then rest of the form
		if ($errors['count'] == 0) 
		{
			$errors = processForm($adObject, $postImage);
			// $errors = processForm($adObject->category, $adObject->date_posted, $postImage);
		}
		
		return array (
			'adObject' => $adObject,
			'errorMessages' => $errors
			);
	}
	extract(pageController());
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <title>Edit Ad</title>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	    	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	    	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="/css/main.css">
	</head>
	<body>
		<?php include '../views/partials/header.php'; ?>
		<?php include '../views/partials/navbar.php'; ?>
		<h1 class="text-center">Edit Ad</h1>

        <div id="edit-ad-frame" class="container-fluid">
			<form method="POST">
				<div class="form-group">
					<label for="category-static-label" class="col-sm-2 control-label">Category</label>
					<input class="form-control" type="text" placeholder="<?= $adObject->category; ?>" readonly>
				</div>
				<div class="form-group">
					<label for="posting-title-static-label" class="col-sm-2 control-label">Posting Title</label>
					<input type="text" name="title" class="form-control" id="posting-title-txtbox" value="<?= $adObject->title; ?>">
				</div>
				<div class="form-group">
					<label for="price-static-label" class="col-sm-2">Price $</label>
					<input type="text" name="price" class="form-control" id="price-txtbox" value="<?= $adObject->price; ?>">
				</div>
				<div class="form-group">
					<label for="posting-body-static-label" class="col-sm-2">Posting Description</label><br>
					<textarea class="form-control" name="description" rows="10" id="posting-body-txtbox"><?=$adObject->description; ?></textarea>
				</div>	
				<div class="form-group">
					<label for="posting-image-static-label" class="col-sm-2">Image</label><br>
					<input class="form-control" type="text" placeholder="<?= $adObject->image; ?>" readonly>
				</div>	
				<div class="form-group">
					<label for="postID-static-label" class="col-sm-2 control-label">Post ID#</label>
					<input class="form-control" type="text" placeholder="<?= $adObject->id; ?>" readonly>
				</div>
				<?php if($errorMessages['count'] != 0) : ?>
					<?php foreach ($errorMessages as $error) : ?>
						<?= $error; ?>
					<?php endforeach; ?>
				<?php endif ?><br>
				<button type="submit" name="submit" id="submit" value="submit" class="btn btn-default btn-lg">Submit Changes</button>
			</form>
			<form method="POST" enctype="multipart/form-data">
				<br>
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Upload Image" name="upload-image" class="btn btn-default btn-lg">
			</form>
      	</div>

		<?php include '../views/partials/footer.php'; ?>
	</body>
</html>
