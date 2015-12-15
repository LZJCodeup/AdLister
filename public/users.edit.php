
<!doctype html>

<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Profile</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	
  <!-- Jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>



</head>
<body>
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

      <button class="btn btn-lg btn-danger btn-block" type="submit">Submit Changes</button>
      
  </div> <!-- /container -->
  <script type="text/javascript"></script>    
   
</body>

</html>