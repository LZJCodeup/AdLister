<?php
function pageController()
{
  session_start();
  
  if (isset($_SESSION['IS_LOGGED_IN']) && ($_SESSION['IS_LOGGED_IN'])) {
    header("Location: users.show.php");
  }
  //$user = USER::findUser($email);
  $email = isset($_POST['email']) ? htmlspecialchars(strip_tags($_POST['email'])) : '';
  $password = isset($_POST['password']) ? htmlspecialchars(strip_tags($_POST['password'])) : '';
    
    if(($email == "guest@g.com") && ($password == "password")){
     $_SESSION['LOGGED_IN_USER'] = $name;
     $_SESSION['IS_LOGGED_IN'] = true;
     header("Location: users.show.php");
  }

  return array(
  'email'    => $email,
  'password'  => $password
  );
}
extract(pageController());
?>

<!doctype html>

<html>
<head>
	 <meta charset="utf-8">
    <title>Login</title>
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

      <form class="form-signin" action="auth.login.php" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail">Email address</label>
        <input type="email" id="inputEmail" class="form-control" name ="email" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control"  name="password" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" href="users.show.php" type="submit">Sign Up</button>
      </form>
      <?php if($_POST):?>
        <?php if(($email != "guest@g.com") || ($email != '')) :?>
        <p>LOGIN Failed</p>
        <?php endif; ?>
      <?php endif; ?>
    </div> <!-- /container -->
<?php include '../views/partials/footer.php'; ?>
</body>
</html>