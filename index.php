<?php
    // PDO -> Php Data Object
    require_once('database.php');
    require_once('db_pdo.php');
    $config = require_once('config.php');

    use DB\DB_PDO as DB;

    $PDOConn = DB::getInstance($config); 
    $conn = $PDOConn->getConnection();


    
    

    // $id = 0;
    // $name = 'Giorno';
    // $lastname = 'Giovanna';

    // $userDTO = new UserDTO($conn);
    // $res = $userDTO->getAll();
    // //$res = $userDTO->getUserByID(2);

    // if($res) { // Controllo se ci sono dei dati nella variabile $res
    //     foreach($res as $row) {
    //         print_r($row);
    //     }
    // }



?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Progetto Settimana 16</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>