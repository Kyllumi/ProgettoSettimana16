<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Progetto Settimana 16</title>
    <link rel="icon" href="img/klog-logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">
<nav class="navbar mt-0">
        <div class="container-fluid justify-content-between align-items-center px-5">
            <a class="navbar-brand">
                <img src="img/klog-logo.png" alt="logo" style="width: 3rem; height: auto">
            </a>
            <form class="d-flex" role="search">
                <a href="logout.php" class="btn btn-outline-light mt-3" type="submit">Logout</a>
            </form>
        </div>
    </nav>
    <h1 class="text-center text-light my-4 pb-3" style="border-bottom: 1px solid white; width: 50%; margin: 0 auto">Homepage</h1>
    <div class="text-center p-5 container text-center text-light my-4" style="border-bottom: 1px solid white; width: 50%; margin: 0 auto">
        <h5 class="h3 fw-normal">È bello vederti,<span class="text-primary fw-bolder"> <?php echo $_SESSION['userLogin']['firstname'] ?></span>!
        </h5>
    </div>

    <div class="container mt-3 text-center d-flex flex-column align-items-center fw-light" style="width: 30%; margin: 0 auto">
        <span>Solo gli <span class="text-info">admin</span> possono accedere al pannello di amministrazione e gestire gli utenti.</span>
        <span>Contatta un <span class="text-info">admin</span> per
            qualsiasi informazione.</span>
        <span>Ci scusiamo per il disagio.</span>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>