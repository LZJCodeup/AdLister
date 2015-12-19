<?php 
	require_once '../database/adlister_db_config.php';
	require_once '../database/db_connect.php';
	require_once '../utils/Input.php';
	require_once '../models/AdModel.php';
	
	function processForm ($category, $datePosted)
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
				$adObject = new AdModel();
				$adObject->title = $postingTitle;
				$adObject->price = $price;
				$adObject->description = $description;
				$adObject->id = $_GET['id'];
				$adObject->image = "http://placehold.it/350x300"; //this is hardcoded for now;
				$adObject->date_posted = $datePosted;
				$adObject->category = $category;
				// hardcoded:  $adObject->user_id = $_SESSION['user_id'];
				$adObject->users_id = 1;		//this is hardcoded for now
				$adObject->save();
				header("Location: /ads.show.php?id=" . $adObject->id); //this will be the $_GET for the ads.show.php
				die();
			} 
		}
		return $errors;
	}

	function pageController(){
		session_start();

		if (!empty($_GET['id']))
		{
			$adID = $_GET['id'];
			$adObject = AdModel::find($adID);
		}
		$errors = processForm($adObject->category, $adObject->date_posted);
		
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
					<label for="postID-static-label" class="col-sm-2 control-label">Post ID#</label>
					<input class="form-control" type="text" placeholder="<?= $adObject->id; ?>" readonly>
				</div>
				<button type="button" name="upload-img" id="upload-img" id="center-block" value="upload-img" class="btn btn-default
					 btn-lg">Upload Image</button>
				<button type="submit" name="submit" id="submit" value="submit" class="btn btn-default btn-lg">Submit Changes</button>
			</form>
      	</div>

		<?php include '../views/partials/footer.php'; ?>
	</body>
</html>
