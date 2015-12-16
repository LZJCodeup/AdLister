<!doctype html>

<html>
<head>
  <meta charset="utf-8">
    <title>Sign Up</title>
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
      <form class="form-signin">
        <h2 class="form-signin-heading">Please sign up</h2>
        <div class = "form-group">
            <label for="inputName">First Name</label>
            <input type="text" id="firstName" class="form-control" placeholder="First Name" required autofocus>
        </div>
        <div class = "form-group">
            <label for="inputName">Last Name</label>
            <input type="text" id="lastName" class="form-control" placeholder="Last Name" required>
        </div>
        <div class = "form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
        </div>
        <div class = "form-group">
            <label for="inputUserName">Username</label>
            <input type="text" id="username" class="form-control" placeholder="Username" required>
        </div>
        <div class = "form-group">
            <label for="inputPassword">Password</label>
            <input type="password" id="password1" class="form-control" placeholder="Password" required>
        </div>
        <div class = "form-group">
            <label for="inputPasswordAgain">Retype Password</label>
            <input type="password" id="password2" class="form-control" placeholder="Retype Password" required>
        </div>
        <a class="btn btn-lg btn-success btn-block" href="users.show.php" type="submit">Sign Up</a>
      </form>

    </div> <!-- /container -->
  <?php include '../views/partials/footer.php'; ?>
</body>
</html>