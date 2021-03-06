<?php 
  require_once '../bootstrap.php';

  function pageController(){
    //initializes the session variable if none exists otherwise it resets it

    //a user id was passed to this page to display
    if (!empty($_GET['id']))
    {
      $userID = $_GET['id'];
      $userObject = UserModel::find($userID);
      $userAds = $userObject->getAds();
    }
    
    return array (
      'userObject' => $userObject,
      'userAds' => $userAds,
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
            <li class="list-group-item text-right"><span class="pull-left">First name</span><?= $userObject->first_name; ?></li>
            <li class="list-group-item text-right"><span class="pull-left">Last name</span><?= $userObject->last_name; ?></li>
            <li class="list-group-item text-right"><span class="pull-left">Email address</span><?= $userObject->email; ?></li>
            <li class="list-group-item text-right">
              <a class="btn btn-med btn-primary" href="users.edit.php?id=<?= $userObject->id; ?>" type="submit">Edit Profile</a>
            </li>
      </ul> 
      <br>
      <h2>Your Ads</h2>
      <ul class = "list-group">
        <!-- If the user has active ads; then, execute the following -->
        <?php if (!empty($userAds)) : ?>
            <?php foreach ($userAds as $ad) : ?>
                <li class="list-group-item text-right"><span class="pull-left"><?= $ad->title ?></span> 
                  <input type="hidden" name="Ads1" value="ad1">
                  <a class="btn btn-sm btn-primary" href="ads.edit.php?id=<?= $ad->id; ?>" type="submit">Edit Ad</a>
                  <a class="btn btn-sm btn-success" href="ads.show.php?id=<?= $ad->id; ?>" type="submit">Show Ad</a>
                </li>
            <?php endforeach; ?>
        <?php endif ?>
        <li class="list-group-item text-right">
          <a class="btn btn-sm btn-primary" href="ads.create.php" type="submit">Create Ad</a>
        </li>
      </ul>

  </div> <!-- /container -->
  <script type="text/javascript"></script>    
   <?php include '../views/partials/footer.php'; ?>
</body>

</html>
