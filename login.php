
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/assets/js/color-modes.js"></script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.122.0" />
    <title>Progetto Settimana 16</title>
    <link rel="icon" href="img/klog-logo.png" type="image/png">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <meta name="theme-color" content="#712cf9" />

    <link rel="stylesheet" href="css/style.css" />
    <link href="https://getbootstrap.com/docs/5.3/examples/sign-in/sign-in.css" rel="stylesheet" />
</head>

<body class="d-flex align-items-center py-4 bg-dark">
    <main class="form-signin w-100 m-auto pt-0" style="border-radius: 2rem;
            background-color: #0D6EFD30;
            backdrop-filter: blur(5px);">
        <form action="controller.php" method="post">
            <div class="d-flex flex-column align-items-center justify-content-center my-2"
            style="width: 100%; margin: auto;">
                <div class="pb-2 mt-1">
                    <img src="img/klog-logo.png" alt="logo" style="width: 6.5rem; height: auto">
                </div>
                <div class="pt-2"
                style="border-top: solid 1px #0D6EFD; width: 100%;">
                   <h1 class="h4 mb-3 fw-normal text-center text-light">Login</h1> 
                </div>
            </div>


            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email"
                    value="" style="
                background-color: #FFFFFF;
                border-color: #0D6EFD;
                color: #031633 !important;
                " />
                <label for="floatingInput" class="text-primary fw-light">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password"
                    value="" style="
                background-color: #FFFFFF;
                border-color: #0D6EFD;
                color: #031633 !important;
                " />
                <label for="floatingPassword" class="text-primary fw-light">Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">
                Accedi
            </button>
            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger my-3" role="alert">' . $_SESSION['error'] . '</div>';
            }
            ?>
            <p class="mt-5 mb-3 text-light fw-light">&copy; 2017–2024</p>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>