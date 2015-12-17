<?php 
function pageController()
{
    $loggedIn = false;

    // this simulates the return of a sql query
    $ads = 
    [
        ['id' => '1', 'title' => 'XBONE', 'description' => 'A great condition Xbox', 'price' => '199.99', 'date_posted' => '2015-12-04'],
        ['id' => '2', 'title' => 'MacBook Pro', 'description' => 'ALMOST NEW have to get rid of it im moving...', 'price' => '1000 OBO', 'date_posted' => '2015-12-01'],
        ['id' => '3', 'title' => 'Pressure Washing', 'description' => 'I have the best rates on pressure washing', 'price' => 'Free Estimates', 'date_posted' => '2015-11-28']
    ];

    $ads = array_map(function($ad){
        $date = strtotime($ad['date_posted']);
        $ad['date_posted'] = date("F d, Y", $date);
        return $ad;
    }, $ads);

    return [
        'ads' => $ads,
        'loggedIn' => $loggedIn
    ];
}

extract(pageController());

 ?>

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
        <div class="form-inline">
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
            <?php foreach ($ads as $ad): ?>
                <tr>
                    <td><a href="/ads.show.php?id=<?= $ad['id']; ?>"><?= $ad['title']; ?></a></td>
                    <td><a href="/ads.show.php?id=<?= $ad['id']; ?>"><?= $ad['description']; ?></a></td>
                    <td><?= $ad['price']; ?></td>
                    <td><?= $ad['date_posted']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <?php include '../views/partials/footer.php'; ?>
</body>
</html>
