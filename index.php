<?php
require_once('database.php');
require_once('user.php');
require_once('db_pdo.php');
$config = require_once('config.php');

use DB\DB_PDO as DB;

session_start();

$PDOConn = DB::getInstance($config);
$conn = $PDOConn->getConnection(); //Mi connetto

$userDTO = new UserDTO($conn);

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

var_dump($_SESSION['username']);

$res = $userDTO->getAll();
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
                <button class="btn btn-outline-primary" type="submit">Logout</button>
            </form>
        </div>
    </nav>
    <h1 class="text-center my-4">Pannello di amministrazione</h1>
    <div class="container">
        <!-- Form per aggiungere nuovi utenti -->
        <div class="d-flex justify-content-center my-4">
            <a href="#" class="btn btn-success w-25" data-bs-toggle="modal" data-bs-target="#creaUtente">
                Aggiungi utenti
            </a>
        </div>
        <!-- Tabella per i record esistenti -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($res) {
                    foreach ($res as $record) {
                        $modalId = "modificaUtente_" . $record["id"]; // Genera un ID univoco per ogni modale
                        ?>
                        <tr>
                            <td>
                                <?= $record["id"] ?>
                            </td>
                            <td>
                                <?= $record["firstname"] ?>
                            </td>
                            <td>
                                <?= $record["lastname"] ?>
                            </td>
                            <td>
                                <?= $record["email"] ?>
                            </td>
                            <td>
                                <?= $record["password"] ?>
                            </td>
                            <td>
                                <?= $record["admin"] ?>
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#<?= $modalId ?>">Modifica</a>
                                <a href="index.php?action=delete&id=<?= $record["id"] ?>" class="btn btn-danger">Elimina</a>
                            </td>
                        </tr>

                        <!-- Modale per la modifica -->
                        <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>Label"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modificaUtente Label">Gestione Utenti</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="index.php">
                                            <input name="id" type="hidden" class="form-control" id="id" aria-describedby="id"
                                                value="<?= $record["id"] ?>">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Nome</label>
                                                <input name="firstnameUp" type="text" class="form-control" id="firstname"
                                                    aria-describedby="firstname" value="<?= $record["firstname"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">Cognome</label>
                                                <input name="lastnameUp" type="text" class="form-control" id="lastname"
                                                    aria-describedby="lastname" value="<?= $record["lastname"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input name="emailUp" type="email" class="form-control" id="email"
                                                    aria-describedby="emailHelp" value="<?= $record["email"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input name="passwordUp" type="password" class="form-control" id="password"
                                                    value="<?= $record["password"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="admin" class="form-label">Admin</label>
                                                <input name="adminUp" type="number" class="form-control" id="admin"
                                                    aria-describedby="admin" min="0" max="1" value="<?= $record["admin"] ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
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
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="creaUtenteLabel">Gestione Utenti</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="index.php">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Nome</label>
                            <input name="firstname" type="text" class="form-control" id="firstname"
                                aria-describedby="firstname">
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Cognome</label>
                            <input name="lastname" type="text" class="form-control" id="lastname"
                                aria-describedby="lastname">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="email"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="admin" class="form-label">Admin</label>
                            <input name="admin" type="number" class="form-control" id="admin" aria-describedby="admin"
                                min="0" max="1">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
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