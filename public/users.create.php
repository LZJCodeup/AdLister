<?php 
    require_once '../bootstrap.php';

    function processForm ()
    {   
        $errors = [];
        $errors['count'] = 0;

        //form was submitted when $_POST is not empty
        if (!empty($_POST))
        {
            try {
                $firstName = Input::getString('first_name');
            } catch (Exception $e) {
                $errors['first_name'] = 'First Name: ' . $e->getMessage();
                $errors['count']++;
            }
            try {
                $lastName = Input::getString('last_name');
            } catch (Exception $e) {
                $errors['last_name'] = 'Last Name: ' . $e->getMessage();
                $errors['count']++;
            }
            try {
                $email = Input::getString('email');
            } catch (Exception $e) {
                $errors['email'] = 'Email Address: ' . $e->getMessage();
                $errors['count']++;
            }
            try {
                if ($_POST['password1'] != $_POST['password2'])
                {
                    throw new UnexpectedValueException ("Do Not Match!");
                }
                $passwordOneHashed = Input::getPassword('password1', $firstName, $lastName, $email); 
            } catch (Exception $e) {
                $errors['password1'] = 'Password: ' . $e->getMessage();
                $errors['count']++;
            }
            if ($errors['count'] == 0)
            {   //no errors - add to the database
                $userObject = new UserModel();
                $userObject->first_name = $firstName;
                $userObject->last_name = $lastName;
                $userObject->email = $email;
                $userObject->password = $passwordOneHashed;
                $userObject->save();
                header("Location: /users.show.php?id=" . $userObject->id); //this will be the $_GET for the users.show.php
                die();
            } 
        }
        return $errors;
    }

    function pageController() {
        $errors = processForm();

        return array (
            'errorMessages' => $errors
        );
    }
    extract(pageController());
    var_dump($errorMessages);
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <?php include '../views/partials/header.php'; ?>
    <?php include '../views/partials/navbar.php'; ?>
  <div class="container">
      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Please sign up</h2>
        <div class = "form-group">
            <label for="inputName">First Name</label>
            <input type="text" name="first_name" class="form-control" placeholder="First Name" 
                value="<?= Input::get('first_name'); ?>" required autofocus>
        </div>
        <div class = "form-group">
            <label for="inputName">Last Name</label>
            <input type="text" name="last_name" class="form-control" placeholder="Last Name" 
                value="<?= Input::get('last_name'); ?>" required>
        </div>
        <div class = "form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email address"
                value="<?= Input::get('email'); ?>" required>
        </div>
        <div class = "form-group">
            <label for="inputPassword">Password</label>
            <input type="password" name="password1" class="form-control" placeholder="Password"
                value="<?= Input::get('password1'); ?>" required>
        </div>
        <div class = "form-group">
            <label for="inputPasswordAgain">Retype Password</label>
            <input type="password" name="password2" class="form-control" placeholder="Retype Password"
                value="<?= Input::get('password2'); ?>" required>
        </div>
        <button type="submit" name="submit" id="submit" value="submit" class="btn btn-success btn-lg btn-block">Sign Up</button>
      </form>

    </div> <!-- /container -->
  <?php include '../views/partials/footer.php'; ?>
</body>
</html>
