<?php
session_start();

require_once('database.php');
require_once('user.php');
require_once('db_pdo.php');
$config = require_once('config.php');

use DB\DB_PDO as DB;

$PDOConn = DB::getInstance($config);
$conn = $PDOConn->getConnection(); //Mi connetto

$userDTO = new UserDTO($conn);

// Controllo se l'utente ha effettuato il login
if (isset($_SESSION['userLogin'])) {
    // Controllo se l'utente è un admin
    if ($_SESSION['userLogin']['admin'] == 1) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['firstname'])) {
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $admin = $_POST['admin'];

                $res = $userDTO->saveUser([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'password' => $password,
                    'admin' => $admin
                ]);
            }

            if (isset($_REQUEST['id']) && $_REQUEST['action'] == 'update') {
                $id = intval($_REQUEST['id']);
                $firstname = $_POST['firstnameUp'];
                $lastname = $_POST['lastnameUp'];
                $email = $_POST['emailUp'];
                $password = $_POST['passwordUp'];
                $admin = $_POST['adminUp'];

                $res = $userDTO->updateUser([
                    'id' => $id,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'password' => $password,
                    'admin' => $admin
                ]);
            }
        }
        if (isset($_GET['id']) && $_GET['action'] == 'delete') {
            $id = intval($_GET['id']);

            $res = $userDTO->deleteUser($id);

            header('Location: index.php');
            exit;
        }

        $res = $userDTO->getAll();
    } else {
        header('Location: notAdminIndex.php');
        exit;
    }

} else {
    header('Location: login.php');
}


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-dark p-0">
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
    <h1 class="text-center text-light my-4 pb-3" style="border-bottom: 1px solid white; width: 50%; margin: 0 auto">
        Pannello di amministrazione
    </h1>
    <div class="container">
        <div class="d-flex justify-content-center my-4">
            <a href="#" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#creaUtente">
                Aggiungi utenti
            </a>

        </div>
        <!-- Tabella per i record esistenti -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="background-color: #0D6EFD60 !important; color: white;">ID</th>
                    <th scope="col" style="background-color: #0D6EFD60 !important; color: white;">Nome</th>
                    <th scope="col" style="background-color: #0D6EFD60 !important; color: white;">Cognome</th>
                    <th scope="col" style="background-color: #0D6EFD60 !important; color: white;">Email</th>
                    <th scope="col" style="background-color: #0D6EFD60 !important; color: white;">Password</th>
                    <th scope="col" style="background-color: #0D6EFD60 !important; color: white;">Admin</th>
                    <th scope="col" style="background-color: #0D6EFD60 !important; color: white;">Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($res) {
                    foreach ($res as $record) {
                        $modalId = "modificaUtente_" . $record["id"]; // Genera un ID univoco per ogni modale
                        ?>
                        <tr>
                            <td style="background-color: #0D6EFD10 !important; color: white;">
                                <?= $record["id"] ?>
                            </td>
                            <td style="background-color: #0D6EFD10 !important; color: white;">
                                <?= $record["firstname"] ?>
                            </td>
                            <td style="background-color: #0D6EFD10 !important; color: white;">
                                <?= $record["lastname"] ?>
                            </td>
                            <td style="background-color: #0D6EFD10 !important; color: white;">
                                <?= $record["email"] ?>
                            </td>
                            <td style="background-color: #0D6EFD10 !important; color: white;">
                                <?= $record["password"] ?>
                            </td>
                            <td style="background-color: #0D6EFD10 !important; color: white;">
                                <?php
                                if ($record["admin"] == 0) {
                                    echo "";
                                } else {
                                    echo '<i class="fas fa-check"></i>';
                                }
                                ?>
                            </td>

                            <td style="background-color: #0D6EFD10 !important; color: white;">
                                <a href="#" class="btn btn-outline-primary me-2" data-bs-toggle="modal"
                                    data-bs-target="#<?= $modalId ?>">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="index.php?action=delete&id=<?= $record["id"] ?>" class="btn btn-outline-danger">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>

                        </tr>


                        <!-- Modale per la modifica -->
                        <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>Label"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content"
                                style="background-color: #0D6EFD10; backdrop-filter: blur(10px);">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-light" id="modificaUtente Label">Gestione Utenti</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="index.php">
                                            <input name="id" type="hidden" class="form-control" id="id" aria-describedby="id"
                                                value="<?= $record["id"] ?>">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label text-light">Nome</label>
                                                <input name="firstnameUp" type="text" class="form-control" id="firstname"
                                                    aria-describedby="firstname" value="<?= $record["firstname"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label text-light">Cognome</label>
                                                <input name="lastnameUp" type="text" class="form-control" id="lastname"
                                                    aria-describedby="lastname" value="<?= $record["lastname"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label text-light">Email</label>
                                                <input name="emailUp" type="email" class="form-control" id="email"
                                                    aria-describedby="emailHelp" value="<?= $record["email"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label text-light">Password</label>
                                                <input name="passwordUp" type="password" class="form-control" id="password"
                                                    value="<?= $record["password"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="admin" class="form-label text-light">Admin</label>
                                                <input name="adminUp" type="number" class="form-control" id="admin"
                                                    aria-describedby="admin" min="0" max="1" value="<?= $record["admin"] ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Chiudi</button>
                                                <button name="action" value="update" type="submit"
                                                    class="btn btn-primary">Modifica</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modale nuovi utenti -->
    <div class="modal fade" id="creaUtente" tabindex="-1" aria-labelledby="creaUtenteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"
                style="background-color: #0D6EFD10; backdrop-filter: blur(10px);">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-light" id="creaUtenteLabel">Gestione Utenti</h1>
                </div>
                <div class="modal-body">
                    <form method="post" action="index.php">
                        <div class="mb-3">
                            <label for="firstname" class="form-label text-light">Nome</label>
                            <input name="firstname" type="text" class="form-control" id="firstname"
                                aria-describedby="firstname">
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label text-light">Cognome</label>
                            <input name="lastname" type="text" class="form-control" id="lastname"
                                aria-describedby="lastname">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label text-light">Email</label>
                            <input name="email" type="email" class="form-control" id="email"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text-light">Password</label>
                            <input name="password" type="password" class="form-control" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="admin" class="form-label text-light">Admin</label>
                            <input name="admin" type="number" class="form-control" id="admin" aria-describedby="admin"
                                min="0" max="1">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Chiudi</button>
                            <button type="submit" class="btn btn-primary">Crea</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>