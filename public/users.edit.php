
<!doctype html>

<html>
<head>
	<meta charset="utf-8">
    <title>Edit User</title>
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
      <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" class="form-control" placeholder="First Name" required autofocus>
      </div>
      <div class="form-group">  
        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" class="form-control" placeholder="Last Name" required>
      </div>
      <div class="form-group"> 
        <label for="inputEmail">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
      </div>
      <div class="form-group"> 
        <label for="inputPassword">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      </div>
      <div class="form-group">  
        <label for="confirmPassword"> Confirm Password</label>
        <input type="password" id="confirmPassword" class="form-control" placeholder="Retype Password" required>
      </div>

      <a class="btn btn-lg btn-primary btn-block" href="users.show.php" type="submit">Submit Changes</a>
      
  </div> <!-- /container -->
  <script type="text/javascript"></script>    
  <?php include '../views/partials/footer.php'; ?> 
</body>

</html>