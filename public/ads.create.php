<?php 
	 require_once '../bootstrap.php';


	function processForm ($postImage)
	{	
		$errors = [];
		$errors['count'] = 0;
		$today = date("Y-m-d");  //pass this to be inserted into the database

		//form was submitted when $_POST is not empty
		if (!empty($_POST))
		{
			try {
				$category = Input::getString('category');
			} catch (Exception $e) {
				$errors['category'] = 'Category: ' . $e->getMessage();
				$errors['count']++;
			}
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
			try {
				$date_posted = Input::getDate('date_posted');
			} catch (Exception $e) {
				$errors['date_posted'] = 'Date Posted: ' . $e->getMessage();
				$errors['count']++;
			}
			if ($errors['count'] == 0)
			{
				$adObject = new AdModel();
				$adObject->category = $category;
				$adObject->title = $postingTitle;
				$adObject->price = $price;
				$adObject->description = $description;
				var_dump($postImage);
				$adObject->image = $postImage;
				$adObject->date_posted = $today;
				// hardcoded:  $adObject->user_id = $_SESSION['user_id'];
				$adObject->users_id = 1;
				$adObject->save();
				//unset the $_SESSION['image'] - will be using the one in the database
				unset($_SESSION['image']);
				header("Location: /ads.show.php?id=" . $adObject->id); //this will be the $_GET for the ads.show.php
				die();
			} 
		}
		return $errors;
	}

	function pageController() {
		$errors['count'] = 0;
		
		$arrayCategoriesArray = CategoryModel::all();
		foreach ($arrayCategoriesArray as $categoriesArray)
		{
			$categorySelectionList[] = $categoriesArray['category_name'];
		}

		$imageSuccessMessage = "";
		//if an image was submitted - validate it even before validating the rest of the form
		if (isset($_FILES['fileToUpload']) && ($_FILES['fileToUpload']['name'] != ''))
		{
			try {
				$postImage = Input::getImage('fileToUpload');
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
		if (isset($_FILES['fileToUpload']) && ($_FILES['fileToUpload']['name'] == ''))
		{
			$errors['image'] = "Image:  Select an image to upload!";
			$errors['count']++;
		}

		//if the session['image'] is empty; then, no image was submitted
		if (!isset($_SESSION['image']))
		{
		//no image was submitted - use placeholder image
		 	$postImage = "http://placehold.it/350x300";
		} else {
			//an image has been submitted; use the image stored in the $_SESSION
			$postImage = $_SESSION['image'];
		}
		//if there weren't any errors with the image; then, process then rest of the form
		if ($errors['count'] == 0) 
		{
			$errors = processForm($postImage);
		}
		
		return array (
			'categorySelectionList' => $categorySelectionList,
			'errorMessages' => $errors,
			'imageSuccessMessage' => $imageSuccessMessage
		);
	}
	extract(pageController());
	var_dump($_SESSION);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <title>Create Ad</title>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="/css/main.css">
	</head>
	<body>
		<?php include '../views/partials/header.php'; ?>
		<?php include '../views/partials/navbar.php'; ?>
		<h1 class="text-center">Create Ad</h1>
        <div id="ad-create-frame" class="container-fluid">
			<form method="POST">
				<div class="form-group">
					<label for="category-static-label" class="col-sm-2 control-label">Category</label>
					<select name="category" class="form-control" id="category-dropdown-selector">
  						<?php foreach ($categorySelectionList as $selection): ?>
  							<?php if($selection == Input::get('category')) : ?>
								<option selected value="<?= $selection; ?>"><?= $selection; ?> </option>
							<?php else : ?>
								<option value="<?= $selection ?>"><?= $selection; ?> </option>
							<?php endif; ?>
  						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="posting-title-static-label" class="col-sm-2 control-label">Posting Title</label>
					<input type="text" name="title" class="form-control" id="posting-title-txtbox" 
						value="<?php Input::get('title'); ?>" placeholder="<type title here>">
						<!-- Input here is not doing anything unless we put it into the sticky forms -->
				</div>
				<div class="form-group">
					<label for="price-static-label" class="col-sm-2">Price $</label>
					<input type="text" name="price" class="form-control" id="price-txtbox" value="<?= Input::get('price'); ?>" 
							placeholder="<type price here (e.g. $50.00; $50000.00>">
				</div>
				<div class="form-group">
					<label for="posting-body-static-label" class="col-sm-2">Posting Description</label><br>
					<textarea class="form-control" name="description" rows="10" id="posting-body-txtbox" 
						placeholder="<type description here>"><?php Input::get('description'); ?></textarea>
				</div>	
				<?php if($errorMessages['count'] != 0) : ?>
					<?php foreach ($errorMessages as $error) : ?>
						<?= $error; ?>
					<?php endforeach; ?>
				<?php endif ?><br>
				<button type="submit" name="submit" id="submit" value="submit" class="btn btn-default btn-lg btn-center">Submit</button><br>
			</form>
			<form method="POST" enctype="multipart/form-data">
				<br>
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Upload Image" name="upload-image" class="btn btn-default btn-lg">
				<?= $imageSuccessMessage; ?>
			</form>
      	</div>
		<?php include '../views/partials/footer.php'; ?>
	</body>
</html>
