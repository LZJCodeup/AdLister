<?php 
	function pageController(){
		session_start();
		
		$postCategory = 'Cars';
		$postTitle = '';
		$postPrice = '';
		$postDescription = '';
		$categorySelectionList = ['Cars', 'Boats', 'Trucks', 'Diesel Trucks'];
		$selectedCategory = '';

		return array (
			'postCategory' => $postCategory,
			'postTitle'  => $postTitle,
			'postPrice' => $postPrice,
			'postDescription' => $postDescription,
			'categorySelectionList' => $categorySelectionList,
			'selectedCategory' => $selectedCategory,
			);
	}
	extract(pageController());
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
			<form name="create-ad-form" method="POST" action="/ads.show.php">
				<div class="form-group">
					<label for="category-static-label" form="create-ad-form" class="col-sm-2 control-label">Category</label>
					<!-- select values-->
					<select name="<?php $selectedCategory ?>" form="create-ad-form" class="form-control" id="category-dropdown-selector">
  						<?php foreach ($categorySelectionList as $selection): ?>
  							<!-- value= is what will be stored in selectedCategory variable -->
							<option value="<?= $selection ?>"><?= $selection; ?> </option>  							
  						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="posting-title-static-label" form="create-ad-form" class="col-sm-2 control-label">Posting Title</label>
					<input type="text" name="posting-title-txtbox" class="form-control" id="posting-title-txtbox" value="<?php $postTitle ?>" placeholder="<type title here>">
				</div>
				<div class="form-group">
					<label for="price-static-label" form="create-ad-form" class="col-sm-2">Price $</label>
					<input type="text" name="price-txtbox" class="form-control" id="price-txtbox" value="<?php $postPrice ?>" 
							placeholder="<type price here (e.g. $50.00; $50000.00>">
				</div>
				<div class="form-group">
					<label for="posting-body-static-label" form="create-ad-form" class="col-sm-2">Posting Description</label><br>
					<textarea class="form-control" name="posting-body-txtbox" rows="10" id="posting-body-txtbox" placeholder="<type description here>"><?php $postDescription ?></textarea>
				</div>	
				<button type="button" name="upload-img" id="upload-img" value="upload-img" class="btn btn-default 
					btn-lg btn-center">Upload Image</button>
				<button type="submit" name="submit" id="submit" value="submit" class="btn btn-default btn-lg btn-center">Submit</button>
			</form>
      	</div>
		<?php include '../views/partials/footer.php'; ?>
	</body>
</html>
