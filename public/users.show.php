<?php

// require_once 'bootstrap.php';
// require_once '../models/BaseModel.php';
// require_once '../models/UserModel.php';
// require_once '../models/AdModel.php';
// require_once '../models/CategoryModel.php';

function pageController()
{
  session_start();

  if (!isset($_SESSION['IS_LOGGED_IN']) && (!$_SESSION['IS_LOGGED_IN'])) {
    header("Location: index.php");
    exit();
  }
  
  // $id = $_SESSION['user_id'];

  $email = 'g@g.com';                             //$_SESSION[$email];
  $firstName = 'Guest';                            //$_SESSION[$firstName];
  $lastName = 'Guest';                             //$_SESSION[$lastName];

  // $userposts= "select $title from ads where $id = user_id";
  
 
  return array(
  'email'    => $email,
  'firstName'   => $firstName,
  'lastName' => $lastName,
  'loggedIn' => True
  );
}
extract(pageController());
?>

<!doctype html>

<html>
<head>
	<meta charset="utf-8">
    <title>Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
  <?php include '../views/partials/header.php'; ?>
    <?php include '../views/partials/navbar.php'; ?>
	<div class="container">
      <h2>Profile</h2>
      <ul class="list-group">
            <!-- <li class="list-group-item text-right"><span class="pull-left">Joined</span> 12.15.2015</li>
            <li class="list-group-item text-right"><span class="pull-left">Last Login</span> Yesterday</li> -->
            <li class="list-group-item text-right"><span class="pull-left">First name</span> <?= $firstName?></li>
            <li class="list-group-item text-right"><span class="pull-left">Last name</span><?= $lastName?></li>
            <li class="list-group-item text-right"><span class="pull-left">email address</span><?= $email?></li>
            <li class="list-group-item text-right"><span class="pull-left">Password</span>********</li>
            <li class="list-group-item text-right">
              <a class="btn btn-med btn-primary" href="users.edit.php" type="submit">Edit Profile</a>
            </li>
      </ul> 
      <br>
      <h2>Your Ads</h2>
      <ul class = "list-group">
            <li class="list-group-item text-right"><span class="pull-left">First Item</span> 
              <input type="hidden" name="Ads1" value="ad1">
              <a class="btn btn-sm btn-primary" href="ads.edit.php" type="submit">Edit Ad</a>
              <a class="btn btn-sm btn-success" href="ads.show.php" type="submit">Show Ad</a>
            </li>
            <li class="list-group-item text-right"><span class="pull-left">Second Item</span> 
              <input type="hidden" name="Ads2" value="ad2">
              <a class="btn btn-sm btn-primary" href="ads.edit.php" type="submit">Edit Ad</a>
              <a class="btn btn-sm btn-success" href="ads.show.php" type="submit">Show Ad</a>
            </li>
            <li class="list-group-item text-right"><span class="pull-left">ThirdItem</span> 
              <input type="hidden" name="Ads3" value="ad3">
              <a class="btn btn-sm btn-primary" href="ads.edit.php" type="submit">Edit Ad</a>
              <a class="btn btn-sm btn-success" href="ads.show.php" type="submit">Show Ad</a>
            </li>     
            <li class="list-group-item text-right">
            <a class="btn btn-sm btn-primary" href="ads.create.php" type="submit">Create Ad</a>
            </li>
      </ul>
  </div> <!-- /container -->
  <script type="text/javascript"></script>    
   <?php include '../views/partials/footer.php'; ?>
</body>

</html>