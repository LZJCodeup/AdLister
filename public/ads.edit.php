<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <title>Edit Ad</title>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="/css/main.css">
	</head>
	<body>
		<?php include '../views/partials/header.php'; ?>
		<?php include '../views/partials/navbar.php'; ?>
		<h1 class="text-center">Edit Ad</h1>
        <div id="edit-ad-frame" class="container-fluid">
		   <form name="edit-ad-form" action="/ads.show.php">
			<div class="form-group">
				<label for="category-static-label" form="edit-ad-form" class="col-sm-2 control-label">Category</label>
				<input class="form-control" type="text" placeholder="Category" readonly>
			</div>
			<div class="form-group">
				<label for="posting-title-static-label" form="edit-ad-form" class="col-sm-2 control-label">Posting Title</label>
				<input type="text" name="posting-title-txtbox" class="form-control" id="posting-title-txtbox">

				<label for="price-static-label" form="edit-ad-form" class="col-sm-2">Price $</label>
				<input type="text" name="price-txtbox" class="form-control" id="price-txtbox">
			</div>
			<div class="form-group">
				<label for="posting-body-static-label" form="edit-ad-form" class="col-sm-2">Posting Body</label><br>
				<textarea class="form-control" rows="10" id="posting-body-txtbox"></textarea>
			</div>	
			<div class="form-group">
				<label for="postID-static-label" form="edit-ad-form" class="col-sm-2 control-label">Post ID#</label>
				<input class="form-control" type="text" placeholder="Posting Identification Number" readonly>
			</div>
			<button type="button" name="upload-img" id="upload-img" id="center-block" value="upload-img" class="btn btn-default
					 btn-lg">Upload Image</button>
			<button type="submit" name="submit" id="submit" value="submit" class="btn btn-default btn-lg">Submit Changes</button>
		  </form>
      </div>
	<?php include '../views/partials/footer.php'; ?>
	</body>
</html>
