<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Viewing All Ads</title>
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
        <h1>All Ads</h1>
        <div class="form-inline pull-right">
            <select class="form-control" name="sort" id="">
                <option value="" selected disabled>Sort By...</option>
                <option value="">Most Recent</option>
                <option value="">Price</option>
                <option value="">Popularity</option>
            </select>
        </div>
    </div>
    <div class="container">
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Posted On</th>
            </tr>
            <tr>
                <td>PS4</td>
                <td>Very good condition ps4....</td>
                <td>199.99</td>
                <td>12-04-15</td>
            </tr>
            <tr>
                <td>macbook pro</td>
                <td>ALMOST NEW have to get rid of it im moving...</td>
                <td>1000</td>
                <td>12-01-15</td>
            </tr>
        </table>
    </div>

    <?php include '../views/partials/footer.php'; ?>
</body>
</html>
