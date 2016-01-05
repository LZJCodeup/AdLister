<?php 
	require_once '../bootstrap.php';

	function pageController(){
		//initializes the session variable if none exists otherwise it resets it

		//a user id was passed to this page to display
		if (!empty($_GET['id']))
		{
			$adID = $_GET['id'];
			$adObject = AdModel::find($adID);
		}
		
		//the form containing only the submit button was submmited - user wants to edit the ad
		if ((!empty($_POST)) && (!empty($_GET['id'])))
		{
			header("Location: /ads.edit.php?id=" . $adID);   //this will be the $_GET for the ads.edit.php
			die();
		}
		
		return array (
			'adObject' => $adObject
		);
	}
	extract(pageController());
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <title>View Ad</title>
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
		<h1 class="text-center">View Ad</h1>
  		<div id="show-ad-frame" class="container-fluid">
		   	<div class="form-horizontal">
				<div class="form-group">
					<label for="posting-title-static-label" form="ad-view-form" class="col-sm-2 control-label">Posting Title</label>
					<div class="col-sm-10">
		      			<p class="form-control-static" id="static-posting-title"><?= $adObject->title ?></p>
		    		</div>
		    	</div>
		    	<div class="form-group">
					<label for="price-static-label" form="ad-view-form" class="col-sm-2 control-label">Price $</label>
					<div class="col-sm-10">
		      			<p class="form-control-static" id="static-price"><?= $adObject->price ?></p>
		    		</div>
		    	</div>
		    	<br><img src="<?= "http://adlister.dev" . $adObject->image ?>" class="img-responsive center-block" alt="Responsive image"><br>
		    	<div class="form-group">
					<label for="posting-body-static-label" form="ad-view-form" class="col-sm-2 control-label">Posting Description</label>
					<div class="col-sm-10">
		      			<p class="form-control-static" id="static-post-description"><?= $adObject->description ?></p>
		    		</div>
		    	</div>
		    	<div class="form-group">
					<label for="category-static-label" form="ad-view-form" class="col-sm-2 control-label">Category</label>
					<div class="col-sm-10">
		      			<p class="form-control-static" id="static-category"><?= $adObject->category ?></p>
		    		</div>
		    	</div>
		    	<div class="form-group">
					<label for="postID-static-label" form="ad-view-form" class="col-sm-2 control-label">Post ID#</label>
					<div class="col-sm-10">
		      			<p class="form-control-static" id="static-postID"><?= $adObject->id ?></p>
		    		</div>
		    	</div>
		    	<form method="POST">
		    		<button type="submit" name="submit" id="submit" value="submit" class="btn btn-default btn-lg btn-center">Edit Ad</button>
		    	</form>
    		</div>
    	</div>
		<?php include '../views/partials/footer.php'; ?>
	</body>
<html>
