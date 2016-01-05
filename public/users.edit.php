<?php 
require_once '../bootstrap.php';

function pageController()
{

    $errors = [];

    if (!Auth::isLoggedIn()) {
        header('Location: users.create.php');
        exit();
    }

    $userObject = UserModel::find($_SESSION['user_id']);

    if (!empty($_POST) ) {

        try{
            $userObject->first_name = Input::getString('firstName');
        } catch(Exception $e){
            $errors[] = $e->getMessage();
        }
        
        try{
            $userObject->last_name = Input::getString('lastName');
        } catch(Exception $e){
            $errors[] = $e->getMessage();
        }

        if (Input::get('password1') == Input::get('password2')) {
            try {
                $userObject->password = Input::getPassword('password1', $userObject->first_name, $userObject->last_name, $userObject->email);
            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }


        $userObject->save();
    }


    return [
        'user' => $userObject,
        'errors' => $errors
    ];
}

extract(pageController());

 ?>
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
    <form method="POST">
	<div class="container">
      <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First Name" value="<?= $user->first_name; ?>" required autofocus>
      </div>
      <div class="form-group">  
        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last Name" value="<?= $user->last_name; ?>" required>
      </div>
      <div class="form-group"> 
        <label for="inputPassword">New Password</label>
        <input type="password" id="inputPassword" name="password1" class="form-control" placeholder="Password">
      </div>
      <div class="form-group">  
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="password2" class="form-control" placeholder="Retype Password">
      </div>

    <?php foreach($errors as $e): ?>
        <p><?= $e; ?></p>
    <?php endforeach; ?>

      <input class="btn btn-default" type="submit" value="Submit Changes">
      </form>


      
  </div> <!-- /container -->
  <script type="text/javascript">

  </script>    
  <?php include '../views/partials/footer.php'; ?> 
</body>

</html>
