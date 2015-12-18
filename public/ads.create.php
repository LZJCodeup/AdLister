<?php 
	require_once '../database/adlister_db_config.php';
	require_once '../database/db_connect.php';
	require_once '../utils/Input.php';

	function processForm ($dbc)
	{	
		$errors = [];
		$errors['count'] = 0;
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
				// $message = insertPost(trim($category), trim($postingTitle), trim($price), trim($description), $date_posted->format('Y-m-d'), $dbc);
				//user_id can be obtained from the session
				// $errors['successful'] = $message;
			} 
		}
		return $errors;
	}

	function pageController($dbc) {
		session_start();
		
		$categorySelectionList = ['Cars', 'Boats', 'Trucks', 'Diesel Trucks'];
		$today = date("Y-m-d");  //pass this to be inserted into the database
		$errors = processForm($dbc);

		return array (
			'categorySelectionList' => $categorySelectionList,
			'errorMessages' => $errors
			);
	}
	extract(pageController($dbc));
	var_dump ($_POST);
	var_dump($_REQUEST);
	// var_dump ($errorMessages);
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
			<!-- <form method="POST" action="/ads.show.php"> -->
			<form method="POST">
				<div class="form-group">
					<label for="category-static-label" class="col-sm-2 control-label">Category</label>
					<select name="category" class="form-control" id="category-dropdown-selector">
  						<?php foreach ($categorySelectionList as $index => $selection): ?>
  							<?php if($selection == Input::get('category')) : ?>
								<option selected value="<?= $index; ?>"><?= $selection; ?> </option>
							<?php else : ?>
								<option value="<?= $index ?>"><?= $selection; ?> </option>
							<?php endif; ?>
  						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="posting-title-static-label" class="col-sm-2 control-label">Posting Title</label>
					<input type="text" name="title" class="form-control" id="posting-title-txtbox" 
						value="<?php Input::get('title'); ?>" placeholder="<type title here>">
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
				<button type="button" name="upload-img" id="upload-img" value="upload-img" class="btn btn-default 
					btn-lg btn-center">Upload Image</button>
				<button type="submit" name="submit" id="submit" value="submit" class="btn btn-default btn-lg btn-center">Submit</button>
			</form>
      	</div>
		<?php include '../views/partials/footer.php'; ?>
	</body>
</html>
