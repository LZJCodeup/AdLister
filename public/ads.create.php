<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <title>Viewing All Ads</title>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="/css/main.css">
	</head>
	<body>
		<h1>Create Ad</h1>
		<form name="create-ad-form" method="POST" action="">
			<p>
				<label for="category-static-label" form="create-ad-form">Category</label>
				<!-- specify type -->
				<input type="" name="category-dropdown-selector" id="category-dropdown-selector"><br>
			</p>
			<p>
				<label for="posting-title-static-label" form="create-ad-form">Posting Title</label>
				<input type="text" name="posting-title-txtbox" id="posting-title-txtbox">

				<label for="price-static-label" form="create-ad-form">Price $</label>
				<input type="text" name="category-dropdown-selector" id="category-dropdown-selector"><br>
			</p>
			<p>
				<label for="posting-body-static-label" form="create-ad-form">Posting Body</label><br>
				<!-- specify type -->
				<input type="" name="posting-body-txtbox" id="posting-body-txtbox"><br>
			</p>	
			<button type="submit" name="upload-img" id="upload-img" value="upload-img">Upload Image</button>
			<button type="submit" name="submit" id="submit" value="submit">Submit</button>
		</form>
	</body>
</html>