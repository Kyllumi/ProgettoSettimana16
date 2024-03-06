<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Progetto Settimana 16</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">PS16</a>
            <form class="d-flex" role="search">
                <a href="logout.php" class="btn btn-outline-primary" type="submit">Logout</a>
            </form>
        </div>
    </nav>
    <h1 class="text-center my-4">Homepage</h1>
    <div class="text-center p-5 bg-body-tertiary container">
        <h5>E' bello vederti,
            <?php echo $_SESSION['userLogin']['firstname'] ?>!
        </h5>
    </div>

    <div class="container mt-3 text-center">
        <p>Solo gli admin possono accedere al pannello di amministrazione e gestire gli utenti. Contattare un Admin per
            qualsiasi informazione.</p>
        <p>Ci scusiamo per il disagio.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>