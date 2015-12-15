<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <title>View Ad</title>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="/css/main.css">
	</head>
	<body>
	<?php include '../views/partials/header.php'; ?>
	<?php include '../views/partials/navbar.php'; ?>
		<h1 class="text-center">View Ad</h1>
		   	<form name="ad-view-form" action="" class="form-horizontal">
				<div class="form-group">
					<label for="posting-title-static-label" class="col-sm-2 control-label">Posting Title</label>
					<div class="col-sm-10">
	      				<p class="form-control-static">Sofa</p>
	    			</div>
	    		</div>
	    		<div class="form-group">
					<label for="price-static-label" class="col-sm-2 control-label">Price</label>
					<div class="col-sm-10">
	      				<p class="form-control-static">Sofa Price</p>
	    			</div>
	    		</div>
	    			<br><img src="img/Placeholder.jpg" class="img-responsive center-block" alt="Responsive image"><br>
	    		<div class="form-group">
					<label for="posting-body-static-label" class="col-sm-2 control-label">Posting Description</label>
					<div class="col-sm-10">
	      				<p class="form-control-static">Posting Body Description</p>
	    			</div>
	    		</div>
	    		<div class="form-group">
					<label for="category-static-label" class="col-sm-2 control-label">Category</label>
					<div class="col-sm-10">
	      				<p class="form-control-static">Assigned Category</p>
	    			</div>
	    		</div>
	    		<div class="form-group">
					<label for="postID-static-label" class="col-sm-2 control-label">Post ID#</label>
					<div class="col-sm-10">
	      				<p class="form-control-static">1234567890</p>
	    			</div>
	    		</div>
    		</form>
	<?php include '../views/partials/footer.php'; ?>
	</body>

