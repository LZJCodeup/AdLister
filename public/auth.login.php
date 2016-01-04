<?php
require_once 'bootstrap.php';

function pageController()
{
  session_start();
  
  if(Auth::isLoggedIn())
  {
    header("Location: index.php");
    exit();
  }
  
  try {
    $email = Input::getString('email');
  } catch (Exception $e) {
    $email = '';
  }

  try {
    $password=Input::getString('password');
  } catch (Exception $e) {
    $password = '';
  }
  
  $user = UserModel::findByEmail($email);
  
  // if(empty($user))
  // {
  //  header("Location: users.create.php");
  //   exit(); 
  // }

  if(Auth::attempt($user,$password))
  {
    Auth::setSessionVariables($user);
  } 
  return array(
    'email'   => $email,
    'loggedIn' => Auth::isLoggedIn()
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
        <button class="btn btn-lg btn-primary btn-block" href="users.show.php" type="submit">Sign In</button>
      </form>
        <?php if(!empty($_POST)) :?>
        <p>Login Failed</p>
        <?php endif; ?>
    </div> <!-- /container -->
<?php include '../views/partials/footer.php'; ?>
</body>
</html>