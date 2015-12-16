<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ad Lister!</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <?php include '../views/partials/header.php'; ?>
    <?php include '../views/partials/navbar.php'; ?>
    <main>
        <div class="container">
            <h1 class="text-center">Welcome to LZJ Ads!</h1>
            <h3 class="text-center">Your #1 craigslist alternative</h3>
        </div>
    </main>
    <div class="container">
        <div class="row">
            <h2>Most Recent Ads</h2>
            <div class="col-md-4">
                <div class="jumbotron">
                    <a href="/ads.show.php">
                        <img src="http://placehold.it/350x300" class="img-responsive">
                    </a>
                    <p class="text-center">
                        <a href="/ads.show.php"><strong>Title</strong></a>
                    </p>
                    <p>
                        <a href="/ads.show.php">Description...</a>
                    </p>
                    <p>
                        <a href="/ads.show.php">$price</a>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron">
                    <a href="/ads.show.php">
                        <img src="http://placehold.it/350x300" class="img-responsive">
                    </a>
                    <p class="text-center">
                        <a href="/ads.show.php"><strong>Title</strong></a>
                    </p>
                    <p>
                        <a href="/ads.show.php">Description...</a>
                    </p>
                    <p>
                        <a href="/ads.show.php">$price</a>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron">
                    <a href="/ads.show.php">
                        <img src="http://placehold.it/350x300" class="img-responsive">
                    </a>
                    <p class="text-center">
                        <a href="/ads.show.php"><strong>Title</strong></a>
                    </p>
                    <p>
                        <a href="/ads.show.php">Description...</a>
                    </p>
                    <p>
                        <a href="/ads.show.php">$price</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php include '../views/partials/footer.php'; ?>
</body>
</html>
