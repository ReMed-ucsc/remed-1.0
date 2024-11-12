<!-- in config ROOT has root file path -->
<!-- all assests access via public folder -->

<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Home</title>
</head>

<body class="d-flex h-100 text-center text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">Cover</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link active" aria-current="page" href="<?= ROOT ?>">Home</a>
                    <a class="nav-link" href="<?= ROOT ?>/login">Login</a>
                    <a class="nav-link" href="<?= ROOT ?>/logout">Logout</a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <h4>Hi, <?= $username ?></h4>
            <h1>Cover your page.</h1>
            <p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
            <img src="<?= ROOT ?>/assets/images/drugs.png" alt="add" />
            <?php show(ROOT . '/assets/images/drugs.png'); ?>
            <p class="lead">
                <a href="#" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Learn more</a>
            </p>
        </main>


    </div>



</body>

</html>